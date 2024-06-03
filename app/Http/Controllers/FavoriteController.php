<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Modules\Product\Models\Product;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = User::find(1)->favoriteProducts;
        return view('themes.theme1.profile.wish_list', compact('favorites'));
    }

    public function toggleFavorite(Product $product)
    {

        $favorite = User::findOrFail(1)->favorites()->where('product_id', $product->id)->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['message' => 'Product removed from favorites'], 200);
        } else {
            User::findOrFail(1)->favorites()->create(['product_id' => $product->id]);
            return response()->json(['message' => 'Product added to favorites'], 201);
        }

        return response()->json($favorite, 201);
    }

    public function destroy(Product $product)
    {
        $favorite = auth()->user()->favorites()->where('product_id', $product->id)->first();
        if ($favorite) {
            $favorite->delete();
            return response()->json(null, 204);
        }

        return response()->json(['message' => 'Favorite not found'], 404);
    }
}
