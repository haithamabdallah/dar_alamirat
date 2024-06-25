<?php

namespace App\Http\Controllers\Front\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\Cart\Models\Cart;
use Modules\Product\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Product\Models\Inventory;
use Modules\Product\Models\Variant;

class CartController extends Controller
{
    public function cartCount()
    {
        $cartCount = Cart::where('user_id', auth()->user()->id)->count();
        return response()->json($cartCount);
    }

    public function addToCart($productId)
    {
        $quantity = request('quantity');
        $variantId = request('variantId');

        $prices = Variant::lazy()->map(function ($variant) {
            return $variant->only(['priceWithDiscount', 'id']);
        })->pluck('priceWithDiscount', 'id')->toArray();

        $price = $prices[$variantId];

        $userId = auth()->user()->id;

        // Check if the product is already in the cart
        $existingCart = Cart::where(['user_id' => $userId, 'product_id' => $productId])->first();

        // If the product is already in the cart, return a message
        if ($existingCart) {

            return response()->json([
                'message' => 'Product already added to cart',
                'status' => 'danger'
            ]);
        }

        $inventoryQuantity = Inventory::where('variant_id', $variantId)->first()->quantity;

        if ($quantity <= $inventoryQuantity) {
            $cart = Cart::create([
                'product_id' => $productId,
                'variant_id' => $variantId,
                'quantity' => $quantity,
                'price' => $price,
                'user_id' => $userId,
            ]);
            return response()->json([
                'message' => 'Product added to cart successfully',
                'cartCount' => Cart::where('user_id', auth()->user()->id)->count(),
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'message' => 'Product did not add to cart. It may be out of stock',
                'status' => 'error'
            ]);
        }
    }

    public function showCart()
    {
        // $carts     = cache()->remember('cart', 60 * 60, function () {
        //      return auth()->user()->carts;
        //  });

        $carts = auth()->user()->carts;

        $prices = Variant::lazy()->map(function ($variant) {
            return $variant->only(['priceWithDiscount', 'id']);
        })->keyBy('id')->toJson();

        return view('themes.theme1.cart-page', compact('carts', 'prices'));
    }

    public function updateCart(Request $request)
    {
        // return response()->json([
        //     'carts' => $request->carts
        // ]);

        $validator = Validator::make($request->all(), [
            'carts' => 'required|array',
            'carts.*' => 'required',
            'carts.*.quantity' => 'required|integer|min:1',
            // 'carts.*.price' => 'required|integer|min:0',
            'carts.*.variant_id' => 'required|exists:variants,id',
            'carts.*.product_id' => 'required|exists:products,id',
        ]);

        try {

            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors(),
                    'status' => 'error'
                ]);
            }

            $validated = $validator->safe()->only(['carts']);

            // return response()->json([
            //     $validated['carts']
            // ]);
            $prices = Variant::lazy()->map(function ($variant) {
                return $variant->only(['priceWithDiscount', 'id']);
            })->pluck('priceWithDiscount', 'id')->toArray();

            foreach ($validated['carts'] as $id => $requestCart) {
                // return response()->json([
                //     $requestCart
                // ]);
                $inventoryQuantity = Inventory::where('variant_id', $requestCart['variant_id'])->first()->quantity;
                $cart = Cart::find($id);

                if ($requestCart['quantity'] <= $inventoryQuantity) {
                    $cart->quantity = $requestCart['quantity'];
                    $cart->price = $prices[$requestCart['variant_id']];
                    $cart->variant_id = $requestCart['variant_id'];
                    $cart->product_id = $requestCart['product_id'];
                    $cart->save();
                } else {
                    $error = 'Product did not update. It may be out of stock';
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 'error'
            ]);
        }

        if (isset($error)) {
            return response()->json([
                'message' => $error,
                'status' => 'error'
            ]);
        }

        return response()->json([
            'message' => 'Updated Successfully.',
            'status' => 'success'
        ]);
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect()->back()->with('success', __('Deleted Successfully.'));
    }
}
