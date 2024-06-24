<!-- order summary -->
<div class="order_summary">
    <div class="collapse" id="allSummary">
        <div class="checkout_summary">
            <div class="item">
                <h6>Subtotal</h6>
                <span id="cart-total"> {{ $cartTotal }} </span> <b>{{ $currency }}</b>
            </div>
            <div class="item">
                <h6>Shipping Cost</h6>
                <span id="shipping-cost">16.48 </span> <b>{{ $currency }}</b>
            </div>
            <div class="item">
                <h6>VAT</h6>
                <span id="vat">6.76 </span> <b>{{ $currency }}</b>
            </div>
        </div>
    </div>
    <div class="item_coupons">
        <h6>Total Order</h6>
        <span id="order-total">54.25 </span> <b>{{ $currency }}</b>
    </div>
    <div class="has_coupons">
        <a class="" data-bs-toggle="collapse" href="#couponCode" role="button" aria-expanded="false"
            aria-controls="couponCode">
            Have Coupon?
        </a>
        <div class="collapse" id="couponCode">
            <form action="">
                <input type="text" placeholder="Enter the coupon code">
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

</div>
<a class="checkout_invoice" data-bs-toggle="collapse" href="#allSummary" role="button" aria-expanded="false"
    aria-controls="allSummary">
    <span>Invoice Details</span>
</a>
<!-- ./order summary -->
