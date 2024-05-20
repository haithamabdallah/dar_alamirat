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
    public function saveSocialMedia(Request $request)
    {
        $facebook = $request->input('facebook');
        $twitter = $request->input('twitter');
        $instagram = $request->input('instagram');
        $youtube = $request->input('youtube');
        $whatsapp = $request->input('whatsapp');
        $tiktok = $request->input('tiktok');
        $snapchat = $request->input('snapchat');

        $setting = new Setting();
        $setting->type = 'social_media';
        $setting->value = [
            'facebook' => $facebook,
            'twitter' => $twitter,
            'instagram' => $instagram,
            'youtube' => $youtube,
            'whatsapp' => $whatsapp,
            'tiktok' => $tiktok,
            'snapchat' => $snapchat,
        ];
        $setting->save();


        return redirect()->route('socialMedia.index')->with('success', 'Social saved successfully');
    }
    public function saveAnnouncements(Request $request)
{


    $announcementMode = $request->input('announcement_mode');
    $announcementMessage = $request->input('announcement_message');


    $setting = new Setting();
    $setting->type = 'announcement';

    // Update the settings value with the new data
    $setting->value = [
        'announcements_mode' => $announcementMode,
        'announcement_message' => $announcementMessage,
    ];

    // Save the settings
    $setting->save();

    return redirect()->route('announcement.index')->with('success', 'announcment saved successfully');
}



public function saveMaintenances(Request $request)
{


    $maintenanceMode = $request->input('maintenance_mode');
    $maintenanceMode = $request->input('maintenance_message');
    $maintenanceTitle=$request->input('maintenance_title');


    $setting = new Setting();
    $setting->type = 'maintenance';

    // Update the settings value with the new data
    $setting->value = [
        'maintenance_mode' => $maintenanceMode,
        'maintenance_message' => $maintenanceMode,
        'maintenance_title'=>$maintenanceTitle,
    ];

    // Save the settings
    $setting->save();

    return redirect()->route('maintenance.index')->with('success', 'maintenance saved successfully');
}




}
