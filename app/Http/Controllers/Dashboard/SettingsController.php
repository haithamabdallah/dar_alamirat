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
        $request['main_banner_status'] = $request['main_banner_status'] == true ? 1 : 0;

        // Validate the request inputs
        $validatedData = $request->validate([
            'website_name' => 'nullable',
            'website_description' => 'nullable',
            'website_address' => 'nullable',
            'theme' => 'required|in:theme1,theme2,theme3',
            'tel' => 'nullable',
            'whats_app' => 'nullable',
            'currency-en' => 'required',
            'currency-ar' => 'required',
            'vat' => 'nullable|numeric|min:0|max:100',
            'website_icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'website_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'main_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:10240',
            'main_banner_status' => 'required|in:0,1',
        ]);

        // Retrieve or create the setting entry
        $setting = Setting::firstOrCreate(
            ['type' => 'general'],
            ['value' => []]
        );

        // Merge new values with the existing ones
        $currentValue = $setting->value;

        $newValue = array_merge($currentValue, array_filter($validatedData));

        $newValue['main_banner_status'] = $validatedData['main_banner_status'];

        if ( $validatedData['vat'] == 0 )
        {
            $newValue['vat'] = $validatedData['vat'];
        }

        // Handle website icon upload
        if ($request->hasFile('website_icon') && $request->file('website_icon')->isValid()) {
            $websiteIconPath = $request->website_icon->store("website/{$setting->id}/img", 'public');
            $newValue['icon_path'] = $websiteIconPath;
        }

        // Handle website logo upload
        if ($request->hasFile('website_logo') && $request->file('website_logo')->isValid()) {
            $websiteLogoPath = $request->website_logo->store("website/{$setting->id}/img", 'public');
            $newValue['logo_path'] = $websiteLogoPath;
        }

        // Handle website banner upload
        if ($request->hasFile('main_banner') && $request->file('main_banner')->isValid()) {
            $mainBannerPath = $request->main_banner->store("website/{$setting->id}/img", 'public');
            $newValue['main_banner'] = $mainBannerPath;
        }

        // Update the setting entry with the merged values
        $setting->value = $newValue;
        $setting->save();


        return redirect()->route('site-info.index')->with('success', 'setting saved successfully');
    }

    public function saveSocialMedia(Request $request)
    {
        // dd($request->all());

        $socialMedia = [
            'facebook',
            'twitter',
            'instagram',
            'youtube',
            'whatsapp',
            'tiktok',
            'snapchat',
        ];

        foreach ($socialMedia as $social) {
            $status[$social] = (isset($request['status'][$social]) && $request['status'][$social] == true ? 1 : 0);
        }

        $request['status'] = $status;
        
        $validatedData = $request->validate([
            'facebook' => 'nullable|url:http,https',
            'twitter' => 'nullable|url:http,https',
            'instagram' => 'nullable|url:http,https',
            'youtube' => 'nullable|url:http,https',
            'whatsapp' => 'nullable|url:http,https',
            'tiktok' => 'nullable|url:http,https',
            'snapchat' => 'nullable|url:http,https',
            'status' => 'required|array',
            'status.*' => 'required|in:0,1',
        ]);

        // Retrieve or create the social media setting entry
        $setting = Setting::firstOrCreate(
            ['type' => 'social_media'],
            ['value' => []]
        );

        // Merge new values with the existing ones
        $setting->value = array_merge($setting->value, array_filter($validatedData));

        // Update the setting entry with the merged values
        $setting->save();

        return redirect()->route('socialMedia.index')->with('success', 'Social saved successfully');
    }
    public function saveAnnouncements(Request $request)
    {


        $announcementMode = $request->input('announcement_mode');
        $announcementMessage = $request->input('announcement_message');

        // Retrieve or create the announcement setting entry
        $setting = Setting::firstOrCreate(
            ['type' => 'announcement'], // Find or create based on type
            ['value' => []] // Default value for the 'value' field
        );

        // Update the settings value with the new data
        $setting->value = [
            'announcement_mode' => $announcementMode,
            'announcement_message' => $announcementMessage,
        ];

        // Save the settings
        $setting->save();

        return redirect()->route('announcement.index')->with('success', 'announcment saved successfully');
    }



    public function saveMaintenances(Request $request)
    {


        $maintenanceMode = $request->input('maintenance_mode');
        $maintenanceMessage = $request->input('maintenance_message');
        $maintenanceTitle = $request->input('maintenance_title');

        // Retrieve or create the maintenance setting entry
        $setting = Setting::firstOrCreate(
            ['type' => 'maintenance'], // Find or create based on type
            ['value' => []] // Default value for the 'value' field
        );

        // Update the settings value with the new data
        $setting->value = [
            'maintenance_mode' => $maintenanceMode,
            'maintenance_message' => $maintenanceMessage,
            'maintenance_title' => $maintenanceTitle,
        ];

        // Save the settings
        $setting->save();

        return redirect()->route('maintenance.index')->with('success', 'maintenance saved successfully');
    }
}
