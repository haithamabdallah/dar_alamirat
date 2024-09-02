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
    Route::get('product/import-excel', [ProductController::class , 'importProductsFromExcelFileGet'])->name('product.import-excel.get');
    Route::post('product/import-excel/post', [ProductController::class , 'importProductsFromExcelFilePost'])->name('product.import-excel.post');
    Route::post('product/export-excel/post', [ProductController::class , 'exportProductsAsExcel'])->name('product.export-excel.post');
    Route::post('toggle-returnable', [ProductController::class , 'toggleReturnable'])->name('product.toggle-returnable');
    Route::post('toggleChoice', [ProductController::class , 'toggleChoice'])->name('product.toggleChoice');
    Route::resource('product', ProductController::class)->names('product');
});

Route::group(['middleware' => 'admin' , 'as' => 'dashboard.' , 'prefix' => 'dashboard'], function () {
    Route::get('products/all', [ProductController::class , 'all'])->name('product.all');
    Route::post('products/search-results', [ProductController::class , 'search'])->name('product.search.post');
});
