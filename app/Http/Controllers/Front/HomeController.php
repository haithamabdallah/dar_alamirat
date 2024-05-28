<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\CarService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Modules\Brand\Models\Brand;
use Modules\Category\Models\Category;
use Modules\Product\app\Services\ProductService;
use Modules\Product\Models\Product;

class HomeController extends Controller
{
    private $productService;

    public function __construct()
    {
        $this->productService = new ProductService();
    }

    public function index()
    {
        $categories = Category::active()->orderBy('priority', 'ASC')->get();
//
//        $normalCategories = Category::where('type', 'default')->orderBy('priority', 'asc')->get();
//        $barCategories = Category::where('type', 'banner')->orderBy('priority', 'asc')->get();
//
//        $categories = collect();
//        $maxCount = max($normalCategories->count(), $barCategories->count());
//
//        for ($i = 0; $i < $maxCount; $i++) {
//            if (isset($normalCategories[$i])) {
//                $categories->push($normalCategories[$i]);
//            }
//            if (isset($barCategories[$i])) {
//                $categories->push($barCategories[$i]);
//            }
//        }

        $brands     = cache()->remember('brands', 60 * 60, function () {
            return Product::active()->limit(3)->get();
        });
        $brands     = cache()->remember('brands', 60 * 60, function () {
            return Brand::active()->limit(15)->get();
        });
        return view('themes.theme1.index' , get_defined_vars());
    }

    public function changeLanguage($locale)
    {
        session()->put('locale', $locale);
        App::setLocale($locale);
        return redirect()->back();
    }

    public function categoryProducts(Request $request, Category $category)
    {
        if (count($request->all()) == 0){
            $products = $category->products()->filter($request->all())->active()->latest()->paginate(20);
        }elseif (count($request->all()) > 0){
            // Access the filters from the request
            $categoryId = $request->input('filter.category_id');
            $brandId = $request->input('filter.brand_id');

            // Fetch products filtered by category and brand
            $products = Product::when($categoryId, function ($query, $categoryId) {
                return $query->where('category_id', $categoryId);
            })
                ->when($brandId, function ($query, $brandId) {
                    return $query->where('brand_id', $brandId);
                })
                ->paginate(20);
//            $products = Product::active()->filter($request->filter)->latest()->paginate(20);
        }

        if ($request->ajax()) {
            $products->load('inventory', 'variants', 'media', 'category');
            return response()->json([
                'products' => $products->items(),
                'nextPage' => $products->nextPageUrl()
            ]);
        }
        return view('themes.theme1.category', compact('category', 'products'));
    }

}
