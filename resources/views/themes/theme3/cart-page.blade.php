@php
    // dd(session()->get('carts'));
    // dd($carts);
    // dd($prices);
@endphp

@extends('themes.theme3.layouts.app')

@section('customcss')
    <style>
        .hidden {
            display: none;
        }

        #variant-form {
            display: flex;
            grid-gap: 10px;

        }

        .variant-option input {
            display: none;
        }
        .variant-option label {
            display: flex;
            flex-direction: column;
            grid-gap: 5px;
            align-items: center;
            justify-content: center;
            padding: 10px 20px;
            border: 1px solid #eee;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .variant-option label:hover {
            border-color: #5E6FB4;
        }

        .variant-option input:checked + label {
            border: 1px solid #5E6FB4;
            color: #5E6FB4;
        }

        .variant-option label img {
            max-width: 50px; /* Adjust image size as needed */
            max-height: 50px; /* Adjust image size as needed */
            vertical-align: middle;
            margin-right: 10px; /* Adjust spacing between image and text */
        }
    </style>
@endsection

@section('content')
    @if (!empty($carts) && count($carts) > 0)
        <section class="user_cart">
            <div class="pixel-container">
                <!-- row -->
                <div class="wrap">
                    <!-- content -->
                    <div class="s-block cart_content">
                        <!-- main -->
                        <main>
                            @foreach ($carts as $index => $cart)
                                <div class="items_in_cart">
                                    @if ( auth()->check() )
                                        <div class="d-none" id="cart-id-{{ $index }}" data-id="{{ $cart->id }}"></div>
                                    @endif

                                    <!-- item -->
                                    <div class="alert item_cart alert-dismissible fade show" role="alert">
                                        <!-- data -->
                                        <div class="entries">

                                            {{-- <a class="removeItem" href="javascript:;" data-bs-dismiss="alert"
                                            aria-label="Close"><i class="fa-solid fa-xmark"></i></a> --}}

                                            <form action="{{ auth()->check() ? route('cart.destroy', $cart->id) : route('guest.cart.destroy', [ 'productId' => $cart->product_id , 'index' => $index]) }}" method="POST"
                                                id="delete-form-{{ $index }}" data-index="{{ $index }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button class="removeItem"
                                                onclick="event.preventDefault(); removeItemFromCart({{ $index }})"><i
                                                    class="fa-solid fa-xmark"></i></button>

                                            <div class="d-none" id="product-id-{{ $index }}"
                                                data-id="{{ $cart->product->id }}">
                                            </div>

                                            <div class="d-none" id="product-title-{{ $index }}"
                                                data-title="{{ $cart->product->title }}"></div>

                                        </div>

                                        <div class="entries">
                                            <!-- img and title -->
                                            <div class="itemInfo">
                                                <a href="#">
                                                    <img class="w-full object-contain"
                                                        src="{{ $cart->product->thumbnail }}" alt="product image">
                                                </a>

                                                <h2>
                                                    <a href="{{ route('product', $cart->product->id) }}">{{ $cart->product->title }}</a>
                                                    <div class="variant-price">
                                                        <span id="variant-price-{{ $index }}">{{ $cart->product->price }}</span>
                                                        {{ $currency }}
                                                    </div>
                                                </h2>
                                            </div>
                                            <!-- img and title -->

                                            <!-- quantity -->
                                            <div class="quantity-control">
                                                <button id="decrement-{{ $index }}">-</button>
                                                <input class="quantity" type="number" id="quantity-{{ $index }}"
                                                    value="{{ intval($cart->quantity) }}" min="1" readonly>

                                                <button id="increment-{{ $index }}">+</button>
                                            </div>
                                            <!-- ./quantity -->

                                            <!-- total price -->
                                            <div class="price">{{ __("Total Price") }}:
                                                <span id="price-{{ $index }}"> {{ $cart->product->price }} </span> {{ $currency }}
                                            </div>
                                            <!-- ./total price -->
                                        </div>

                                        <div class="select-option" {!! $cart->product?->variants()->count() > 1 ? '' : 'style="display: none"' !!}>
                                            <h3> {{ __('Please select one of the options') }}<span>*</span></h3>
                                            <form id="variant-form">
                                                @foreach ($cart->product?->variants as  $variantIndex => $variant)
                                                    <div class="variant-option">
                                                        <input type="radio" id="variant-{{ $index }}-{{ $variantIndex }}" class="variant-{{ $index }}" name="variant-{{ $index }}" value="{{ $variant->id }}" 
                                                            @if ($cart->variant_id && $cart->variant_id == $variant->id) checked 
                                                            @endif
                                                            >
                                                        <label for="variant-{{ $index }}-{{ $variantIndex }}">
                                                            @if ($variant->images->count() > 0)
                                                                <img src="{{ $variant->images[0]->image }}" alt=""> <!-- Replace with your actual image URL -->
                                                            @endif
                                                            <span>{{ $variant->variantName }}</span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </form>
                                        </div>
                                    </div>

                                    </div>
                                    <!-- ./item -->
                            @endforeach
                    </main>
                    <!-- .main -->

                    <!-- aside -->
                    <aside>
                        <!-- stick on scroll -->
                        <div class="sticky-top">
                            <!-- summary -->
                            <div class="order-summary">
                                <h6>{{ __("Order Summary") }}</h6>

                                {{-- <div class="final-total">
                                    <p id="final-total"><b>Final Total:</b><span id="final-total-up"></span></p>
                                </div> --}}

                                @foreach ($carts as $index => $cart)
                                    <div class="item-summary">
                                        <p id="selected-product-{{ $index }}"></p>

                                        <p id="selected-variant-{{ $index }}"></p>

                                        <p id="variant-price-summary-{{ $index }}"></p>

                                        <p id="quantity-summary-{{ $index }}"></p>

                                        <p id="item-total-price-{{ $index }}"></p>

                                        <div class="" style="background-color: #cccccc ; height: 5px ; width: 100%">
                                        </div>
                                    </div>
                                @endforeach

                                <p id="final-total"><b>{{ __("Final Total") }}:</b><span id="final-total-price" ></span></p>
                                @auth
                                    <div class="coupons">
                                        <label for="apply_coupons">{{ __("Have Coupon") }} {{ __("?") }}</label>
                                        <div class="apply">
                                            <input type="text" placeholder="Apply Coupon" id="coupon-code" name="coupon_code" value="{{ session('coupon')['code'] ?? old('coupon_code')  }}">
                                            <button onclick="applyCoupon()">{{ __("Apply") }}</button>
                                        </div>
                                    </div>

                                    <p id="coupon-details-div" style="display: none"> <span class="text-success"> {{ __("Successful Coupon") }} </span> <br> <span id="coupon-details" > </span> </p>
                                    <div id="invalid-coupon" style="display: none"> <span class="text-danger"> {{ __("Invalid Coupn") }} </span> </div>


                                    {{-- <p class="vat">{{ __("VAT Inclusive") }}</p> --}}

                                    <form action="{{ route('order.checkout') }}" method="POST" id="final-total-form" style="display: none">
                                        @csrf
                                        <input type="hidden" name="final_total" id="final-total-input" value="">
                                    </form>
                                    <button class="place_order" id="final-total-btn">{{ __("Submit Order") }}</button>
                                @endauth

                                @guest
                                    <div class="text-center  p-2 rounded" style="color: #5e6fb4; font-weight: bold" >
                                        {{ __("Please login to use coupons and to checkout.") }}
                                    </div>
                                    <button type="button" class="text-center text-white p-2 rounded" style="background-color: #5e6fb4; font-weight: bold ; width:100% !important"
                                    id="save-cart-options">{{ __("Save Cart Options") }}</button>
                                    <button type="button" class="text-center text-white bg-success p-2 rounded" style="display: none; font-weight: bold ; width:100% !important"
                                        id="cart-options-saved">{{ __("Saved") }}</button>

                                @endguest
                            </div>
                            <!-- summary -->
                        </div>
                        <!-- stick on scroll -->
                    </aside>
                    <!-- ./aside -->
                </div>
                <!-- ./content -->
            </div>
            <!-- ./row -->
            </div>
        </section>
    @else
        <!-- no content -->
        <!-- no content -->
        <section id="full-layout">
            <div class="pixel-container">
                <!-- row -->
                <div class="wrap">
                    <!-- content -->
                    <main>
                        <div class="main-content">
                            <div class="no-content-placeholder">
                                <i class="sicon-shopping-bag icon"></i>
                                <p>{{ __("Empty Cart") }}</p>
                                <a href="{{route('index')}}" class="btn btn--outline-primary">{{ __("Home Page") }}</a>
                            </div>
                        </div>
                    </main>

                    <!-- .content -->
                </div>
                <!-- ./row -->
            </div>
        </section>
        <!-- no content -->
    @endif
@endsection

@section('scripts')
    @include('themes.theme3.cart-page-scripts')
@endsection
