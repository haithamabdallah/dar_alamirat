<?php

namespace App\Services;

use Modules\Cart\Models\Cart;
use Modules\Product\Models\Variant;
use Modules\Product\Models\Inventory;
use Illuminate\Support\Facades\Validator;

class CartService
{

  public function mergeGuestCartsAndAuthCarts()
  {
    if (auth()->check() && session()->has('carts')) {

      $carts = session()->get('carts');
      $carts = json_decode($carts);
      $carts = collect($carts);

      if ($carts->count() > 0) {

        $carts->each(function ($cart) {
          $cart->user_id = auth()->user()->id;
          $cartArray = collect($cart)->toArray();

          $dbCart = Cart::where('user_id', auth()->user()->id)->where('product_id', $cart->product_id)?->first();

          if ($dbCart) {
            $dbCart->update($cartArray);
          } else {
            Cart::create($cartArray);
          }
        });

        $newCarts = [];
        $newCarts = json_encode($newCarts);
        session()->put('carts', $newCarts);
        session()->put('cartsCount', 0);

        return true;
      }
    }
  }

  public function validateUpdateCartRequest()
  {
    try {

      $validator = Validator::make(request()->all(), [
        'carts' => 'required|array',
        'carts.*' => 'required',
        'carts.*.quantity' => 'required|integer|min:1',
        // 'carts.*.price' => 'required|integer|min:0',
        'carts.*.variant_id' => 'required|exists:variants,id',
        'carts.*.product_id' => 'required|exists:products,id',
      ]);

      if ($validator->fails()) {
        return response()->json([
          'message' => $validator->errors(),
          'status' => 'error'
        ]);
      }

      $validated = $validator->safe()->only(['carts']);

      return $validated;
    } catch (\Exception $e) {
      return response()->json([
        'message' => $e->getMessage(),
        'status' => 'error'
      ]);
    }
  }
  public function updateCart($validated)
  {

    $prices = Variant::lazy()->map(function ($variant) {
      return $variant->only(['priceWithDiscount', 'id']);
  })->keyBy('id')->toArray();

  foreach ($validated['carts'] as $id => $requestCart) {

      $inventoryQuantity = Inventory::where('variant_id', $requestCart['variant_id'])?->first()?->quantity;

      $cart = Cart::find($id);  

      if ($requestCart['quantity'] <= $inventoryQuantity) {
        $cart->quantity = $requestCart['quantity'];
        $cart->price = $prices[$requestCart['variant_id']]['priceWithDiscount'];
        $cart->variant_id = $requestCart['variant_id'];
        $cart->product_id = $requestCart['product_id'];
        $cart->save();

      } else {

        $error = 'Product did not update. It may be out of stock';
        return $error;
      }
    }

  }

  public function updateGuestCart($validated)
  {
    if (session()->has('carts') && session()->get('cartsCount') > 0 && !(auth()->check())) {
      $sessionCarts = session()->get('carts');
      $sessionCarts = json_decode($sessionCarts);
      $sessionCarts = collect($sessionCarts);
    } else {
      $sessionCarts = collect([]);
    }

    $newSessionCarts = [];

    foreach ($validated['carts'] as $key => $reqCart) {

      foreach ($sessionCarts as $key => $sessionCart) {

        $reqCart = collect($reqCart);
        $sessionCart = collect($sessionCart);

        if ($sessionCart['product_id'] == $reqCart['product_id']) {
          $sessionCart['quantity'] = $reqCart['quantity'];
          $sessionCart['variant_id'] = $reqCart['variant_id'];
          $newSessionCarts[] = $sessionCart;
        }
      }
    }

    $newSessionCarts = collect($newSessionCarts);
    $newSessionCarts = json_encode($newSessionCarts);
    session()->forget('carts');
    session()->put('carts', $newSessionCarts);
  }
}
