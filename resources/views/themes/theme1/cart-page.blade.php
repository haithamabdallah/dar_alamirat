@extends('themes.theme1.layouts.app')
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
                                <!-- Items In cart -->
                                <div class="items_in_cart">
                                    <div class="d-none" id="cart-id-{{ $index }}" data-id="{{ $cart->id }}"></div>

                                    <!-- item -->
                                    <div class="alert item_cart alert-dismissible fade show" role="alert">
                                        <!-- data -->
                                        <div class="entries">

                                            {{-- <a class="removeItem" href="javascript:;" data-bs-dismiss="alert"
                                            aria-label="Close"><i class="fa-solid fa-xmark"></i></a> --}}

                                            <form action="{{ route('cart.destroy', $cart->id) }}" method="POST"
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
                                                    <a
                                                        href="{{ route('product', $cart->product->id) }}">{{ $cart->product->title }}</a>
                                                    <div class="variant-price">Variant Price: <span
                                                            id="variant-price-{{ $index }}">{{ $cart->product->price }}</span>
                                                        {{ $currency }}
                                                    </div>
                                                </h2>
                                            </div>
                                            <!-- img and title -->

                                            <!-- quantity -->
                                            <div class="quantity-control">
                                                <button id="decrement-{{ $index }}">-</button>
                                                <input type="number" id="quantity-{{ $index }}"
                                                    value="{{ intval($cart->quantity) }}" min="1" readonly>

                                                <button id="increment-{{ $index }}">+</button>
                                            </div>
                                            <!-- ./quantity -->

                                            <!-- total price -->
                                            <div class="price">Total Price:
                                                <span id="price-{{ $index }}"> {{ $cart->product->price }}
                                                </span>
                                            </div>
                                            <!-- ./total price -->
                                        </div>

                                        <!-- data -->

                                        <!-- variants -->
                                        <div class="variants">
                                            <label class="title" for="Variant">Choose Product</label>
                                            <select id="variant-{{ $index }}">
                                                @foreach ($cart->product->variants as $variant)
                                                    <option value="{{ $variant->id }}"
                                                        {{ $cart->variant_id == $variant->id ? 'selected' : 'null' }}>
                                                        {{ $variant->variant_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @foreach ($cart->product->variants as $variant)
                                                {{-- <div class="d-none" id="inventory-quantity-{{ $variant->id }}"
                                                    data-quantity="{{ $variant->inventory->quantity }}"></div>
                                                    --}}
                                                <div class="d-none" id="inventory-quantity-{{ $variant->id }}"
                                                    data-quantity="{{ $variant->inventory_quantity }}"></div>
                                            @endforeach
                                        </div>
                                        <!-- variants -->

                                    </div>
                                    <!-- ./item -->
                            @endforeach
                    </div>
                    <!-- ./Items in Cart -->
                    </main>
                    <!-- .main -->

                    <!-- aside -->
                    <aside>
                        <!-- stick on scroll -->
                        <div class="sticky-top">
                            <!-- summary -->
                            <div class="order-summary">
                                <h6>Order Summary</h6>

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

                                <p id="final-total"><b>Final Total:</b><span id="final-total-price" ></span></p>

                                <div class="coupons">
                                    <label for="apply_coupons">Do you have a promo code?</label>
                                    <div class="apply">
                                        <input type="text" placeholder="Apply Coupon" id="coupon-code" name="coupon_code" value="{{ session('coupon')['code'] ?? old('coupon_code')  }}">
                                        <button onclick="applyCoupon()">Apply</button>
                                    </div>
                                </div>

                                <p id="final-after-discount" style="display: none"> <span class="text-success">Successful Coupon </span> <br> <b>Final After Discount: </b> <span id="final-after-discount-price" > </span> </p>
                                <div id="invalid-coupon" style="display: none"> <span class="text-danger">Invalid Coupn </span> </div>


                                <p class="vat">VAT Inclusive</p>

                                <form action="{{ route('order.checkout') }}" method="POST" id="final-total-form">
                                    @csrf
                                    <input type="hidden" name="final_total" id="final-total-input" value="">
                                </form>
                                <button class="place_order" id="final-total-btn">Submit Order</button>
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
                                <p>Empty Cart</p>
                                <a href="{{ route('index') }}" class="btn btn--outline-primary">Back home</a>
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
    @include('themes.theme1.cart-page-scripts')
@endsection
