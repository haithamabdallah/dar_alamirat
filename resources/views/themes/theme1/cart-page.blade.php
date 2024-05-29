@extends('themes.theme1.layouts.app')
@section('content')

@if (!empty($cart) && count($cart) > 0)
<section class="user_cart">
    <div class="pixel-container">
        <!-- row -->
        <div class="wrap">
            <!-- content -->
            <div class="s-block cart_content">
                <!-- main -->
                <main>

                    <!-- Items In cart -->
                    <div class="items_in_cart">
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

                                <!-- quantity -->
                                <div class="quantity-control">
                                    <button id="decrement">-</button>
                                    <input type="number" id="quantity" value="1" min="1">
                                    <button id="increment">+</button>
                                </div>
                                <!-- ./quantity -->

                                <!-- total price -->
                                <div class="price">Total Price: <span id="price">10.99</span></div>
                                <!-- ./total price -->

                            </div>
                            <!-- data -->

                            <!-- variants -->
                            <div class="variants">
                                <label class="title" for="Variant">Choose Product</label>
                                <select id="variant">
                                    <option value="100ml">100ml - Blue</option>
                                    <option value="200ml">200ml - red</option>
                                </select>
                            </div>
                            <!-- variants -->

                        </div>
                        <!-- ./item -->
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

                            <p id="selected-variant"></p>

                            <p id="variant-price-summary"></p>

                            <p id="quantity-summary"></p>

                            <p id="item-total-price"></p>

                            <div class="coupons">
                                <label for="apply_coupons">Do you have a promo code?</label>
                                <div class="apply">
                                    <input type="text" placeholder="Apply Coupon">
                                    <button type="submit">Apply</button>
                                </div>
                            </div>

                            <p id="final-total"><b>Final Total:</b><span id="final-total-price"></span></p>

                            <p class="vat">VAT Inclusive</p>

                            <button class="place_order" type="submit">Submit Order</button>
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
                        <a href="{{route('index')}}" class="btn btn--outline-primary">Back home</a>
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
