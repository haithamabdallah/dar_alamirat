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
        $maintenances=MaintenanceSetting::get();
        return view('dashboard.settings.maintenances.index',compact('maintenances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.settings.maintenances.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //

          $validatedData = $request->validate([

            'maintenance_title' => 'required|string',
            'maintenance_message' => 'required|string',
        ]);


        $settings =new MaintenanceSetting();

        $settings->maintenance_title = $validatedData['maintenance_title'];
        $settings->maintenance_message = $validatedData['maintenance_message'];
        $settings->save();

        // Redirect back with a success message
        return redirect()->route('maintenance.index')->with('success', 'Maintenance settings saved successfully!');
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
        $maintenance=MaintenanceSetting::find($id);
        return view('dashboard.settings.maintenances.edit',compact('maintenance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'maintenance_title' => 'required|string',
            'maintenance_message' => 'required|string',
        ]);

        // Find the existing MaintenanceSetting instance by ID
        $settings = MaintenanceSetting::findOrFail($id);

        // Update the instance with the validated data
        $settings->update($validatedData);

        // Redirect back with a success message
        return redirect()->route('maintenance.index')->with('success', 'Maintenance settings updated successfully!');
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
        $model = MaintenanceSetting::findOrFail($request->modelId);

        // Toggle the status
        $model->maintenance_mode = !$model->maintenance_mode;
        $model->save();

        return response()->json(['success' => true]);
    }
}
