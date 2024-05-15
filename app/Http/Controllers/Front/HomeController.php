<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Modules\Category\Models\Category;
use Modules\Product\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::active()->limit(3)->get();
        $products = Product::active()->limit(3)->get();
        return view('themes.theme1.index' , get_defined_vars());
    }

    public function changeLanguage($locale)
    {
        session()->put('locale', $locale);
        App::setLocale($locale);
        return redirect()->back();
    }
}
