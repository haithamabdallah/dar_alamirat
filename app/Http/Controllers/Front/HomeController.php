<?php

namespace App\Http\Controllers\Front;

use App\Services\CarService;
use Illuminate\Http\Request;
use App\Models\IndexPriority;
use App\Services\CartService;
use Modules\Brand\Models\Brand;
use Illuminate\Support\Facades\App;
use Modules\Product\Models\Product;
use App\Http\Controllers\Controller;
use Modules\Category\Models\Category;
use Modules\Product\app\Services\ProductService;

class HomeController extends Controller
{
    private $productService;

    public function __construct()
    {
        $this->productService = new ProductService();
    }

    public function changeLanguage($locale)
    {
        session()->put('locale', $locale);
        App::setLocale($locale);
        return redirect()->back();
    }

    public function index()
    {
        //        $categories = Category::where('parent_id' , null)->active()->orderBy('priority', 'ASC')->get();
        //        $categories     = cache()->remember('categories', 60 * 60, function () {
        //            return Category::where('parent_id' , null)->active()->orderBy('priority', 'ASC')->get();
        //        });
        //
        //        $brands     = cache()->remember('brands', 60 * 60, function () {
        //            return Brand::active()->limit(12)->inRandomOrder()->get();
        //        });

        (new CartService())->mergeGuestCartsAndAuthCarts();

        $priorityables = IndexPriority::where('status', 1)->orderBy('priority', 'ASC')->get();

        $brands = Brand::active()->limit(12)->inRandomOrder()->get();

        return view('themes.' . getAppTheme() . '.index', compact('brands', 'priorityables'));
    }


