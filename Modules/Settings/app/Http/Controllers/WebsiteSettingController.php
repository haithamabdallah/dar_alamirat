<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Settings\Models\WebsiteSetting;

class WebsiteSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('settings::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('settings::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
        $request->validate([
            'website_name' => 'required|string|max:255',
            'website_description' => 'required|string',
            'website_address' => 'required|string|max:255',
            'logo' => 'required|string',
        ]);

        // Create website instance
        $website = new WebsiteSetting();
        $website->name = $request->input('website_name');
        $website->description = $request->input('website_description');
        $website->address = $request->input('website_address');
        $website->logo = $request->input('logo');
        $website->save();

        return redirect()->route('dashboard.home')->with('success', 'Website info saved successfully!');
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
        return view('settings::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
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
