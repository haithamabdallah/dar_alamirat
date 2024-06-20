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
                                    <!-- item -->
                                    <div class="alert item_cart alert-dismissible fade show" role="alert">
                                        <!-- data -->
                                        <div class="entries">

                                            {{-- <a class="removeItem" href="javascript:;" data-bs-dismiss="alert"
                                            aria-label="Close"><i class="fa-solid fa-xmark"></i></a> --}}


                                            <form action="{{ route('cart.destroy' , $cart->id) }}" method="POST" id="delete-form-{{ $index }}" data-index="{{ $index }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button class="removeItem" onclick="event.preventDefault(); removeItemFromCart({{ $index }})"><i class="fa-solid fa-xmark"></i></button>

                                                <div class="d-none" id="product-title-{{ $index }}" data-title="{{ $cart->product->title }}"></div>
                                            <!-- img and title -->
                                            <div class="itemInfo">
                                                <a href="#">
                                                    <img class="w-full object-contain" src="{{ $cart->product->thumbnail }}"
                                                        alt="product image">
                                                </a>

                                                <h2>
                                                    <a href="{{ route('product', $cart->product->id) }}">{{ $cart->product->title }}</a>
                                                    <div class="variant-price">Variant Price: <span
                                                            id="variant-price-{{ $index }}">{{ $cart->product->price }}</span> {{ $currency }}
                                                    </div>
                                                </h2>
                                            </div>
                                            <!-- img and title -->

                                            <!-- quantity -->
                                            <div class="quantity-control">
                                                <button id="decrement-{{ $index }}">-</button>
                                                <input type="number" id="quantity-{{ $index }}" value="{!! intval(session()->get($cart->id.'-quantity')) ?? 1 !!}"
                                                    min="1">
                                                <button id="increment-{{ $index }}">+</button>
                                            </div>
                                            <!-- ./quantity -->

                                            <!-- total price -->
                                            <div class="price">Total Price: 
                                                <span id="price-{{ $index }}">  {{ $cart->product->price }}  </span></div>
                                            <!-- ./total price -->

                                        </div>
                                        <!-- data -->

                                        <!-- variants -->
                                        <div class="variants">
                                            <label class="title" for="Variant">Choose Product</label>
                                            <select id="variant-{{ $index }}">
                                                @foreach ($cart->product->variants as $variant)
                                                    <option value="{{ $variant->id }}" 
                                                            {{  ( session()->has($cart->id.'-variantId') && session()->get($cart->id.'-variantId')  == $variant->id ) 
                                                            ?  'selected' : 'null' }}
                                                    >{{ $variant->variant_name  }}
                                                    </option>
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
                                    <h6 class="p-2 rounded" style="background-color: #cccccc ;">Order Summary</h6>

                                    @foreach ($carts as $index => $cart)
                                        <p id="selected-product-{{ $index }}"></p>

                                        <p id="selected-variant-{{ $index }}"></p>

                                        <p id="variant-price-summary-{{ $index }}"></p>

                                        <p id="quantity-summary-{{ $index }}"></p>

                                        <p id="item-total-price-{{ $index }}"></p>

                                        <div class="" style="background-color: #cccccc ; height: 5px ; width: 100%"></div>
                                    @endforeach

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

    <script>

        let prices = {!! $prices !!}; 

        function getPricePerUnit(index) {
            let variantId = $(`#variant-${index}`).val();
            return prices[variantId]['priceWithDiscount'];
        }

        function updateTotalPrice(index) {
            let currentQuantity = parseInt($(`#quantity-${index}`).val());
            let pricePerUnit = getPricePerUnit(index);
            let totalPrice = currentQuantity * pricePerUnit;
            $('#price-' + index).text(totalPrice.toFixed(2));
        }

        function updateVariantPrice(index) {
            let pricePerUnit = getPricePerUnit(index);
            // $(`#variant-price-${index}`).text(pricePerUnit.toFixed(2)) ; // Update variant price element
            $(`#variant-price-${index}`).text(pricePerUnit) ; // Update variant price element
        }

        function updateOrderSummary(index) {
            const variantSelect = document.getElementById('variant-'+index);
            const selectedProductElement = document.getElementById('selected-product-' + index); // Order summary element
            const selectedVariantElement = document.getElementById('selected-variant-' + index); // Order summary element
            const variantPriceSummaryElement = document.getElementById('variant-price-summary-' + index); // Order summary element
            const quantitySummaryElement = document.getElementById('quantity-summary-' + index); // Order summary element
            const itemTotalPriceElement = document.getElementById('item-total-price-' + index); // Order summary element
            const finalTotalPriceElement = document.getElementById('final-total-price'); // Order summary element

            const selectedVariantText = variantSelect.options[variantSelect.selectedIndex].text;
            const variantPrice = getPricePerUnit(index);
            const quantity = parseInt($(`#quantity-${index}`).val());
            const itemTotalPrice = (quantity * variantPrice).toFixed(2);

            selectedProductElement.innerHTML = `<b>chosen Product:</b> ${$('#product-title-' + index).data('title')}`;
            selectedVariantElement.innerHTML = `<b>chosen Variant:</b> ${selectedVariantText}`;
            variantPriceSummaryElement.innerHTML = `<b>Product Price:</b> ${variantPrice} {!! $currency !!} ` ;
            quantitySummaryElement.innerHTML = `<b>Quantity:</b> ${quantity}`;
            itemTotalPriceElement.innerHTML = `<b>Item Total:</b> ${itemTotalPrice} {!! $currency !!} ` ;

            updateFinalPrice();
        }

        function updateFinalPrice() {
            let finalPrice = 0;
            $('.items_in_cart').each(function(index) {
                finalPrice += parseFloat($(`#price-${index}`).text());
            })
            $('#final-total-price').text(finalPrice.toFixed(2) + ' {!! $currency !!}');
        }

        $('.items_in_cart').each(function(index) {
            $(`#decrement-${index}`).on('click', function () {
                let currentQuantity = parseInt($(`#quantity-${index}`).val());
                if (currentQuantity > 1) {
                    $(`#quantity-${index}`).val(currentQuantity - 1);
                }
                updateTotalPrice(index);
                updateOrderSummary(index);
            });

            $(`#increment-${index}`).on('click', function () {
                let currentQuantity = parseInt($(`#quantity-${index}`).val());
                $(`#quantity-${index}`).val(currentQuantity + 1);
                updateTotalPrice(index);
                updateOrderSummary(index);
            });

            $(`#variant-${index}`).on('change', () => {
                updateTotalPrice(index);
                updateVariantPrice(index); // Update variant price display on selection change
                updateOrderSummary(index);
            });

            // Call update functions
            updateTotalPrice(index);
            updateVariantPrice(index);
            updateOrderSummary(index);
        })

        function removeItemFromCart(index) {
            Swal.fire({
                title: "هل تريد الاستمرار؟",
                icon: "question",
                iconHtml: "؟",
                confirmButtonText: "نعم",
                cancelButtonText: "لا",
                showCancelButton: true,
                showCloseButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#delete-form-'+index).submit();
                }
            });
        }
    </script>

@endsection
