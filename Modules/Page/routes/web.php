<?php

use Illuminate\Support\Facades\Route;
use Modules\Page\Http\Controllers\PageController;
use Modules\Page\Http\Controllers\PageStatusController;

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

Route::group([], function () {
    Route::resource('page', PageController::class)->names('page');
    Route::post('page/status', [PageController::class,'toggleStatus'])->name('page.toggle-status');

});

