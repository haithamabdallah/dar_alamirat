<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Modules\Brand\Models\Brand;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    //
    public function showBrand($id)
    {
        $brand=Brand::find($id);
        $brand->load('products');
        return view('themes.theme1.single-brand',compact('brand'));
    }
}
