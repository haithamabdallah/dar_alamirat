<?php

namespace Modules\Order\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Order\Models\Order;
use Illuminate\Support\Facades\DB;
use Modules\Product\Models\Product;
use Modules\Product\Models\Variant;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Shipping\Models\Shipping;
use Modules\Order\Services\OrderService;
use Modules\Order\Http\Requests\StoreOrderRequest;

class OrderController extends Controller
{

    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    

    public function checkoutPage()
    {
        $cartTotal = session('final_total');
            
        $addresses = auth()->user()->addresses;
        
        $shippings = Shipping::active()->get();

        return view('themes.theme1.checkout.checkout' , compact('cartTotal' , 'addresses' , 'shippings'));
    }

    public function checkout(Request $request)
    {
        if ($request->has('final_total') || $request->session()->has('final_total')) {
        if ($request->has('final_total') ) {
            $request->session()->put('final_total', $request->final_total);
        }
            
        return redirect()->route('checkout');

        } else {

            return redirect()->route('cart.index')->with('error', 'Failed to place order. Please try again.');
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['products','user','shippingMethod'])->paginate(10);


        return view('dashboard.orders.orders',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products=Product::with(['variants','inventory'])->get();
        $clients=User::get();
        $shippingMethods=Shipping::get();

        return view('dashboard.orders.create_order',compact('products','clients','shippingMethods'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request): RedirectResponse // from dashboard
    {
        $validatedData = $request->validated();

        try {
            $this->orderService->createOrder($validatedData);

            return redirect()->route('order.index')->with('success', 'Order placed successfully.');
        } catch (\Exception $e) {
            return redirect()->route('order.index')->with('error', 'Failed to place order. Please try again.');
        }


    }

    public function storeCheckout(Request $request) // from checkout page
    {
        $validatedData = $request->validate([
            "address_id" => "required|exists:user_addresses,id",
            "shipping_id" => "required|exists:shippings,id",
            'coupon_id' => 'nullable|exists:coupons,id',
        ]);

        try {
            $this->orderService->createCheckoutOrder($validatedData);

            return redirect()->route('index')->with('success', 'Order placed successfully.');
        } catch (\Exception $e) {
            return dd($e->getMessage());
            // return redirect()->route('index')->with('error', 'Failed to place order. Please try again.');
        }


    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('order::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('order::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
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


    public function getVariants(Request $request)
    {
        $productId = $request->input('product_id');
        $variants = Variant::where('product_id', $productId)->get();

        return response()->json($variants);
    }

}
