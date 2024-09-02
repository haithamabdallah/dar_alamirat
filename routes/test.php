<?php

use App\Exports\ProductsExport;
use Illuminate\Support\Facades\Route;
use Modules\Product\Models\Product;

Route::get('/test', function () { 
    // return Maatwebsite\Excel\Facades\Excel::download(new ProductsExport, 'products.xlsx'); 
    // dd( Modules\Product\Models\Product::where('created_at', '>', '2024-08-30')->get() );
} );