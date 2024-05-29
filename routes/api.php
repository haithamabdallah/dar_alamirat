<?php

use App\Http\Controllers\Front\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

// Route::post('test', [AuthController::class, 'sendOtp']);
