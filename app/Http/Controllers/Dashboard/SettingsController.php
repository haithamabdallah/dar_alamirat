<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function companyInfo()
    {
        return view('dashboard.settings.general-settings');
    }

}
