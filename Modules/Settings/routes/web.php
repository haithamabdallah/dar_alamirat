<?php

use Illuminate\Support\Facades\Route;
use Modules\Settings\Http\Controllers\SocialController;
use Modules\Settings\Http\Controllers\SettingsController;
use Modules\Settings\Http\Controllers\MaintenanceController;
use Modules\Settings\Http\Controllers\WebsiteSettingController;
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
    Route::post('maintenance/status', [MaintenanceController::class,'toggleStatus'])->name('maintenance.toggle-status');
    Route::resource('/site-info', WebsiteSettingController::class)->names('site-info');
    Route::post('/upload/logo', [WebsiteSettingController::class, 'uploadLogo'])->name('upload.logo');
    //socialMedia
    Route::resource('socialMedia', SocialController::class)->names('socialMedia');
    Route::get('/site-info', [WebsiteSettingController::class, 'index'])->name('site-info.index');
 //   Route::post('/site-info', [WebsiteSettingController::class, 'store'])->name('site-info.store');
   Route::post('/site-info/upload', [WebsiteSettingController::class, 'upload'])->name('site-info.upload');


});
