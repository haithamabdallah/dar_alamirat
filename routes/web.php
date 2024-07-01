<?php

use App\Http\Controllers\Dashboard\CouponController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\AuthController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\BrandController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\FavoriteController;
use Modules\Order\Http\Controllers\OrderController;
use App\Http\Controllers\Front\Order\CartController;
use App\Http\Controllers\Front\SubscriberController;
use App\Http\Controllers\Dashboard\SettingsController;
use App\Http\Controllers\Front\Profile\ProfileController;

/************************************ clients ****************************/


//Route::get('/clients', function () {
//    return view('dashboard.clients.clients');
//})->name('client.index');

//
//Route::get('/clients/create', function () {
//    return view('dashboard.clients.create_client');
//})->name('client.create');
//
//
//Route::get('/clients/edit', function () {
//    return view('dashboard.clients.edit_client');
//})->name('client.edit');

/************************************ products ****************************/

//Route::get('/products', function () {
//    return view('dashboard.products.products');
//})->name('product.index');


//Route::get('/products/create', function () {
//    return view('dashboard.products.create_product');
//})->name('product.create');
//
//
//Route::get('/products/edit', function () {
//    return view('dashboard.products.edit_product');
//})->name('product.edit');
//
//Route::get('/products/details', function () {
//    return view('dashboard.products.edit_details');
//})->name('product.details');

/************************************ reports ****************************/

Route::get('/test', function () {
    return view('test');
})->name('test');

Route::get('/reports', function () {
    return view('dashboard.reports.reports');
})->name('report.index');


Route::get('/reports/create', function () {
    return view('dashboard.reports.create_report');
})->name('report.create');


Route::get('/reports/edit', function () {
    return view('dashboard.reports.edit_report');
})->name('report.edit');

Route::get('/cart-empty', function () {
    return view('themes.theme1.cart-empty');
})->name('cart-empty');

Route::get('/offers', function () {
    return view('themes.theme1.offers');
})->name('offers');

Route::get('/brands', function () {
    return view('themes.theme1.brands');
})->name('brands');


/************************************ Front Routs ****************************/
Route::get('/lang/{lang}', [HomeController::class, 'changeLanguage'])->name('changeLang');
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/category-products/{category}', [HomeController::class, 'categoryProducts'])->name('category.products');
Route::get('/search-products', [HomeController::class, 'search'])->name('products.search');

Route::post('/send-otp', [AuthController::class, 'sendOtp'])->name('sendOtp');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('verifyOtp');
Route::post('/resend-otp', [AuthController::class, 'resendOtp'])->name('resendOtp');

Route::prefix('brands')->group(function () {
    Route::get('allBrands', [BrandController::class, 'index'])->name('brands.index');
    Route::get('brands/{brand}', [BrandController::class, 'showBrand'])->name('brand');
});

Route::prefix('products')->group(function () {
    Route::get('product/{product}', [ProductController::class, 'showProduct'])->name('product');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('user.logout');
Route::get('/user/profile/{user}', [ProfileController::class, 'showProfile'])->name('user.profile');
Route::put('/user/profile/{user}', [ProfileController::class, 'updateProfile'])->name('user.updateProfile');
Route::post('/subscribe', [SubscriberController::class, 'subscribe'])->name('subscribe');
Route::get('/subscriber/{subscriber}/confirm/{token}', [SubscriberController::class, 'confirmed'])->name('subscriber.confirm');
Route::get('/subscriber/{subscriber}/unsubscribe/{token}', [SubscriberController::class, 'unsubscribe'])->name('unsubscribe');


Route::middleware('auth:admin')->group(function () {

    Route::prefix('settings')->group(function () {
        Route::post('site-info-store', [SettingsController::class, 'siteInfo'])->name('site');
        Route::post('social-store', [SettingsController::class, 'saveSocialMedia'])->name('social');
        Route::post('announcement-store', [SettingsController::class, 'saveAnnouncements'])->name('announcement');
        Route::post('maintenance-store', [SettingsController::class, 'saveMaintenances'])->name('maintenance');
    });
});

Route::middleware('auth')->group(function () {

    Route::get('/favorites', [FavoriteController::class, 'index'])->name('user.favorites');
    Route::post('/favorites/{product}', [FavoriteController::class, 'toggleFavorite'])->name('toggle.favorites');
    // Cart
    Route::patch('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
    // Route::get('/cart-count', [CartController::class, 'cartCount'])->name('cart.count');

    // Route::withoutMiddleware('auth')->group(function () {
    // });
    Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.index');
    Route::delete('/cart/{cart:id}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::get('/my-orders', [OrderController::class, 'myOrdersPage'])->name('order.my');
    Route::get('/my-orders/{order:id}', [OrderController::class, 'myOrderDetailsPage'])->name('order.my.details');
    Route::get('/checkout', [OrderController::class, 'checkoutPage'])->name('checkout');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
    Route::post('/checkout/order', [OrderController::class, 'storeCheckout'])->name('order.checkout.store');

    Route::post('check-coupon', [CouponController::class, 'checkCoupon'])->name('coupon.check');

    Route::resource('addresses', UserAddressController::class)->only(['store', 'update', 'destroy']);
});

// Route::get('page/{page}',[HomeController::class,'showPage'])->name('fron.page.show');
