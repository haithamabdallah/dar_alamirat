<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Modules\Settings\Models\WebsiteSetting;

class WebsiteSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siteInfo=WebsiteSetting::first();
        return view('dashboard.settings.website.index',compact('siteInfo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.settings.website.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validateRequest($request);

        // Log debug message to check if files are being received
        Log::debug('Received files: ', [
            'website_logo' => $request->file('website_logo'),
            'website_icon' => $request->file('website_icon')
        ]);

        $logoPath = $this->storeFile($request->file('website_logo'), 'website_logos');
        $iconPath = $this->storeFile($request->file('website_icon'), 'website_icons');

        // Log debug message to check if paths are being generated
        Log::debug('Stored file paths: ', [
            'website_logo' => $logoPath,
            'website_icon' => $iconPath
        ]);

        WebsiteSetting::create([
            'website_name' => $request->website_name,
            'website_description' => $request->website_description,
            'website_address' => $request->website_address,
            'website_logo' => $logoPath,
            'website_icon' => $iconPath,
        ]);

        return redirect()->route('site-info.index')->with('success', 'Website info saved successfully!');
    }

    public function update(Request $request, $id)
    {
        $this->validateRequest($request, $id);

        $websiteSetting = WebsiteSetting::findOrFail($id);

        if ($request->hasFile('website_logo')) {
            $websiteSetting->website_logo = $this->storeFile($request->file('website_logo'), 'website_logos');
        }

        if ($request->hasFile('website_icon')) {
            $websiteSetting->website_icon = $this->storeFile($request->file('website_icon'), 'website_icons');
        }

        $websiteSetting->update([
            'website_name' => $request->website_name,
            'website_description' => $request->website_description,
            'website_address' => $request->website_address,
        ]);

        return redirect()->route('site-info.index')->with('success', 'Website info updated successfully!');
    }

    private function validateRequest(Request $request, $id = null)
    {
        $rules = [
            'website_name' => 'required|string|max:255',
            'website_description' => 'required|string',
            'website_address' => 'required|string',
            'website_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'website_icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        if (is_null($id)) {
            $rules['website_logo'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
            $rules['website_icon'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        $request->validate($rules);
    }

    private function storeFile($file, $directory)
    {
        // Log debug message to check if file is being processed
        Log::debug('Processing file: ', ['file' => $file]);

        // Generate a unique file name
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

        // Store the file in the specified directory within the public disk
        $filePath = $file->storeAs($directory, $fileName, 'public');

        // Log debug message to check if file is stored
        Log::debug('File stored at: ', ['path' => $filePath]);

        // Return the public URL of the stored file
        return Storage::disk('public')->url($filePath);
    }
    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('settings::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $siteInfo=WebsiteSetting::find($id);
        return view('dashboard.settings.website.edit',compact('siteInfo'));
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
    public function uploadLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules as needed
        ]);

        if ($request->file('logo')->isValid()) {
            $path = $request->file('logo')->store('logos', 'public');
            return response()->json(['path' => $path]);
        }

        return response()->json(['error' => 'Invalid file.'], 400);
    }
}
