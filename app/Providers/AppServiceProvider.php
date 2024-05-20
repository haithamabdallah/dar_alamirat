<?php

namespace App\Providers;

use App\Models\Setting;
use Modules\Settings\Models\Social;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

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
        Blade::if('adminCan', function($permission){
            return auth('admin')->user()->can($permission);
        });
        View::composer('*', function ($view) {
            $settings = Cache::remember('settings', now()->addHours(24), function () {
                return Setting::all();
            });

            $view->with('settings', $settings);
        });
    }
}
