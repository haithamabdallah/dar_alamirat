<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Product\Models\Product;

class ProductController extends Controller
{
    //
    public function showProduct($id)
    {
        $product=Product::find($id);
        $product->load(['brand']);
        $productsYouMayLike = Product::where('id','!=',$product->id)->get()->shuffle()->take(10);
        $productVariantPrices = $product->variants->map(function($variant){
                    return $variant->only(['price','price_with_discount','id']);
        })->keyBy('id')->toJson();
        // $productsYouMayLike = Product::where('id','!=',$product->id)->get()->random(10);
        return view('themes.theme1.single-product',compact('product' , 'productsYouMayLike' , 'productVariantPrices'));
    }
}
