<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;

class CouponController extends Controller
{
    /**
     * Checks if the coupon is valid 
     */

    public function __construct()
    {
        $this->middleware('checkPermissions:Coupons')->only(['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']);
    }


    public function checkCoupon(Request $request)
    {
        try {
            if (session()->has('coupon')) {
                session()->forget('coupon');
            }
            $coupon = Coupon::where('code', $request->coupon_code)->first();

            if ($coupon) {

                if ($coupon->user_usage_count > $coupon->limit_per_user) {
                    return response()->json(['status' => 'error', 'msg' => "Limit per user is $coupon->limit_per_user & it's reached."]);
                } else if ($coupon->usage_count > $coupon->usage_limit) {
                    return response()->json(['status' => 'error', 'msg' => 'General usage limit is reached.']);
                } else if ($coupon->status != true) {
                    return response()->json(['status' => 'error', 'msg' => 'Coupon is not active now.']);
                }

                $todayDate = date('Y-m-d');

                if ($coupon->start_date <= $todayDate && $coupon->end_date >= $todayDate) {

                    session()->put('coupon', $coupon);
                    return response()->json(['status' => 'success', 'coupon' => $coupon]);
                } else {

                    return response()->json(['status' => 'error', 'msg' => 'coupon expired.']);
                }
            } else {

                return response()->json(['status' => 'error', 'msg' => 'Invalid coupon.']);
            }
        } catch (\Exception $e) {

            return response()->json(['status' => 'error', 'msg' => $e->getMessage()]);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $coupons = Coupon::latest()->paginate(20);
        $coupons = Coupon::latest()->get();

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
        return view('dashboard.coupons.edit', compact('coupon'));
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
