<!doctype html>

    @if (App::getLocale() == 'en')
        <html dir="ltr" lang="en">
    @else
        <html dir="rtl" lang="ar">
    @endif

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dar Alamirat</title>
    <link rel="icon" type="image/png" href="{{ storage_asset($settings->keyBy('type')['general']->value['icon_path']) }}">
    <script src="https://kit.fontawesome.com/24eabd5129.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="theme1-assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="theme1-assets/css/checkout.css">
</head>

<body class="checkout_page">

    <!-- checkout -->
    <div id="checkout">
        <!-- container -->
        <div class="container">

            @include('themes.theme1.checkout.partials.header')

            @include('themes.theme1.checkout.partials.order-summary')

            <!-- Payment -->
            <div class="accordion" id="checkoutAccordion">
                <!-- Step 1: Shipping Address -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <div class="title">
                            <b><strong>1</strong> Select Shipping Address</b>
                            <span id="selectedAddressInfo"></span>
                        </div>
                        <button class="btn btn-sm btn-link edit-button" style=""
                            onclick="editStage(1)">Edit</button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#checkoutAccordion">
                        <div class="accordion-body">
                            <div id="addressList" class="address-list">
                                {{--Address items will be added here--}}
                            </div>
                            <button class="btn-add" onclick="showNewAddressForm()">
                                <span>Add New Address</span>
                            </button>

                            @include('themes.theme1.checkout.partials.new-address')

                            @include('themes.theme1.checkout.partials.edit-address')

                            <button class="btn-save" onclick="confirmAddress()">Confirm Address</button>
                        </div>
                    </div>
                </div>
                <!-- Step 2: Shipping Method -->

                @include('themes.theme1.checkout.partials.shipping')

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
                    @include('themes.theme1.checkout.partials.payment')
                </div>
            </div>
            <!-- ./Payment -->

        </div>
        <!-- ./container -->
    </div>
    <!-- ./checkout -->

    <script src="theme1-assets/js/jquery-3.6.4.min.js"></script>
    <script src="assets/js/axios.js"></script>
    <script src="theme1-assets/js/bootstrap.bundle.min.js"></script>
    {{-- <script src="theme1-assets/js/checkout.js"></script> --}}

    @include('themes.theme1.checkout.scripts.script ')

</body>

</html>
