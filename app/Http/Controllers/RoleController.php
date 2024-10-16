<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use App\Http\Requests\RoleRequest;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkPermissions:Roles')->only([ 'index' , 'show' , 'create' , 'store' , 'edit' , 'update', 'destroy' ]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('dashboard.roles.index' , compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        $action = route('roles.store');
        $method = 'POST';
        return view('dashboard.roles.form' , compact('permissions' , 'action' , 'method'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $validated = $request->validated();
        $role = Role::create( [ 'name' => $validated['name'] ] );

        $role->permissions()->sync($validated['permission_ids']);
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $action = route('roles.update' , $role->id);
        $method = 'PUT';
        return view('dashboard.roles.form' , compact('permissions' , 'action' , 'method' , 'role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $role)
    {
        $validated = $request->validated();
        $role->update( [ 'name' => $validated['name'] ] );

        $role->permissions()->sync($validated['permission_ids']);
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }
}
