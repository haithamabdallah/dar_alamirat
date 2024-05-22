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

        // Validate the request inputs
        $validatedData = $request->validate([
            'website_name' => 'required|string|max:255',
            'website_description' => 'nullable|string|max:255',
            'website_address' => 'nullable|string|max:255',
            'tel' => 'nullable|string',
            'whats_app' => 'nullable|string',
            'website_icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'website_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Retrieve or create the setting entry
        $setting = Setting::firstOrCreate(
            ['type' => 'general'],
            ['value' => []]
        );

        // Merge new values with the existing ones
        $currentValue = $setting->value;

        $newValue = array_merge($currentValue, [
            'website_name' => $validatedData['website_name'],
            'website_description' => $validatedData['website_description'],
            'website_address' => $validatedData['website_address'],
            'tel' => $validatedData['tel'],
            'whats_app' => $validatedData['whats_app'],
        ]);

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

        // Update the setting entry with the merged values
        $setting->value = $newValue;
        $setting->save();

        return redirect()->route('site-info.index')->with('success', 'setting saved successfully');
    }
    public function saveSocialMedia(Request $request)
    {
        // Validate the request inputs
        $validatedData = $request->validate([
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
            'whatsapp' => 'nullable|string|max:15',
            'tiktok' => 'nullable|url',
            'snapchat' => 'nullable|url',
        ]);

        // Retrieve or create the social media setting entry
        $setting = Setting::firstOrCreate(
            ['type' => 'social_media'],
            ['value' => []]
        );

        // Merge new values with the existing ones
        $currentValue = $setting->value;

        $newValue = array_merge($currentValue, [
            'facebook' => $validatedData['facebook'],
            'twitter' => $validatedData['twitter'],
            'instagram' => $validatedData['instagram'],
            'youtube' => $validatedData['youtube'],
            'whatsapp' => $validatedData['whatsapp'],
            'tiktok' => $validatedData['tiktok'],
            'snapchat' => $validatedData['snapchat'],
        ]);

        // Update the setting entry with the merged values
        $setting->value = $newValue;
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
        $maintenanceMode = $request->input('maintenance_message');
        $maintenanceTitle = $request->input('maintenance_title');

        // Retrieve or create the maintenance setting entry
        $setting = Setting::firstOrCreate(
            ['type' => 'maintenance'], // Find or create based on type
            ['value' => []] // Default value for the 'value' field
        );

        // Update the settings value with the new data
        $setting->value = [
            'maintenance_mode' => $maintenanceMode,
            'maintenance_message' => $maintenanceMode,
            'maintenance_title' => $maintenanceTitle,
        ];

        // Save the settings
        $setting->save();

        return redirect()->route('maintenance.index')->with('success', 'maintenance saved successfully');
    }
}
