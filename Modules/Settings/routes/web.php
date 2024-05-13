<?php

use Illuminate\Support\Facades\Route;
use Modules\Settings\Http\Controllers\SettingsController;
use Modules\Settings\Http\Controllers\MaintenanceController;
use Modules\Settings\Http\Controllers\AnnouncementSettingController;

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
    Route::resource('settings', SettingsController::class)->names('settings');
    Route::resource('maintenance', MaintenanceController::class)->names('maintenance');
    Route::resource('announcement', AnnouncementSettingController::class)->names('announcement');
    Route::post('announcement/status', [AnnouncementSettingController::class,'toggleStatus'])->name('announcement.toggle-status');

});
