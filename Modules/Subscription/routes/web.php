<?php

use Illuminate\Support\Facades\Route;
use Modules\Subscription\Http\Controllers\SubscriptionController;

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
    Route::resource('subscription', SubscriptionController::class)->names('subscription');

    Route::get('send-newsletter', [SubscriptionController::class, 'sendNewsletterPage'])->name('send-newsletter-page');
    Route::post('send-newsletter', [SubscriptionController::class, 'sendNewsletter'])->name('send-newsletter');
    Route::get('send-marketing', [SubscriptionController::class, 'sendMarketingPage'])->name('send-marketing-page');
    Route::post('send-marketing', [SubscriptionController::class, 'sendMarketing'])->name('send-marketing');
});
