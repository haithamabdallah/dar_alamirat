<!-- order summary -->
<div class="order_summary">
    <div class="collapse" id="allSummary">
        <div class="checkout_summary">
            <div class="item">
                <h6> {{ __("Subtotal") }}</h6>
                <span id="cart-total"> {{ $cartTotal ?? '' }} </span> <b>{{ $currency }}</b>
            </div>
            <div class="item">
                <h6> {{ __("Shipping Cost") }}</h6>
                <span id="shipping-cost"> </span> <b>{{ $currency }}</b>
            </div>
            <div class="item">
                @php
                    $vatVal = $settings->keyBy('type')['general']->value['vat'] ?? 0; // used in js code
                    $vat = ($vatVal / 100) * $cartTotal;
                @endphp
                <h6> {{ __("VAT") }} ( {{ $vatVal . '%' }} ) </h6>
                <span id="vat">{{ $vat }}</span> <b>{{ $currency }}</b>
            </div>
        </div>
    </div>
    <div class="item_coupons">
        <h6> {{ __("Total Order") }}</h6>
        <span id="order-total"> </span> <b>{{ $currency }}</b>
    </div>
    <div class="has_coupons">
        <a class="" data-bs-toggle="collapse" href="#couponCode" role="button" aria-expanded="false"
            id="coupon-code-btn" aria-controls="couponCode">
             {{ __("Have Coupon") }} {{ __("?") }}
        </a>
        <div class="collapse" id="couponCode">
            <form>
                <input type="text" placeholder="Apply Coupon" id="coupon-code" name="coupon_code"
                    value="{{ session('coupon')['code'] ?? old('coupon_code') }}">
                <button type="button" onclick="applyCoupon()"> {{ __("Apply") }}</button>
            </form>
        </div>
        <p id="coupon-details-div" style="display: none"> <span class="text-success">  {{ __("Successful Coupon") }} </span> <br>
            <span id="coupon-details"> </span> </p>
        <div id="invalid-coupon" style="display: none"> <span class="text-danger"> {{ __("Invalid Coupn") }} </span> </div>

    </div>

</div>
<a class="checkout_invoice" data-bs-toggle="collapse" href="#allSummary" role="button" aria-expanded="false"
    aria-controls="allSummary">
    <span> {{ __("Invoice Details") }}</span>
</a>
<!-- ./order summary -->
