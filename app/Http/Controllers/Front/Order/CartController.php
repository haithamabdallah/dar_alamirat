<?php

namespace App\Http\Controllers\Front\Order;

use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\Cart\Models\Cart;
use Modules\Product\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Modules\Product\Models\Inventory;
use Modules\Product\Models\Variant;

class CartController extends Controller
{
    public function __construct(
        public CartService $cartService
    ) {
    }
    public function cartCount()
    {
        $cartCount = Cart::where('user_id', auth()->user()->id)->count();
        return response()->json($cartCount);
    }

    public function addToGuestCart($productId)
    {
        // return response()->json('test');
        try {
            $quantity = request('quantity');
            $variantId = request('variantId');

            $prices = Variant::lazy()->map(function ($variant) {
                return $variant->only(['priceWithDiscount', 'id']);
            })->pluck('priceWithDiscount', 'id')->toArray();

            $price = $prices[$variantId];

            // Check if the product is already in the cart

            if (Session::has('carts')) {
                $carts = Session::get('carts');
                $carts = json_decode($carts);
                $carts = collect($carts);
            } else {
                $carts = [];
            }

            $inventoryQuantity = Inventory::where('variant_id', $variantId)->first()->quantity;

            foreach ($carts as $key => $cart) {

                // If the product is already in the cart, return a message
                if ($cart->product_id == $productId && $cart->variant_id == $variantId) {
                    $isInCart = true;
                }
            }


            if (isset($isInCart) && $isInCart) {
                if ($quantity <= $inventoryQuantity) {

                    $cart->quantity += $quantity;
                } else {

                    $error = __('Only available quantity is ') . $inventoryQuantity;
                }
            } else {
                if ($quantity <= $inventoryQuantity) {

                    $carts[] = [
                        'product_id' => $productId,
                        'variant_id' => $variantId,
                        'quantity' => $quantity,
                        'price' => $price,
                    ];
                } else {
                    $error = __('Only available quantity is ') . $inventoryQuantity;
                }
            }

            if (isset($error)) {
                return response()->json([
                    'message' => $error,
                    'status' => 'danger'
                ]);
            }

            $cartsCount = count($carts);
            Session::put('cartsCount', $cartsCount);

            $carts = json_encode($carts);
            Session::put('carts', $carts);

            $cartTotal = $this->cartService->CalculateGuestCartTotal();

            return response()->json([
                'message' => __('Product added to cart successfully'),
                'cartCount' => $cartsCount,
                'cartTotal' => $cartTotal,
                'status' => 'success'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 'danger'
            ]);
        }
    }

    public function addToCart($productId)
    {
        try {
            $quantity = request('quantity');
            $variantId = request('variantId');

            $prices = Variant::lazy()->map(function ($variant) {
                return $variant->only(['priceWithDiscount', 'id']);
            })->pluck('priceWithDiscount', 'id')->toArray();

            $price = $prices[$variantId];

            $userId = auth()->user()->id;

            // Check if the product is already in the cart
            $existingCart = Cart::where(['user_id' => $userId, 'product_id' => $productId, 'variant_id' => $variantId])->first();

            $inventoryQuantity = Inventory::where('variant_id', $variantId)->first()->quantity;

            // If the product is already in the cart, return a message
            if ($existingCart) {

                // ************************************************************
                if ($quantity <= $inventoryQuantity) {
                    $existingCart->quantity += $quantity;
                    $existingCart->save();
                } else {

                    $error = __('Only available quantity is ') . $inventoryQuantity;
                }
            } else {

                if ($quantity <= $inventoryQuantity) {

                    $cart = Cart::create([
                        'product_id' => $productId,
                        'variant_id' => $variantId,
                        'quantity' => $quantity,
                        'price' => $price,
                        'user_id' => $userId,
                    ]);
                } else {

                    $error = __('Only available quantity is ') . $inventoryQuantity;
                }
            }

            if (isset($error)) {
                return response()->json([
                    'message' => $error,
                    'status' => 'danger'
                ]);
            }

            $cartTotal = $this->cartService->CalculateAuthCartTotal();

            return response()->json([
                'message' => __('Product added to cart successfully'),
                'cartCount' => Cart::where('user_id', auth()->user()->id)->count(),
                'cartTotal' => $cartTotal,
                'status' => 'success'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 'danger'
            ]);
        }
    }

    public function showGuestCart()
    {
        if (auth()->check()) {
            return redirect()->route('cart.index');
        }
        // session()->put('cartsCount',0);
        // session()->forget('carts');

        if (Session::has('carts') && Session::get('cartsCount') > 0) {
            $carts = session()->get('carts');
            $carts = json_decode($carts);
            $carts = collect($carts);

            foreach ($carts as $key => $cart) {
                if (isset($cart?->product_id) && isset($cart?->variant_id)) {
                    $product = Product::where('id', $cart?->product_id)?->first();
                    $variant = Variant::where('id', $cart?->variant_id)?->first();
                    $cart->product = $product;
                    $cart->variant = $variant;
                } else {
                    session()->forget('carts');
                }
            }
        } else {
            $carts = null;
        }

        $prices = Variant::lazy()->map(function ($variant) {
            return $variant->only(['priceWithDiscount', 'id']);
        })->keyBy('id');

        return view('themes.' . getAppTheme() . '.cart-page', compact('carts', 'prices'));
    }

    public function showCart()
    {
        (new CartService())->mergeGuestCartsAndAuthCarts();

        $carts = auth()->user()->carts;

        $prices = Variant::lazy()->map(function ($variant) {
            return $variant->only(['priceWithDiscount', 'id']);
        })->keyBy('id')->toJson();

        return view('themes.' . getAppTheme() . '.cart-page', compact('carts', 'prices'));
    }

    public function updateCart(Request $request)
    {
        // return response()->json([
        //     'carts' => $request->carts
        // ]);

        $validated = (new CartService())->validateUpdateCartRequest();

        try {

            (new CartService())->updateCart($validated);

            $cartTotal = $this->cartService->CalculateAuthCartTotal();

            if (isset($error)) {
                return response()->json([
                    'message' => $error,
                    'status' => 'error'
                ]);
            }

            return response()->json([
                'message' => 'Updated Successfully.',
                'cartTotal' => $cartTotal,
                'status' => 'success'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 'error'
            ]);
        }
    }

    public function updateGuestCart(Request $request)
    {
        // return response()->json([
        //     'carts' => request()->carts
        // ]);

        $validated = (new CartService())->validateUpdateCartRequest();

        try {

            (new CartService())->updateGuestCart($validated);

            $cartTotal = $this->cartService->CalculateGuestCartTotal();

            return response()->json([
                'message' => 'Updated Successfully.',
                'cartTotal' => $cartTotal,
                'status' => 'success'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 'error'
            ]);
        }
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        $cartTotal = $this->cartService->CalculateAuthCartTotal();

        return redirect()->back()->with('success', __('Deleted Successfully.'));
    }

    public function destroyGuestCart(string $productId, string $index)
    {
        $carts = session()->get('carts');
        $carts = json_decode($carts);
        $carts = collect($carts);
        $newCarts = $carts->filter(function ($cart, $key) use ($productId, $index) {
            return $key != $index;
        });
        Session::put('cartsCount', count($newCarts));
        $newCarts = json_encode($newCarts);
        session()->put('carts', $newCarts);

        $cartTotal = $this->cartService->CalculateGuestCartTotal();

        return redirect()->back()->with('success', __('Deleted Successfully.'));
    }
}
