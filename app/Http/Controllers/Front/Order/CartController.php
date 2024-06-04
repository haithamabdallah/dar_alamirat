<?php

namespace App\Http\Controllers\Front\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\Cart\Models\Cart;
use Modules\Product\Models\Product;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    //
    public function addToCart($productId)
    {
        $userId = auth()->user()->id;

        // Check if the product is already in the cart
        $existingCart = Cart::where(['user_id' => $userId , 'product_id' => $productId])->first();

        // If the product is already in the cart, return a message
        if ($existingCart) {

            return response()->json([
                'message' => 'Product already added to cart',
                'status' => 'danger'
            ]);
        }

        $cart = Cart::create([
            'product_id' => $productId,
            'user_id' => $userId,
        ]);

        if ($cart){
            return response()->json([
                'message' => 'Product added to cart successfully',
                'status' => 'success'
            ]);

        }else{
            return response()->json([
                'message' => 'Product did not add to cart',
                'status' => 'error'
            ]);
        }
    }

    public function showCart()
    {
        $carts     = cache()->remember('cart', 60 * 60, function () {
             return auth()->user()->carts;
         });

        return view('themes.theme1.cart-page', compact('carts'));
    }
}
