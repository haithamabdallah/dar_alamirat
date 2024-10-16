<?php

namespace Modules\Order\Http\Controllers;

use App\Models\User;
use App\Mail\InvoiceMail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Order\Models\Order;
use Illuminate\Support\Facades\DB;
use Modules\Product\Models\Product;
use Modules\Product\Models\Variant;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Modules\Order\Enums\OrderStatus;
use Modules\Order\Enums\PaymentStatus;
use Modules\Shipping\Models\Shipping;
use Modules\Order\Services\OrderService;
use Modules\Order\Http\Requests\StoreOrderRequest;

class OrderController extends Controller
{

    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;

        $this->middleware('checkPermissions:Categories')->only([ 'index' , 'show' , 'create' , 'store' , 'edit' , 'update', 'destroy' ]);
    }

    public function myOrderDetailsPage(Order $order)
    {
        $order->load(['orderDetails.product', 'orderDetails.variant', 'coupon', 'userAddress', 'shippingMethod']);
        return view('themes.' . getAppTheme() . '.profile.my-order-details', compact('order'));
    }

    public function myOrdersPage()
    {
        $orders = Order::where('user_id', auth()->user()->id)->with(['orderDetails.product', 'orderDetails.variant', 'coupon', 'userAddress', 'shippingMethod'])->latest()->paginate(10);
        return view('themes.' . getAppTheme() . '.profile.my-orders', compact('orders'));
    }


    public function checkoutPage()
    {
        $cartTotal = session('final_total');

        $addresses = auth()->user()->addresses;

        $shippings = Shipping::active()->get();

        return view('themes.' . getAppTheme() . '.checkout.checkout', compact('cartTotal', 'addresses', 'shippings'));
    }

    public function checkout(Request $request)
    {
        if ($request->has('final_total') || $request->session()->has('final_total')) {
            if ($request->has('final_total')) {
                $request->session()->put('final_total', $request->final_total);
            }

            return redirect()->route('checkout');
        } else {

            return redirect()->route('cart.index')->with('error', 'Failed to place order. Please try again.');
        }
    }

    public function search(Request $request)
    {
        $validated = $request->validate([
            'user_email' => 'nullable|string|max:255',
            'order_number' => 'nullable|string|max:255',
        ]);

        $orders = Order::query()
            ->when(isset($validated['order_number']) && $validated['order_number'] != null, function ($query) use ($validated) {
                $query->where('order_number', 'like', '%' . $validated['order_number'] . '%');
            })
            ->when(isset($validated['user_email']) && $validated['user_email'] != null, function ($query) use ($validated) {
                $query->whereHas('user', function ($query) use ($validated) {
                    $query->whereRaw('LOWER(email) LIKE ?', ['%' . strtolower($validated['user_email']) . '%']);
                });
            })
            ->get();

        $isNotPaginated = true;

        $orderStatuses = OrderStatus::getAll();
        $paymentStatuses = PaymentStatus::getAll();

        return view('dashboard.orders.search', compact('orders', 'paymentStatuses', 'orderStatuses', 'isNotPaginated'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $orders = Order::with(['products','user','shippingMethod'])->latest()->paginate(10);
        $orders = Order::with(['products', 'user', 'shippingMethod'])->latest()->paginate(20);
        $orderStatuses = OrderStatus::getAll();
        $paymentStatuses = PaymentStatus::getAll();

        return view('dashboard.orders.search', compact('orders', 'paymentStatuses', 'orderStatuses'));
    }

    public function all()
    {
        $orders = Order::with(['products', 'user', 'shippingMethod'])->latest()->get();
        $orderStatuses = OrderStatus::getAll();
        $paymentStatuses = PaymentStatus::getAll();
        return view('dashboard.orders.orders', compact('orders', 'paymentStatuses', 'orderStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $products=Product::with(['variants','inventory'])->get();
        // $clients=User::get();
        // $shippingMethods=Shipping::get();

        // return view('dashboard.orders.create_order',compact('products','clients','shippingMethods'));
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
            $order = $this->orderService->createCheckoutOrder($validatedData);

            Mail::to(auth()->user()->email)->send(new InvoiceMail($order));

            return redirect()->route('index')->with('success', 'Order placed successfully.');
        } catch (\Exception $e) {
            return dd($e->getMessage());
            // return redirect()->route('index')->with('error', 'Failed to place order. Please try again.');
        }
    }

    /**
     * Show the specified resource.
     */
    public function show(Order $order)
    {
        $paymentStatuses = PaymentStatus::getValues();
        $orderStatuses = OrderStatus::getValues();
        $order->load(['orderDetails.product', 'orderDetails.variant', 'coupon', 'userAddress', 'shippingMethod']);
        return view('dashboard.orders.order_details', compact('order', 'paymentStatuses', 'orderStatuses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // return view('order::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validedData = $request->validate([
            'status' => 'required|in:' . implode(',', OrderStatus::getValues()),
            'payment_status' => 'required|in:' . implode(',', PaymentStatus::getValues()),
        ]);

        $order->update($validedData);

        return redirect()->route('order.index')->with('success', 'Updated Successfully.');
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
