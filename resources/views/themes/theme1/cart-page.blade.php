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
                        @foreach($carts as $cart)
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
                                            <img class="w-full object-contain" src="{{$cart->product->thumbnail}}" alt="">
                                        </a>

                                        <h2>
                                            <a href="#">{{$cart->product->title}}</a>
                                            <div class="variant-price">Variant Price: <span id="variant-price">{{$cart->product->price}}</span></div>
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
                                        @foreach($cart->product->variants as $variant)
                                        <option value="{{$variant->id}}">{{$variant->variant_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- variants -->

                            </div>
                            <!-- ./item -->
                        </div>
                        <!-- ./Items in Cart -->
                        @endforeach
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

@section('scripts')
    <script>

        const quantityInput = document.getElementById('quantity');
        const decrementButton = document.getElementById('decrement');
        const incrementButton = document.getElementById('increment');
        const variantSelect = document.getElementById('variant');
        const priceElement = document.getElementById('price'); // Total price with quantity
        const variantPriceElement = document.getElementById('variant-price'); // Variant price only
        const selectedVariantElement = document.getElementById('selected-variant'); // Order summary element
        const variantPriceSummaryElement = document.getElementById('variant-price-summary'); // Order summary element
        const quantitySummaryElement = document.getElementById('quantity-summary'); // Order summary element
        const itemTotalPriceElement = document.getElementById('item-total-price'); // Order summary element
        const finalTotalPriceElement = document.getElementById('final-total-price'); // Order summary element

        let prices = {
            '100ml': 10.99,
            '200ml': 14.99
        };

        let currentVariant = variantSelect.value;
        let pricePerUnit = prices[currentVariant];

        decrementButton.addEventListener('click', () => {
            let currentQuantity = parseInt(quantityInput.value);
            if (currentQuantity > 1) {
                quantityInput.value = currentQuantity - 1;
            }
            updateTotalPrice();
            updateOrderSummary();
        });

        incrementButton.addEventListener('click', () => {
            let currentQuantity = parseInt(quantityInput.value);
            quantityInput.value = currentQuantity + 1;
            updateTotalPrice();
            updateOrderSummary();
        });

        variantSelect.addEventListener('change', () => {
            currentVariant = variantSelect.value;
            pricePerUnit = prices[currentVariant];
            updateTotalPrice();
            updateVariantPrice(); // Update variant price display on selection change
            updateOrderSummary();
        });

        function updateTotalPrice() {
            let currentQuantity = parseInt(quantityInput.value);
            let totalPrice = currentQuantity * pricePerUnit;
            priceElement.textContent = totalPrice.toFixed(2);
        }

        function updateVariantPrice() {
            variantPriceElement.textContent = pricePerUnit.toFixed(2); // Update variant price element
        }

        function updateOrderSummary() {
            const selectedVariantText = variantSelect.options[variantSelect.selectedIndex].text;
            const variantPrice = pricePerUnit.toFixed(2);
            const quantity = parseInt(quantityInput.value);
            const itemTotalPrice = (quantity * pricePerUnit).toFixed(2);

            selectedVariantElement.innerHTML = `<b>chosen Product:</b> ${selectedVariantText}`;
            variantPriceSummaryElement.innerHTML = `<b>Product Price:</b> LYD ${variantPrice}`;
            quantitySummaryElement.innerHTML = `<b>Quantity:</b> ${quantity}`;
            itemTotalPriceElement.innerHTML = `<b>Item Total:</b> LYD ${itemTotalPrice}`;

            const finalTotalPrice = priceElement.textContent;
            finalTotalPriceElement.textContent = `LYD ${finalTotalPrice}`;
        }

        // Call update functions
        updateTotalPrice();
        updateVariantPrice();
        updateOrderSummary();



        function removeItemFromCart() {
            Swal.fire({
                title: "هل تريد الاستمرار؟",
                icon: "question",
                iconHtml: "؟",
                confirmButtonText: "نعم",
                cancelButtonText: "لا",
                showCancelButton: true,
                showCloseButton: true
            });
        }
    </script>
@endsection
