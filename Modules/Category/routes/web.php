<?php

use Illuminate\Support\Facades\Route;
use Modules\Category\Http\Controllers\CategoryController;
use Modules\Category\Http\Controllers\BannerController;

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

Route::group(['middleware' => 'admin' , 'prefix'=>'dashboard'], function () {
    Route::resource('category', CategoryController::class)->names('category');
    Route::post('category/status/{category}', [CategoryController::class , 'changeStatus'])->name('category.status');
    Route::resource('banners', BannerController::class )->names('banner');
    Route::post('banner/status/{banner}', [BannerController::class , 'changeStatus'])->name('banner.status');
});
