<script>

function applyCoupon() {
        let couponCode = $('#coupon-code').val();
        axios.post('{{ route("coupon.check") }}', {
            'coupon_code': couponCode
        }).then((response) => {
            if (response.data.status === 'success') {
                console.log(response.data);

                let coupon = response.data.coupon;
                let couponDetails = `<b> {{ __('Minimum Purchase Limit') }} :</b> ${coupon.min_purchase_limit} {!! $currency !!}<br>`;
                if (coupon.discount_type == 'flat') {
                    couponDetails += `<b> {{ __('Discount Value') }} :</b> ${coupon.discount_value} {!! $currency !!}<br>`;
                } else {
                    couponDetails += `<b> {{ __('Discount Value') }}:</b> ${coupon.discount_value} % {{ __('of final total') }} <br> `;
                }
                couponDetails += `<b class="text-danger"> {{ __('The coupon will not be applied to products that already have a discount') }}</b>`;
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