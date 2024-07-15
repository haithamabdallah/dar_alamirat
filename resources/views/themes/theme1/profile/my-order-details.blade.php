{{-- @php
    dd($order);
@endphp --}}

@extends('themes.theme1.layouts.app')

@section('customcss')
@endsection

@section('content')
    <!-- cover -->
    <section class="user-cover">
        <div class="pixel-container">
            <div class="wrap">
                <div class="cover-contents">
                    <!-- breadcrumbs container-->
                    <div class="pixel-container">
                        <!-- row -->
                        <div class="wrap">
                            <!-- content -->

                            <ul class="breadcrumbs">
                                <li>
                                    <a href="{{ route('index') }}">
                                        <span>{{ __("Home") }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <span>{{ __("Order Detials") }}</span>
                                    </a>
                                </li>

                            </ul>
                            <!-- ./content -->
                        </div>
                        <!-- ./row -->
                    </div>
                    <!-- ./breadcrumbs container-->
                </div>
            </div>
        </div>
    </section>
    <!-- ./cover -->

    <!-- user-layout -->
    <section class="user-page-layout">
        <div class="pixel-container">
            <div class="wrap">
                <div class="user-layout">
                    @include('themes.theme1.profile.profile_aside')
                    <main>
                        <h1>{{ __("Order") }}</h1>
                        <div class="bg-white p-4 my-4 shadow rounded">
                            <div> {{ __("Order Status") }} : <span>{{ $order->status }}</span> </div>
                            <div> {{ __("Final Price") }} : <span>{{ $order->final_price }}</span> </div>
                            <div> {{ __("Order Payment Status") }} : <span>{{ $order->payment_status }}</span> </div>
                            <div> {{ __("Order Payment Method") }} : <span> Cash On Delivery</span> </div>
                            @php
                                $address = $order->userAddress;
                            @endphp
                            <div> {{ __("Order Address") }} :
                                <ul>
                                    <li> {{ __("Governorate") }} : {{ $address->governorate }}</li>
                                    <li> {{ __("City") }}: {{ $address->city }}</li>
                                    <li> {{ __("Street") }} : {{ $address->street }}</li>
                                    <li> {{ __("House Number") }} : {{ $address->house_number }}</li>
                                </ul>
                            </div>
                            @if ($order?->coupon)
                                <div> {{ __("Applied Coupon") }} :
                                    <ul>
                                        <li>{{ __("Code") }} : {{ $order->coupon->code }}</li>
                                        <li>{{ __("Type") }} : {{ $order->coupon->discount_type }}</li>
                                        <li>{{ __("Value") }} : {{ $order->coupon->discount_value }}</li>
                                    </ul>
                                </div>
                            @endif
                            <!-- order products -->
                            @foreach ($order->orderDetails as $orderDetials)
                                
                            <div> {{ __("Product Name") }} : <a href="{{ route('product', $orderDetials->product->id) }}"
                                    target="_blank">
                                    <span>{{ $orderDetials->product->title }} (
                                        {{ $orderDetials->variant->variant_name }} )</span>
                                </a> </div>
                            <div> {{ __("Variant") }} : <span> {{ $orderDetials->variant->variant_name }}
                                </span> </div>
                            <div> {{ __("Variant SKU") }}: <span>
                                    {{ $orderDetials->variant->sku }} </span> </div>
                            <div> {{ __("Unit Price") }} : <span>{{ $orderDetials->price }}</span> </div>
                            <div>{{ __("Quantity") }} : <span>{{ $orderDetials->quantity }}</span> </div>
                            <div> {{ __("Total Price") }} :
                                <span>{{ $orderDetials->price * $orderDetials->quantity }}</span>
                            </div>
                            @endforeach
                        </div>
                        {{-- <!-- If Empty Page -->
                            <div class="no-content-placeholder">
                                <i class="sicon-packed-box icon"></i>
                                <p>No orders found</p>
                            </div>
                            <!-- If Empty Page --> --}}

                        <!-- my order lists -->
                        {{-- <div class="my_orders_items">

                        <!-- item -->
                        <div class="alert item_cart alert-dismissible fade show" role="alert">
                            <!-- data -->
                            <div class="entries">

                                <a class="removeItem" href="javascript:;" data-bs-dismiss="alert" aria-label="Close"><i class="fa-solid fa-xmark"></i></a>

                                <!-- img and title -->
                                <div class="itemInfo">
                                    <a href="#">
                                        <img class="w-full object-contain" src="images/products/01.png" alt="">
                                    </a>

                                    <h2>
                                        <a href="#">PharmStay - Complete Hydrogel Collagen Eye Patch</a>
                                        <div class="variant-price">Variant Price: <span id="variant-price">10.99</span></div>
                                    </h2>
                                </div>
                                <!-- img and title -->

                                <!-- total price -->
                                <div class="price">Total Price: <span id="price">10.99</span></div>
                                <!-- ./total price -->

                            </div>
                            <!-- data -->

                            <!-- variants -->
                            <div class="variants my_orders">
                                <label class="title" for="Variant">Quantity : <span>1</span></label>
                                <label class="title" for="Variant">Choose Product : <span>100ml - Blue</span></label>
                                <label class="status delivered" for="Variant"> delivered</label>
                            </div>
                            <!-- variants -->

                        </div>
                        <!-- ./item -->

                    </div> --}}
                        <!-- ./my order lists -->

                    </main>
                </div>
            </div>
        </div>
    </section>
    <!-- ./user-layout -->
@endsection

@section('scripts')
@endsection
