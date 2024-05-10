<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Category\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::active()->limit(3)->get();
        return view('themes.theme1.index' , get_defined_vars());
    }



}
