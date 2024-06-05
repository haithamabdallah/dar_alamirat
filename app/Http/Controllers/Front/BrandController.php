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
        return view('themes.theme1.brands',compact('brands'));
    }

    public function showBrand($id)
    {
        $brand=Brand::find($id);
        $brand->load('products');
        return view('themes.theme1.single-brand',compact('brand'));
    }
}
