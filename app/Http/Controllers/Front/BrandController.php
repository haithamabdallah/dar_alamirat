<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Modules\Brand\Models\Brand;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    //
    public function index()
    {
        $brands = Brand::with('products')->active()->orderBy('name', 'asc')->get();
        return view('themes.' . getAppTheme() . '.brands',compact('brands'));
    }

    public function showBrand($id)
    {
        $brand= Brand::find($id);
        $products = $brand->products()->latest()->paginate(10);
        return view('themes.' . getAppTheme() . '.single-brand',compact('brand', 'products'));
    }
}
