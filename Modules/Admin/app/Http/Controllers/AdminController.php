<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\app\Models\Admin;
use Modules\Admin\app\ViewModels\AdminViewModel;
use Modules\Admin\Http\Requests\AdminStoreRequest;
use Modules\Admin\Http\Requests\AdminUpdateRequest;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;


// Extend this class

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkPermissions:Admins')->only([ 'index' , 'show' , 'create' , 'store' , 'edit' , 'update', 'destroy' ]);
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::orderBy('id', 'DESC')->paginate(10);
        return view('dashboard.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(
            'dashboard.admins.form',
            [
                'roles' => Role::all(),
                'action' => route('admin.store'),
                'method' => 'POST'
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminStoreRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        // Check if a photo is uploaded
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Store the photo in the public storage and retrieve the path
            $path = $request->file('image')->store('admin/img', 'public');
            // Add the path to the validated data
            $validatedData['image'] = $path;
        }

        $admin = Admin::create($validatedData);

        Session()->flash('success', 'Admin Added Successfully');
        return redirect()->route('admin.index');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('dashboard.admins.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        return view(
            'dashboard.admins.form', [
            'roles' => Role::all(),
            'action' => route('admin.update', $admin->id),
            'method' => 'PUT',
            'admin' => $admin
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminUpdateRequest $request, Admin $admin): RedirectResponse
    {
        $data = $request->validated();

        // Check if a photo is uploaded
        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            // Delete the old photo if it exists
            if ($admin->image && Storage::disk('public')->exists($admin->image)) {
                Storage::disk('public')->delete($admin->image);
            }

            // Store the photo in the public storage and retrieve the path
            $path = $request->file('image')->store('admin/img', 'public');
            // Add the path to the validated data
            $data['image'] = $path;
        }

        $data['password'] = $request->password == null ? $admin->password : bcrypt($request->password);

        $admin->update($data);

        Session()->flash('success', 'Admin Updated Successfully');
        return redirect()->route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        // Check if the admin has a photo and delete it from storage
        if ($admin->image && Storage::disk('public')->exists($admin->image)) {
            Storage::disk('public')->delete($admin->image);
        }
        // Delete the admin record
        $admin->delete();
        Session()->flash('success', 'Admin Deleted Successfully');
        return redirect()->back();
    }
}
