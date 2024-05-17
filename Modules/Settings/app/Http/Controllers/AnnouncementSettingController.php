<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Settings\Models\AnnouncementSetting;

class AnnouncementSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $announcements=AnnouncementSetting::get();
        return view('dashboard.settings.announcements.index',compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.settings.announcements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
        $validatedData = $request->validate([
                 'announcement_message' => 'required|string',
             ]);

        $announcements =new AnnouncementSetting();


        $announcements->announcement_message = $validatedData['announcement_message'];
        $announcements->save();

        // Redirect back with a success message
        return redirect()->route('announcement.index')->with('success', 'Announcement settings saved successfully!');
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
        $announcement=AnnouncementSetting::find($id);

        return view('dashboard.settings.announcements.edit',compact('announcement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
         // Validate the request data
         $request->validate([
            'announcement_message' => 'required|string',
        ]);

        // Find the announcement by ID
        $announcement = AnnouncementSetting::findOrFail($id);

        // Update the announcement
        $announcement->update([
            'announcement_message' => $request->announcement_message,
            // You can add more fields to update here if needed
        ]);

        // Redirect back with success message
        return redirect()->route('announcement.index')->with('success', 'Announcement updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }

    public function toggleStatus(Request $request)
{
    $model = AnnouncementSetting::findOrFail($request->modelId);

    // Toggle the status
    $model->announcement_mode = !$model->announcement_mode;
    $model->save();

    return response()->json(['success' => true]);
}
}
