<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dar Alamirat</title>
    <script src="https://kit.fontawesome.com/24eabd5129.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="theme1-assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="theme1-assets/css/checkout.css">
</head>

<body class="checkout_page">

    <!-- checkout -->
    <div id="checkout">
        <!-- container -->
        <div class="container">
            <!-- header -->
            <header class="header">
                <!-- logo -->
                <div class="logo">
                    <a href="">
                        <img src="theme1-assets/images/logo/dar-logo3.svg" alt="">
                    </a>
                </div>
                <!-- ./logo -->

                <!-- heading -->
                <div class="heading">
                    <!-- user -->
                    <div class="user">
                        Hello, <span>{{ auth()->user()->FullName }}</span>
                    </div>
                    <!-- ./user -->
                    <!-- nav -->
                    <ul class="breadcrumb">
                        <li><a href="{{ route('index') }}">Home</a></li>
                        <li><a href="{{ route('cart.index') }}">My Cart</a></li>
                        <li>checkout</li>
                    </ul>
                    <!-- ./nav -->
                </div>
                <!-- ./heading -->
            </header>
            <!--,./header -->

            <!-- order summary -->
            <div class="order_summary">
                <div class="collapse" id="allSummary">
                    <div class="checkout_summary">
                        <div class="item">
                            <h6>Subtotal</h6>
                            <span id="cart-total"> {{ $cartTotal }} </span> <b>{{ $currency }}</b>
                        </div>
                        <div class="item" >
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
            <a class="checkout_invoice" data-bs-toggle="collapse" href="#allSummary" role="button"
                aria-expanded="false" aria-controls="allSummary">
                <span>Invoice Details</span>
            </a>
            <!-- ./order summary -->

            <!-- Payment -->
            <div class="accordion" id="checkoutAccordion">
                <!-- Step 1: Shipping Address -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <div class="title">
                            <b><strong>1</strong> Select Shipping Address</b>
                            <span id="selectedAddressInfo"></span>
                        </div>
                        <button class="btn btn-sm btn-link edit-button" style="display:none;"
                            onclick="editStage(1)">Edit</button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#checkoutAccordion">
                        <div class="accordion-body">
                            <div id="addressList" class="address-list">
                                &lt;!&ndash; Address items will be added here &ndash;&gt;
                            </div>
                            <button class="btn-add" onclick="showNewAddressForm()">
                                <span>Add New Address</span>
                            </button>
                            <div class="new-address-form" id="newAddressForm">
                                <a class="btn-close-address" onclick="cancelNewAddress()"><i
                                        class="fa-solid fa-xmark"></i></a>
                                <div class="grid-list">
                                    <div class="grid-item">
                                        <label for="newCountry" class="form-label">Country</label>
                                        <input type="text" class="form-control" id="newCountry"
                                            placeholder="Enter your country">
                                    </div>
                                    <div class="grid-item">
                                        <label for="newCity" class="form-label">City</label>
                                        <input type="text" class="form-control" id="newCity"
                                            placeholder="Enter your city">
                                    </div>
                                    <div class="grid-item">
                                        <label for="newStreet" class="form-label">Street</label>
                                        <input type="text" class="form-control" id="newStreet"
                                            placeholder="Enter your street">
                                    </div>
                                    <div class="grid-item">
                                        <label for="newPostalCode" class="form-label">Postal Code</label>
                                        <input type="text" class="form-control" id="newPostalCode"
                                            placeholder="Enter your postal code">
                                    </div>
                                    <div class="grid-item">
                                        <label for="newNeighborhood" class="form-label">Neighborhood</label>
                                        <input type="text" class="form-control" id="newNeighborhood"
                                            placeholder="Enter your neighborhood">
                                    </div>
                                    <div class="grid-item">
                                        <label for="newHouseNumber" class="form-label">House Number</label>
                                        <input type="text" class="form-control" id="newHouseNumber"
                                            placeholder="Enter your house number">
                                    </div>
                                </div>
                                <button class="btn-save" onclick="saveNewAddress()">Save Address</button>
                            </div>

                            <div class="edit-address-form" id="editAddressForm">
                                <h3>Edit Address</h3>
                                <div class="mb-3">
                                    <label for="editCountry" class="form-label">Country</label>
                                    <input type="text" class="form-control" id="editCountry"
                                        placeholder="Enter your country">
                                </div>
                                <div class="mb-3">
                                    <label for="editCity" class="form-label">City</label>
                                    <input type="text" class="form-control" id="editCity"
                                        placeholder="Enter your city">
                                </div>
                                <div class="mb-3">
                                    <label for="editStreet" class="form-label">Street</label>
                                    <input type="text" class="form-control" id="editStreet"
                                        placeholder="Enter your street">
                                </div>
                                <div class="mb-3">
                                    <label for="editPostalCode" class="form-label">Postal Code</label>
                                    <input type="text" class="form-control" id="editPostalCode"
                                        placeholder="Enter your postal code">
                                </div>
                                <div class="mb-3">
                                    <label for="editNeighborhood" class="form-label">Neighborhood</label>
                                    <input type="text" class="form-control" id="editNeighborhood"
                                        placeholder="Enter your neighborhood">
                                </div>
                                <div class="mb-3">
                                    <label for="editHouseNumber" class="form-label">House Number</label>
                                    <input type="text" class="form-control" id="editHouseNumber"
                                        placeholder="Enter your house number">
                                </div>
                                <button class="btn btn-primary" onclick="saveEditAddress()">Save Address</button>
                                <button class="btn btn-secondary" onclick="cancelEditAddress()">Cancel</button>
                            </div>
                            <button class="btn-save" onclick="confirmAddress()">Confirm Address</button>
                        </div>
                    </div>
                </div>
                <!-- Step 2: Shipping Method -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <div class="title">
                            <b><strong>2</strong> Select Shipping Method</b>
                            <span id="selectedShippingInfo"></span>
                        </div>
                        <button class="btn btn-sm btn-link edit-button" style="display:none;"
                            onclick="editStage(2)">Edit</button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#checkoutAccordion">
                        <div class="accordion-body">
                            <div class="shipping-methods" id="shippingMethods">
                                <div class="form-check shipping-wrap">
                                    <label class="form-check-label" for="shipping1">
                                        <input class="form-check-input" type="radio" name="shipping"
                                            id="shipping1" value="companyA">
                                        <img src="images/shipping/01.svg" alt="Express Trade House">
                                        <span>Express Trade House</span>
                                    </label>
                                    <span class="shipping-cost">40 LYD</span>
                                </div>
                                <div class="form-check shipping-wrap">
                                    <label class="form-check-label" for="shipping2">
                                        <input class="form-check-input" type="radio" name="shipping"
                                            id="shipping2" value="companyB">
                                        <img src="images/shipping/02.png" alt="Aramix">
                                        <span>Aramix Standard Shipping</span>
                                    </label>
                                    <span class="shipping-cost">30 LYD</span>
                                </div>
                                <div class="form-check shipping-wrap">
                                    <label class="form-check-label" for="shipping3">
                                        <input class="form-check-input" type="radio" name="shipping"
                                            id="shipping3" value="companyC">
                                        <img src="images/shipping/03.png" alt="J&T">
                                        <span>J&T Economy Shipping</span>
                                    </label>
                                    <span class="shipping-cost">20 LYD</span>
                                </div>
                            </div>
                            <button class="btn-save" onclick="confirmShipping()">Confirm Shipping</button>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Payment Method -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <div class="title">
                            <b><strong>3</strong> Payment Method</b>
                            <span id="selectedPaymentInfo"></span>
                        </div>
                        <button class="btn btn-sm btn-link edit-button" style="display:none;"
                            onclick="editStage(3)">Edit</button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                        data-bs-parent="#checkoutAccordion">
                        <div class="accordion-body">
                            <div class="payment-options">
                                <div class="form-check payment-wrap">
                                    <label class="form-check-label" for="visa">
                                        <input class="form-check-input" type="radio" name="payment" id="visa"
                                            value="visa" onclick="showPaymentForm('visa')">
                                        <img src="visa_logo.png" alt="Visa" style="width: 50px;">
                                    </label>
                                </div>
                                <div class="form-check payment-wrap">
                                    <label class="form-check-label" for="mastercard">
                                        <input class="form-check-input" type="radio" name="payment"
                                            id="mastercard" value="mastercard"
                                            onclick="showPaymentForm('mastercard')">
                                        <img src="images/payment/mada_mini.webp" alt="MasterCard"
                                            style="width: 50px;">
                                    </label>
                                </div>
                                <div class="form-check payment-wrap">
                                    <label class="form-check-label" for="cod">
                                        <input class="form-check-input" type="radio" name="payment" id="cod"
                                            value="cod" onclick="showPaymentForm('cod')">
                                        <img src="images/payment/apple_pay_mini.webp" alt="Cash on Delivery"
                                            style="width: 50px;">
                                    </label>
                                </div>
                            </div>
                            <div class="visa-form" id="visaForm" style="display:none;">
                                <div class="payment-wrapper">
                                    <div class="mb-3">
                                        <label for="visaCardNumber" class="form-label">Card Number</label>
                                        <input type="text" class="form-control" id="visaCardNumber"
                                            placeholder="Enter your card number">
                                    </div>
                                    <div class="mb-3">
                                        <label for="visaExpiryDate" class="form-label">Expiry Date</label>
                                        <input type="text" class="form-control" id="visaExpiryDate"
                                            placeholder="MM/YY">
                                    </div>
                                    <div class="mb-3">
                                        <label for="visaCVC" class="form-label">CVC</label>
                                        <input type="text" class="form-control" id="visaCVC"
                                            placeholder="Enter your CVC">
                                    </div>
                                </div>
                            </div>

                            <div class="mastercard-form" id="mastercardForm" style="display:none;">
                                <div class="payment-wrapper">
                                    <div class="mb-3">
                                        <label for="masterCardNumber" class="form-label">Card Number</label>
                                        <input type="text" class="form-control" id="masterCardNumber"
                                            placeholder="Enter your card number">
                                    </div>
                                    <div class="mb-3">
                                        <label for="masterExpiryDate" class="form-label">Expiry Date</label>
                                        <input type="text" class="form-control" id="masterExpiryDate"
                                            placeholder="MM/YY">
                                    </div>
                                    <div class="mb-3">
                                        <label for="masterCVC" class="form-label">CVC</label>
                                        <input type="text" class="form-control" id="masterCVC"
                                            placeholder="Enter your CVC">
                                    </div>
                                </div>
                            </div>

                            <button class="btn-save" onclick="completeOrder()">Complete Order</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./Payment -->

        </div>
        <!-- ./container -->
    </div>
    <!-- ./checkout -->

    <script src="theme1-assets/js/jquery-3.6.4.min.js"></script>
    <script src="theme1-assets/js/bootstrap.bundle.min.js"></script>
    <script src="theme1-assets/js/checkout.js"></script>

</body>

</html>
