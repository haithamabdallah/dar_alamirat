<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Modules\Brand\Models\Brand;
use Modules\Category\Models\Category;
use Modules\Product\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
//        $categories = Category::active()->limit(3)->get();

        $normalCategories = Category::where('type', 'default')->orderBy('priority', 'asc')->get();
        $barCategories = Category::where('type', 'banner')->orderBy('priority', 'asc')->get();

        $categories = collect();
        $maxCount = max($normalCategories->count(), $barCategories->count());

        for ($i = 0; $i < $maxCount; $i++) {
            if (isset($normalCategories[$i])) {
                $categories->push($normalCategories[$i]);
            }
            if (isset($barCategories[$i])) {
                $categories->push($barCategories[$i]);
            }
        }

        $products = Product::active()->limit(3)->get();
        $brands = Brand::active()->limit(15)->get();
        return view('themes.theme1.index' , get_defined_vars());
    }

    public function changeLanguage($locale)
    {
        session()->put('locale', $locale);
        App::setLocale($locale);
        return redirect()->back();
    }
}

