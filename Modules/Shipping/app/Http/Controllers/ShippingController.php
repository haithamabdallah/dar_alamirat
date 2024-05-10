<?php

namespace Modules\Shipping\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Shipping\app\ViewModels\ShippingViewModel;
use Modules\Shipping\Http\Requests\StoreShippingRequest;
use Modules\Shipping\Http\Requests\UpdateShippingRequest;
use Modules\Shipping\Models\Shipping;
use Modules\Shipping\Services\ShippingService;

class ShippingController extends Controller
{
    protected $shippingService;

    public function __construct(ShippingService $shippingService)
    {
        $this->shippingService = $shippingService;
//        $this->middleware('permission:shippings.read,admin', ['only' => ['index']]);
//        $this->middleware('permission:shippings.create,admin', ['only' => ['create', 'store']]);
//        $this->middleware('permission:shippings.edit,admin', ['only' => ['edit', 'update']]);
//        $this->middleware('permission:shippings.delete,admin', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shippings = $this->shippingService->getPaginatedData();
        return view('dashboard.shippings.index', compact('shippings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.shippings.form', new ShippingViewModel());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShippingRequest $request)
    {
        $shipping = $this->shippingService->storeData($request->validated());

        if ($shipping){
            Session()->flash('success', 'Shipping Created Successfully');
        }else{
            Session()->flash('error', 'Shipping didn\'t Created');
        }

        return redirect()->route('shipping.index');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('shipping::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shipping $shipping)
    {
        return view('dashboard.shippings.form', new ShippingViewModel($shipping));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShippingRequest $request, Shipping $shipping)
    {
        $shipping = $this->shippingService->updateData($request->validated() , $shipping);

        if ($shipping){
            Session()->flash('success', 'Shipping Created Successfully');
        }else{
            Session()->flash('error', 'Shipping didn\'t Created');
        }

        return redirect()->route('shipping.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shipping $shipping)
    {
        $shipping->delete();
        Session()->flash('success', 'Category Deleted Successfully');
        return redirect()->back();
    }

    public function changeStatus(Request $request,Shipping $shipping)
    {
        $shipping->update(['status' => $request->status]);
        return response()->json(['message' => 'Status Changed Successfully'], 200);
    }
}
