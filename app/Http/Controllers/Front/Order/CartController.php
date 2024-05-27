<?php

namespace App\Http\Controllers\Front\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\Product\Models\Product;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    //
    public function addToCart(Request $request)
    {
        Log::info('Add to cart request received', ['request' => $request->all()]);
        $product = Product::find($request->id);

        if (!$product) {
            Log::error('Product not found', ['id' => $request->id]);
            return response()->json(['error' => 'Product not found!'], 404);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);

        Log::info('Product added to cart', ['cart' => $cart]);
        return response()->json(['success' => 'Product added to cart successfully!']);
      }

      public function showCart()
    {
        $cart = session()->get('cart', []);
        return view('themes.theme1.cart-page', compact('cart'));
    }
}
