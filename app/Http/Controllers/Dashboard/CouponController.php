<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::latest()->paginate(20);

        return view('dashboard.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CouponRequest $request)
    {
        $validated = $request->validated();

        Coupon::create($validated);

        return redirect()->route('dashboard.coupons.index')->with('success', 'Saved Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        return view('dashboard.coupons.edit' , compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CouponRequest $request, Coupon $coupon)
    {
        $validated = $request->validated();

        $coupon->update($validated);

        return redirect()->route('dashboard.coupons.index')->with('success', __('Done Successfully.'));
    }

    public function toggleStatus(Request $request)
    {
        $model = Coupon::findOrFail($request->modelId);

        // Toggle the status
        $model->status = !$model->status;
        $model->save();

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        //
    }
}
