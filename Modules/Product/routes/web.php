<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ImageController;
use Modules\Product\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'admin'], function () {
    
    Route::get('/main-images/{productMedia}' , [ImageController::class , 'deleteProductImage'])->name('product-images.delete');
    Route::get('/variant-images/{variantImage}' , [ImageController::class , 'deleteVariantImage'])->name('variant-images.delete');

});

Route::group(['middleware' => 'admin'], function () {
    
    Route::resource('product', ProductController::class)->names('product');
    Route::post('toggle-returnable', [ProductController::class , 'toggleReturnable'])->name('product.toggle-returnable');
    Route::post('toggleChoice', [ProductController::class , 'toggleChoice'])->name('product.toggleChoice');
});

Route::group(['middleware' => 'admin' , 'as' => 'dashboard.' , 'prefix' => 'dashboard'], function () {
    
    Route::resource('product', ProductController::class)->names('product');
    Route::get('products', [ProductController::class , 'searchGet'])->name('product.search.get');
    Route::post('products/search-results', [ProductController::class , 'searchPost'])->name('product.search.post');
});
