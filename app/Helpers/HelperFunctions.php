<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Modules\Category\Models\Category;
use Modules\Brand\Models\Brand;
use Modules\Product\Models\Product;
use Modules\Cart\Models\Cart;

if (!function_exists('setting'))
{
    function setting($value ,$lang = null)
    {
        $lang     =  $lang == null ? app()->getLocale() : $lang;
        $settings = Cache::get('settings') == null ?
            Cache::rememberForever('settings', function () {
                return Setting::get();
            })
            : Cache::get('settings');

        if($settings != null){
            foreach($settings as $setting){
                if($setting->option == $value){
                    return $setting->getTranslation('value',$lang);
                }
            }
        }
        return '';
    }
}


if (!function_exists('singleSetting'))
{
    function singleSetting($type)
    {
        $settings = Cache::get('singleSettings') == null ?
            Cache::rememberForever('singleSettings', function () use ($type) {
                return Setting::where('type' , $type)->first()->value;
            })
            : Cache::get('singleSettings');

        return $settings;
    }
}

if (!function_exists('gender'))
{
    function gender()
    {
        return [
            'male'       => 'ذكر',
            'female'     => 'انثى',
        ];
    }
}

if (!function_exists('defaultCategory'))
{
    function defaultCategory()
    {
        return Category::main()->active()->where('type' , 'default')->get();
    }
}

if (!function_exists('filterBrands'))
{
    function filterBrands()
    {
        return Brand::active()->get();
    }
}

if (!function_exists('isStringEnglishLetters'))
{
    function isStringEnglishLetters(string $string): bool
    {
        $string = preg_replace('/\s/u', '', $string);
        return ! preg_match('/[^A-Za-z0-9]/', $string);
    }
}

if (!function_exists('current_language'))
{
    function current_language() {
        if (Session::has('locale')){
            $current_language = app()->getLocale() ?? Session::get('locale');
        }else{
            $current_language = config('app.locale');
        }
        return $current_language;
    }
}

if (!function_exists('showLink'))
{
    function showLink(string $routeName)
    {
        return  Route::is("{$routeName}.*") ? 'show' : '';
    }
}

if (!function_exists('activeLink'))
{
    function activeLink(string $routeName)
    {
        return  Route::is("{$routeName}.*") ? 'active' : '';
    }
}

if (!function_exists('activeSingleLink'))
{
    function activeSingleLink(string $routeName)
    {
        return  Route::is("{$routeName}") ? 'active' : '';
    }
}

if (!function_exists('getLastKeyRoute'))
{
    function getLastKeyRoute(string $routeName)
    {
        $array = explode('.',$routeName);
        return end($array);
    }
}

if(!function_exists('storage_asset'))
{
    function storage_asset($file)
    {
        return asset('storage/' . $file) ;
    }
}

if(!function_exists('cartTotalPrice'))
{
    function cartTotalPrice()
    {
        $userId = auth()->user()->id;
        $carts = Cart::where('user_id', $userId)->with('product')->get();

        $totalPrice = 0;

        foreach ($carts as $cart) {

            $product = $cart->product; // Assuming you have a `products` relationship

            // Access the product price using the accessor
            $price = $product->price;

            // Calculate the total price considering quantity
            $totalPrice += $price;
        }

        return $totalPrice;
    }
}
