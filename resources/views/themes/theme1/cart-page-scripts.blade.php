<script>
    let prices = {!! $prices !!};

    var carts = {};

    function getPricePerUnit(index) {
        let variantId = $(`input[name=variant].variant-${index}:checked`).val();
        return parseFloat(prices[variantId]['priceWithDiscount']);
    }

    function updateTotalPrice(index) {
        let currentQuantity = parseInt($(`#quantity-${index}`).val());
        let pricePerUnit = getPricePerUnit(index);
        let totalPrice = currentQuantity * pricePerUnit;
        $('#price-' + index).text(totalPrice.toFixed(2));
    }

    $('.items_in_cart').each(function(index) {
        $(`#decrement-${index}`).on('click', function() {
            let currentQuantity = parseInt($(`#quantity-${index}`).val());
            if (currentQuantity > 1) {
                $(`#quantity-${index}`).val(currentQuantity - 1);
            }
            updateTotalPrice(index);
            updateOrderSummary(index);
            checkInventoryQuantity(index);
        });

        $(`#increment-${index}`).on('click', function() {
            let currentQuantity = parseInt($(`#quantity-${index}`).val());
            $(`#quantity-${index}`).val(currentQuantity + 1);
            updateTotalPrice(index);
            updateOrderSummary(index);
            checkInventoryQuantity(index);
        });

        $(`input[name=variant].variant-${index}`).on('click', function() {
            updateTotalPrice(index);
            updateOrderSummary(index);
            checkInventoryQuantity(index);
        });

        // Call update functions
        updateTotalPrice(index);
        updateOrderSummary(index);
        checkInventoryQuantity(index);
    });

    function removeItemFromCart(index) {
        Swal.fire({
            title: "{{ __('Do you want to continue') }}{{ __('?') }}",
            icon: "question",
            iconHtml: "؟",
            confirmButtonText: "{{ __('Yes') }}",
            cancelButtonText: "{{ __('No') }}",
            showCancelButton: true,
            showCloseButton: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $('#delete-form-' + index).submit();
            }
        });
    }

    function updateOrderSummary(index) {
        const cartId = $('#cart-id-' + index).data('id');
        const selectedProductElement = document.getElementById('selected-product-' + index); // Order summary element
        const productPriceSummaryElement = document.getElementById('product-price-summary-' + index); // Order summary element
        const quantitySummaryElement = document.getElementById('quantity-summary-' + index); // Order summary element
        const itemTotalPriceElement = document.getElementById('item-total-price-' + index); // Order summary element
        const finalTotalPriceElement = document.getElementById('final-total-price'); // Order summary element

        const productPrice = getPricePerUnit(index);
        const quantity = parseInt($(`#quantity-${index}`).val());
        const itemTotalPrice = (quantity * productPrice).toFixed(2);

        if (selectedProductElement) {
            selectedProductElement.innerHTML = `<b>Chosen Product:</b> ${$('#product-title-' + index).data('title')}`;
        }
        if (productPriceSummaryElement) {
            productPriceSummaryElement.innerHTML = `<b>Product Price:</b> ${productPrice} {!! $currency !!} `;
        }
        if (quantitySummaryElement) {
            quantitySummaryElement.innerHTML = `<b>Quantity:</b> ${quantity}`;
        }
        if (itemTotalPriceElement) {
            itemTotalPriceElement.innerHTML = `<b>Item Total:</b> ${itemTotalPrice} {!! $currency !!} `;
        }

        carts[cartId] = {
            variant_id :  $('input[type=radio][name="variant"]:checked').val(),
            product_id: $('#product-id-' + index).data('id'),
            quantity: parseInt(quantity),
        };

        updateFinalPrice();
    }

    function updateFinalPrice() {
        let finalPrice = 0;
        $('.items_in_cart').each(function(index) {
            finalPrice += parseFloat($(`#price-${index}`).text());
        })
        $('#final-total-price').text(finalPrice.toFixed(2) + ' {!! $currency !!}');
        $('#final-total-input').val(finalPrice.toFixed(2));
    }

    $('#final-total-btn').on('click', () => {
        axios.patch('{{ route('cart.update') }}', {
            'carts': carts
        }).then((response) => {
            if (response.data.status === 'success') {
                $('#final-total-form').submit();
            } else {
                console.log(response.data);
            }
        }).catch((error) => {
            console.log(error);
        });
    })

    function checkInventoryQuantity(index) {
        let currentQuantity = parseInt($(`#quantity-${index}`).val());
        let productId = $('#product-id-' + index).data('id');
        let inventoryQuantity = $('#inventory-quantity-' + productId).data('quantity');
        if (currentQuantity > inventoryQuantity) {
            $(`#quantity-${index}`).val(inventoryQuantity);
            alert('The quantity you entered is greater than the available quantity. The available quantity is ' +
                inventoryQuantity);
        }
    }

    function applyCoupon() {
        let couponCode = $('#coupon-code').val();
        axios.post('{{ route("coupon.check") }}', {
            'coupon_code': couponCode
        }).then((response) => {
            if (response.data.status === 'success') {
                console.log(response.data);

                let coupon = response.data.coupon;
                let couponDetails = `<b> Minimum Purchase Limit:</b> ${coupon.min_purchase_limit} {!! $currency !!}<br>`;
                if (coupon.discount_type == 'flat') {
                    couponDetails += `<b> Discount Value:</b> ${coupon.discount_value} {!! $currency !!}<br>`;
                } else {
                    couponDetails += `<b> Discount Value:</b> ${coupon.discount_value} % of final total <br> `;
                }
                couponDetails += `<b>The coupon will not be applied to products that already have a discount</b>`;
                $('#coupon-details').html(couponDetails);
                $('#coupon-details-div').show();
            } else {
                $('#coupon-details-div').hide();
                $('#invalid-coupon').show();
                $('#invalid-coupon').hide(2000);
                console.log(response.data);
            }
        }).catch((error) => {
            $('#coupon-details-div').hide();
            console.log(error);
        });
    }
</script>
