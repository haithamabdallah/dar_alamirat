<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\MainSlider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MainSliderRequest;
use Illuminate\Support\Facades\Storage;

class MainSliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkPermissions:Sliders')->only([ 'index' , 'show' , 'create' , 'store' , 'edit' , 'update', 'destroy' ]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $mainSliders = MainSlider::latest()->paginate(20);
        $mainSliders = MainSlider::latest()->get();

        return view('dashboard.main-sliders.index' , compact('mainSliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.main-sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MainSliderRequest $request)
    {
        $validated = $request->validated();

        $validated['is_dark'] = isset($request['is_dark']) && $request['is_dark'] == true ? 1 :  0 ;
        $validated['is_reversed'] = isset($request['is_reversed']) && $request['is_reversed'] == true ? 1 :  0 ;

        foreach ( ['background_image' , 'image'] as $input ) {
            if ( $request->hasFile( $input ) && $request->file( $input )->isValid() && request($input) != false ){
                $validated[$input] = $request->file( $input )->store('sliders' , 'public');
            } 
        } 
        
        $mainSlider = MainSlider::create($validated);
        
        return redirect()->route('dashboard.slider.index' )->with(['success' => __('Done Successfully')]);
    }

    /**
     * Display the specified resource.
     */
    public function show(MainSlider $mainSlider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MainSlider $mainSlider)
    {
        $slider = $mainSlider;
        return view('dashboard.main-sliders.edit' , compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MainSliderRequest $request, MainSlider $mainSlider)
    {
        $validated = $request->validated();

        $validated['is_dark'] = isset($request['is_dark']) && $request['is_dark'] == true ? 1 :  0 ;
        $validated['is_reversed'] = isset($request['is_reversed']) && $request['is_reversed'] == true ? 1 :  0 ;

        foreach ( ['background_image' , 'image'] as $input ) {
            if ( isset( $mainSlider[$input] ) && Storage::disk('public')->exists( $mainSlider[$input] ) ) {
                Storage::disk('public')->delete( $mainSlider[$input] );
            }

            if ( $request->hasFile( $input ) && $request->file( $input )->isValid() && request($input) != false ){
                $validated[$input] = $request->file( $input )->store('sliders' , 'public');
            } 
        } 
        
        $mainSlider->update($validated);
        
        return redirect()->route('dashboard.slider.index' )->with(['success' => __('Done Successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MainSlider $mainSlider)
    {
        $mainSlider->delete();
        return redirect()->route('dashboard.slider.index' )->with(['success' => __('Done Successfully')]);
    }

    public function toggleStatus(Request $request)
    {
        $model = MainSlider::findOrFail($request->modelId);

        // Toggle the status
        $model->status = !$model->status;
        $model->save();

        return response()->json(['success' => true]);
    }

}
