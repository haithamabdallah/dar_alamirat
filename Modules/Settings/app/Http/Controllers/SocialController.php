<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Settings\Models\Social;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $socials=Social::get();
        return view('dashboard.settings.socialmedia.index',compact('socials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('dashboard.settings.socialmedia.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|string',
            'icon' => 'required|string',
            'value' => 'required|url',
        ]);

        Social::create($validatedData);
        return redirect()->route('socialMedia.index')->with('success','Social Media Created Successfully');
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

           $socialMediaPlatform = Social::findOrFail($id);
            return view('dashboard.settings.socialmedia.edit', compact('socialMediaPlatform'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|string',
            'icon' => 'required|string',
            'value' => 'required|url',
        ]);

        $socialMediaPlatform = Social::findOrFail($id);
        $socialMediaPlatform->update($validatedData);

        return redirect()->route('socialMedia.index')->with('success', 'Social Media platform updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
