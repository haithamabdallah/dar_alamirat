<?php

use Illuminate\Support\Facades\Route;
use Modules\Brand\Http\Controllers\BrandController;

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

Route::group(['middleware' => 'admin' , 'as' => 'dashboard.' , 'prefix' => 'dashboard'], function () {
    Route::get('brands/all', [BrandController::class , 'all'])->name('brand.all');
    Route::post('brands/search-results', [BrandController::class , 'search'])->name('brand.search.post');
});

Route::group(['middleware' => 'admin'], function () {
    Route::resource('brand', BrandController::class)->names('brand');
});
