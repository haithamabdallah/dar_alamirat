<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function companyInfo()
    {
        return view('dashboard.settings.general-settings');
    }

    public function siteInfo(Request $request)
    {
        $setting = Setting::firstOrCreate(['type' => 'general']);

        // Handle website icon upload
        if ($request->hasFile('website_icon') && $request->file('website_icon')->isValid()) {
            $websiteIconPath = $request->website_icon->store("website/{$setting->id}/img", 'public');
            $setting->update(['website_icon' => $websiteIconPath]);
        }

        // Handle website logo upload
        if ($request->hasFile('website_logo') && $request->file('website_logo')->isValid()) {
            $websiteLogoPath = $request->website_logo->store("website/{$setting->id}/img", 'public');
            $setting->update(['website_logo' => $websiteLogoPath]);
        }

        // Retrieve other form inputs
        $websiteName = $request->input('website_name');
        $websiteDescription = $request->input('website_description');
        $websiteAddress = $request->input('website_address');

        // Save the data into the database
        $setting->value = [
            'website_name' => $websiteName,
            'website_description' => $websiteDescription,
            'website_address' => $websiteAddress,
            'logo_path' => $websiteLogoPath ?? null,
            'icon_path' => $websiteIconPath ?? null,
        ];
        $setting->save();

        return redirect()->route('site-info.index')->with('success', 'setting saved successfully');
    }
}
