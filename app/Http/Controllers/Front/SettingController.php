<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Modules\Settings\Models\Social;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    //
    public function viewFooter()
    {
        // $socialMedia = Cache::remember('social_media', now()->addHours(24), function () {
        //     return Social::get();
        // });
        //dd($socialMedia);
        $socialMedia  =Social::get();
        return view('themes.theme1.layouts.footer', compact('socialMedia'));
    }

}
