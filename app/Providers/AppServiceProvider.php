<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\MainSlider;
use Modules\Page\Models\Page;
use Modules\Settings\Models\Social;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Modules\Admin\app\Models\Admin;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::if('adminCan', function ($permission) {
            return auth('admin')->user()->can($permission);
        });

        View::composer('*', function ($view) {
            $settings = Setting::all();
            $pages = Page::active()->get();
            $currency =     Setting::where('type', 'general')->first()->value['currency-' . app()->getLocale()] ?? "LYD";
            $sliders = MainSlider::active()->latest()->get();

            $view->with(
                compact('settings', 'currency', 'pages', 'sliders')
            );
        });
    }
}
