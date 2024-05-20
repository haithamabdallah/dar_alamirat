<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\SettingsController;

Route::group(['middleware' => 'admin'], function () {
    Route::get('/', [DashboardController::class , 'index' ])->name('index');

    Route::get('/logout', [AuthController::class , 'logout' ])->name('logout');
});

Route::group(['as' => 'auth.'], function () {
    Route::get('/login', [AuthController::class , 'showLoginForm' ])->name('login');
    Route::post('/login', [AuthController::class , 'login' ])->name('postLogin');
    Route::get('/register', [AuthController::class , 'register' ])->name('register');
});

Route::group(['middleware' => 'admin' ,'prefix' => 'settings', 'as' => 'settings.',] , function (){
   Route::get('/', [SettingsController::class , 'companyInfo'])->name('index');
   
});
