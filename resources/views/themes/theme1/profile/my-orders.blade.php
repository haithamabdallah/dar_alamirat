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
                                        <span>{{ __('Home') }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <span>{{ __('My Orders') }}</span>
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
                        <h1>{{ __('My Orders') }}</h1>
                        {{-- @forelse ($orders as $order)
                            <div><a href="{{ route('order.my.details', $order->id) }}"> {{ __("Order Detials Page") }}</a></div>
                            <div class="bg-white p-4 my-4 shadow rounded">
                                <div>  {{ __("Order Number") }}: <span>{{ $order->order_number }}</span> </div>
                                <div>  {{ __("Order Status") }}: <span>{{ $order->status }}</span> </div>
                                <div>  {{ __("Final Price") }}: <span>{{ $order->final_price }}</span> </div>
                                <div> {{ __("Order Payment Status") }} : <span>{{ $order->payment_status }}</span> </div>
                                <div>  {{ __("Order Payment Method") }}: <span> {{ __("Cash On Delivery") }}</span> </div>
                                <div>  {{ __("Created At") }}: <span> {{ $order->created_at->format('Y-m-d h:i A') }} </span> </div>
                                @php
                                    $address = $order->userAddress;
                                @endphp
                                <div> {{ __("Order Address") }} :
                                    <ul>
                                        <li> {{ __("Governorate") }} : {{ $address->governorate }}</li>
                                        <li> {{ __("City") }} : {{ $address->city }}</li>
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
                                @foreach ($order->orderDetails as $orderDetails)
                                    <div>  {{ __("Product Name") }}: <a href="{{ route('product', $orderDetails->product->id) }}"
                                            target="_blank">
                                            <span>{{ $orderDetails->product->title }} (
                                                {{ $orderDetails->variant->variant_name }} )</span>
                                        </a> </div>
                                    <div>  {{ __("Variant") }}: <span> {{ $orderDetails->variant->variant_name }}
                                        </span> </div>
                                    <div> {{ __("Variant SKU") }}: <span>
                                            {{ $orderDetails->variant->sku }} </span> </div>
                                    <div>  {{ __("Unit Price") }}: <span>{{ $orderDetails->price }}</span> </div>
                                    <div>  {{ __("Quantity") }}: <span>{{ $orderDetails->quantity }}</span> </div>
                                    <div>  {{ __("Total Price") }}:
                                        <span>{{ $orderDetails->price * $orderDetails->quantity }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @empty
                            <!-- If Empty Page -->
                            <div class="no-content-placeholder">
                                <i class="sicon-packed-box icon"></i>
                                <p>{{ __("No Orders Founded") }}</p>
                            </div>
                            <!-- If Empty Page -->
                        @endforelse --}}

                        <!-- my order lists -->
                        @forelse ($orders as $order)
                            <div class="single_order my_orders_items">

                                <!-- item -->
                                <div class="alert item_cart alert-dismissible fade show" role="alert">

                                    <div class="order-header">
                                        <div> {{ __('Order Number') }}: <span>{{ $order->order_number }}</span> </div>
                                        <div> {{ __('Created At') }}: <span>
                                                {{ $order->created_at->format('Y-m-d h:i A') }} </span> </div>
                                    </div>

                                    @foreach ($order->orderDetails as $orderDetails)
                                        <!-- data -->
                                        <div class="entries">

                                            {{-- <a class="removeItem" href="javascript:;" data-bs-dismiss="alert" aria-label="Close"><i class="fa-solid fa-xmark"></i></a> --}}

                                            <!-- img and title -->
                                            <div class="itemInfo">
                                                <a href="{{ route('product', $orderDetails->product->id) }}">
                                                    <img class="w-full object-contain"
                                                         loading="lazy" src="{{ $orderDetails->product->thumbnail }} " alt="">
                                                </a>

                                                <h2>
                                                    <a href="{{ route('product', $orderDetails->product->id) }}">{{ $orderDetails->product->title }}
                                                        ( {{ $orderDetails->variant->variant_name }} )</a>
                                                    <div class="variant-price">{{ __('Variant') }}: <span
                                                            id="variant-price">{{ $orderDetails->variant->variant_name }}</span>
                                                    </div>
                                                    <div class="variant-price"> {{ __('Unit Price') }}:
                                                        <span>{{ $orderDetails->price }}</span> </div>
                                                    <div class="variant-price"> {{ __('Quantity') }}:
                                                        <span>{{ $orderDetails->quantity }}</span> </div>
                                                    <div class="variant-price"> {{ __('Variant SKU') }}: <span>
                                                            {{ $orderDetails->variant->sku }} </span> </div>
                                                </h2>
                                            </div>
                                            <!-- img and title -->

                                            <!-- total price -->
                                            <div class="price">{{ __('Total Price') }}: <span
                                                    id="price">{{ $orderDetails->price * $orderDetails->quantity }}</span>
                                            </div>
                                            <!-- ./total price -->

                                        </div>
                                    @endforeach

                                    @if ($order?->coupon)
                                        <div class="py-3"> {{ __('Applied Coupon') }} :
                                            <ul class="order-address">
                                                <li>{{ __('Code') }} : {{ $order->coupon->code }}</li>
                                                <li>{{ __('Type') }} : {{ $order->coupon->discount_type }}</li>
                                                <li>{{ __('Value') }} : {{ $order->coupon->discount_value }}</li>
                                            </ul>
                                        </div>
                                    @endif

                                    <hr>

                                    @php
                                        $address = $order->userAddress;
                                    @endphp
                                    <div class="py-3"> {{ __('Order Address') }} :
                                        <ul class="order-address">
                                            <li> {{ __('Governorate') }} : {{ $address->governorate }}</li>
                                            <li> {{ __('City') }} : {{ $address->city }}</li>
                                            <li> {{ __('Street') }} : {{ $address->street }}</li>
                                            <li> {{ __('House Number') }} : {{ $address->house_number }}</li>
                                        </ul>
                                    </div>

                                    <hr>

                                    <div class="py-3"> {{ __('Price') }} :
                                        <ul class="order-address">
                                            <li> {{ __('VAT') }} : <span>{{ $order->vat }}</span></li>
                                            <li> {{ __('Shipping') }} : <span> {{ $order->shipping_price }}
                                                    {{ $currency }} ( {{ $order->shippingMethod->name }} ) </span>
                                            </li>
                                            <li style="color: #5e6fb4 ; font-weight: bold"> {{ __('Final Price') }} :
                                                <span>{{ $order->final_price }}</span></li>
                                        </ul>
                                    </div>

                                    <div class="order-footer">
                                        <div class="status pending"> {{ __('Order Status') }}:
                                            <span>{{ $order->status }}</span> </div>
                                        <div class="status pending"> {{ __('Order Payment Status') }} :
                                            <span>{{ $order->payment_status }}</span> </div>
                                        <div class="status done"> {{ __('Order Payment Method') }}: <span>
                                                {{ __('Cash On Delivery') }}</span> </div>
                                    </div>

                                    {{-- <div class="">  {{ __("Final Price") }}: <span>{{ $order->final_price }}</span> </div> --}}

                                </div>
                                <!-- ./item -->
                                {{--  we need pagination here  --}}
                            </div>
                            <!-- ./my order lists -->

                        @empty
                            <!-- If Empty Page -->
                            <div class="no-content-placeholder">
                                <i class="sicon-packed-box icon"></i>
                                <p>{{ __('No Orders Founded') }}</p>
                            </div>
                            <!-- If Empty Page -->
                        @endforelse
                        @if ($orders->lastPage() > 1)
                            @include('themes.theme1.partials.pagination' , [ 'items' => $orders ])
                        @endif
                    </main>
                </div>
            </div>
        </div>
    </section>
    <!-- ./user-layout -->
@endsection

@section('scripts')
@endsection
