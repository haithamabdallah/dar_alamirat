<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\IndexPriority;
use Illuminate\Http\Request;

class IndexPriorityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $priorityables = IndexPriority::orderBy('priorityable_type')->get();
        return view('dashboard.categories.index-priority', compact('priorityables'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id )
    {
// 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request['status'] = $request['status']  == true  ?  1 :  0 ;

        $validated = $request->validate([
            'priority' => 'required|numeric',
            'status' => 'required|in:1,0',
        ]);

        $priorityable = IndexPriority::find($id);
        $priorityable->update([
            'priority' => $validated['priority'] ,
            'status' => $validated['status']
        ]);

        return redirect()->back()->with('success', __('Done Successfully')); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
