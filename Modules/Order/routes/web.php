<?php

use Illuminate\Support\Facades\Route;
use Modules\Order\Http\Controllers\OrderController;

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
    Route::get('orders/all', [OrderController::class , 'all'])->name('order.all');
    Route::post('orders/search-results', [OrderController::class , 'search'])->name('order.search.post');
});

Route::group(['middleware' => 'admin'], function () {
    Route::resource('order', OrderController::class)->names('order')->except(['create','edit']);
    Route::get('/get-variants', [OrderController::class, 'getVariants'])->name('get.variants');
});
