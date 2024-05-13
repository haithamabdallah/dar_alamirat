<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Settings\Models\MaintenanceSetting;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.settings.maintenance');
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
          // Validate the form data
          $validatedData = $request->validate([
       //     'maintenance_mode' => 'required|boolean',
            'maintenance_title' => 'required|string',
            'maintenance_message' => 'required|string',
        ]);

        
        $settings =new MaintenanceSetting();

        $settings->maintenance_title = $validatedData['maintenance_title'];
        $settings->maintenance_message = $validatedData['maintenance_message'];
        $settings->save();

        // Redirect back with a success message
        return back()->with('success', 'Maintenance settings saved successfully!');
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
}