    public function categoryProducts(Request $request, Category $category)
    {
        if (count($request->all()) == 0 || isset($request['page'])) {
            $products = $category->products()->active()->latest()->paginate(20);
        } elseif (count($request->all()) > 0) {
            // Access the filters from the request
            $categoryId = $request->input('filter.category_id');
            $brandId = $request->input('filter.brand_id');
            $priceFilter = $request->input('filter.price');
            $priceMin = $request->input('filter.price_min');
            $priceMax = $request->input('filter.price_max');

            // Fetch products filtered by category and brand
            $products = Product::active()->when($categoryId, function ($query, $categoryId) {
                return $query->where('category_id', $categoryId);
            })->when($brandId, function ($query, $brandId) {
                return $query->where('brand_id', $brandId);
            })->when($priceFilter, function ($query, $priceFilter) {
                return $query->whereHas('variants', function ($query) use ($priceFilter) {
                    if ($priceFilter === '<100') {
                        return $query->where('price', '<', 100);
                    } elseif ($priceFilter === '100-200') {
                        return $query->whereBetween('price', [100, 200]);
                    } elseif ($priceFilter === '200-300') {
                        return $query->whereBetween('price', [200, 300]);
                    } elseif ($priceFilter === '>300') {
                        return $query->where('price', '>', 300);
                    }
                });
            })->when($priceMin, function ($query, $priceMin) {
                return $query->whereHas('variants', function ($query) use ($priceMin) {
                    return $query->where('price', '>=', $priceMin);
                });
            })
                ->when($priceMax, function ($query, $priceMax) {
                    return $query->whereHas('variants', function ($query) use ($priceMax) {
                        return $query->where('price', '<=', $priceMax);
                    });
                })->latest()->paginate(20);
            //            $products = Product::active()->filter($request->filter)->latest()->paginate(20);
        }

        if ($request->ajax()) {
            $products->load('inventory', 'variants', 'media', 'category');
            return response()->json([
                'products' => $products->items(),
                'nextPage' => $products->nextPageUrl()
            ]);
        }

        $brandIds = $products->pluck('brand_id')->unique();
        $categoryBrands = Brand::active()->whereIn('id', $brandIds)->get();

        return view('themes.' . getAppTheme() . '.category', compact('category', 'products', 'categoryBrands'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        if (!isset($request->filter)) {
            $products = Product::where('title->' . 'en', 'LIKE', '%' . $query . '%')
                ->orWhere('title->' . 'ar', 'LIKE', '%' . $query . '%')
                // ->filter($request->all())
                ->active()->latest()->paginate(20);

                
            if ($products->count() == 0) {
                $products = Product::whereHas('brand' , function ($q) use ($query) {
                    $q->where('name', 'LIKE', '%' . $query . '%');
                })
                    ->active()->latest()->paginate(20);
            }

            if ($products->count() == 0) {
                $products = Product::where('description->' . 'en', 'LIKE', '%' . $query . '%')
                    ->orWhere('description->' . 'ar', 'LIKE', '%' . $query . '%')
                    ->active()->latest()->paginate(20);
            }

            if ($products->count() == 0) {
                $products = Product::where('instructions->' . 'en', 'LIKE', '%' . $query . '%')
                    ->orWhere('instructions->' . 'ar', 'LIKE', '%' . $query . '%')
                    ->active()->latest()->paginate(20);
            }


            if ($products->count() == 0) {
                $products = Product::active()->inRandomOrder()->paginate(20);
            }
        } else {
            // Access the filters from the request
            $categoryId = $request->input('filter.category_id');
            $brandId = $request->input('filter.brand_id');
            $priceFilter = $request->input('filter.price');
            $priceMin = $request->input('filter.price_min');
            $priceMax = $request->input('filter.price_max');

            // Fetch products filtered by category and brand
            $products = Product::active()->when($categoryId, function ($query, $categoryId) {
                return $query->where('category_id', $categoryId);
            })->when($brandId, function ($query, $brandId) {
                return $query->where('brand_id', $brandId);
            })->when($priceFilter, function ($query, $priceFilter) {
                return $query->whereHas('variants', function ($query) use ($priceFilter) {
                    if ($priceFilter === '<100') {
                        return $query->where('price', '<', 100);
                    } elseif ($priceFilter === '100-200') {
                        return $query->whereBetween('price', [100, 200]);
                    } elseif ($priceFilter === '200-300') {
                        return $query->whereBetween('price', [200, 300]);
                    } elseif ($priceFilter === '>300') {
                        return $query->where('price', '>', 300);
                    }
                });
            })->when($priceMin, function ($query, $priceMin) {
                return $query->whereHas('variants', function ($query) use ($priceMin) {
                    return $query->where('price', '>=', $priceMin);
                });
            })
                ->when($priceMax, function ($query, $priceMax) {
                    return $query->whereHas('variants', function ($query) use ($priceMax) {
                        return $query->where('price', '<=', $priceMax);
                    });
                })->latest()->paginate(20);
        }
        return view('themes.' . getAppTheme() . '.search', compact('products', 'query'));
    }

    public function searchAjax(Request $request)
    {
        try {
            $search = $request->search;

            // return response()->json( $request->all() );
            if ($search == true) {

                $products = Product::where('title->' . 'en', 'LIKE', '%' . $search . '%')
                    ->orWhere('title->' . 'ar', 'LIKE', '%' . $search . '%')
                    ->withOnly([])
                    ->active()->latest()->take(20)->get();
                // ->filter($request->all())

                
            if ($products->count() == 0) {
                $products = Product::whereHas('brand' , function ($q) use ($search) {
                    $q->where('name', 'LIKE', '%' . $search . '%');
                })
                ->withOnly([])
                ->active()->latest()->take(20)->get();
            }

                if ($products->count() == 0) {
                    $products = Product::where('description->' . 'en', 'LIKE', '%' . $search . '%')
                    ->orWhere('description->' . 'ar', 'LIKE', '%' . $search . '%')
                    ->withOnly([])
                    ->active()->latest()->take(20)->get();
                }

                if ($products->count() == 0) {
                    $products = Product::where('instructions->' . 'en', 'LIKE', '%' . $search . '%')
                    ->orWhere('instructions->' . 'ar', 'LIKE', '%' . $search . '%')
                    ->withOnly([])
                    ->active()->latest()->take(20)->get();
                }

                if ($products->count() == 0) {
                    $products = Product::active()
                    ->withOnly([])
                    ->inRandomOrder()
                    ->take(20)->get();
                }
                // return response()->json( $search );
                $status = 'success';

                return response()->json(
                    compact('status', 'products')
                );
            } else {
                return response()->json([
                    'status' => false
                ]);
            }
        } catch (\Exception $e) {

            return response()->json([
                $e
            ]);
        }
    }
}
