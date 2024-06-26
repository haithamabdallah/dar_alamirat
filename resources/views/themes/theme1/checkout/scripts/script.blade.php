<script>
    let addressList = {!! json_encode($addresses) !!};

    function showNewAddressForm() {
        document.getElementById('newAddressForm').style.display = 'block';
        document.getElementById('editAddressForm').style.display = 'none';
    }

    function cancelNewAddress() {
        clearNewAddressForm();
        document.getElementById('newAddressForm').style.display = 'none';
    }

    function clearNewAddressForm() {
        document.getElementById('newGovernorate').value = '';
        document.getElementById('newCity').value = '';
        document.getElementById('newStreet').value = '';
        document.getElementById('newPostalCode').value = '';
        document.getElementById('newFamousPlaceNearby').value = '';
        document.getElementById('newHouseNumber').value = '';
    }

    function saveNewAddress(url, token) {
        const newGovernorate = document.getElementById('newGovernorate').value;
        const newCity = document.getElementById('newCity').value;
        const newStreet = document.getElementById('newStreet').value;
        const newPostalCode = document.getElementById('newPostalCode').value;
        const newFamousPlaceNearby = document.getElementById('newFamousPlaceNearby').value;
        const newHouseNumber = document.getElementById('newHouseNumber').value;
        if (newGovernorate && newCity && newStreet && newPostalCode && newFamousPlaceNearby && newHouseNumber) {
            axios.post(url, {
                __token: token,
                'governorate': $('#newGovernorate').val(),
                'city': $('#newCity').val(),
                'street': $('#newStreet').val(),
                'house_number': $('#newHouseNumber').val(),
                'postal_code': $('#newPostalCode').val(),
                'famous_place_nearby': $('#newFamousPlaceNearby').val(),
            }).then(function(response) {
                // console.log(response);
                if (response.data.status === 'error') {
                    let errors = response.data.errors;
                    let lists = '';
                    for (const [key, value] of Object.entries(errors)) {
                        lists += ` <li class="text-danger">${value}</li>`;
                    }
                    $('#store-errors').html(`<ul>${lists}</ul>`);
                } else {
                    addressList.push({
                        id: response.data.address.id,
                        governorate: response.data.address.governorate,
                        city: response.data.address.city,
                        street: response.data.address.street,
                        postal_code: response.data.address.postal_code,
                        famous_place_nearby: response.data.address.famous_place_nearby,
                        house_number: response.data.address.house_number
                    });
                    renderAddressList();
                    clearNewAddressForm();
                    document.getElementById('newAddressForm').style.display = 'none';
                }
                console.log(response);
            }).catch(function(error) {
                console.log(error);
            });
        } else {
            alert('Please fill all fields.');
        }
    }

    function editAddress(id) {
        const address = addressList.find(a => a.id === id);
        if (address) {
            document.getElementById('editAddressForm').innerHTML = `
            <input type="hidden" id="editId" value="${address.id}">
            <a class="btn-close-address" onclick="cancelEditAddress()"><i class="fa-solid fa-xmark"></i></a>
            <div class="grid-list">
                <div class="grid-item">
                    <label for="editGovernorate" class="form-label">Governorate</label>
                    <input type="text" class="form-control" id="editGovernorate" value="${address.governorate}">
                </div>
                <div class="grid-item">
                    <label for="editCity" class="form-label">City</label>
                    <input type="text" class="form-control" id="editCity" value="${address.city}">
                </div>
                <div class="grid-item">
                    <label for="editStreet" class="form-label">Street</label>
                    <input type="text" class="form-control" id="editStreet" value="${address.street}">
                </div>
                <div class="grid-item">
                    <label for="editPostalCode" class="form-label">Postal Code</label>
                    <input type="text" class="form-control" id="editPostalCode" value="${address.postal_code}">
                </div>
                <div class="grid-item">
                    <label for="editFamousPlaceNearby" class="form-label">Famous Place Nearby</label>
                    <input type="text" class="form-control" id="editFamousPlaceNearby" value="${address.famous_place_nearby}">
                </div>
                <div class="grid-item">
                    <label for="editHouseNumber" class="form-label">House Number</label>
                    <input type="text" class="form-control" id="editHouseNumber" value="${address.house_number}">
                </div>
            </div>
            <div class="" id="edit-errors" > 
            </div>
            <button class="btn-save" onclick="saveEditedAddress()">Save</button>
            <button class="btn btn-secondary" onclick="cancelEditAddress()">Cancel</button>
        `;
            document.getElementById('editAddressForm').style.display = 'block';
            document.getElementById('newAddressForm').style.display = 'none';
        }
    }

    function cancelEditAddress() {
        document.getElementById('editAddressForm').style.display = 'none';
        document.getElementById('editAddressForm').innerHTML = '';
    }

    function saveEditedAddress() {
        var editId = document.getElementById('editId').value;
        const url = `/addresses/${editId}`;
        const token = "{{ csrf_token() }}";
        var editGovernorate = document.getElementById('editGovernorate').value;
        var editCity = document.getElementById('editCity').value;
        var editStreet = document.getElementById('editStreet').value;
        var editPostalCode = document.getElementById('editPostalCode').value;
        var editFamousPlaceNearby = document.getElementById('editFamousPlaceNearby').value;
        var editHouseNumber = document.getElementById('editHouseNumber').value;

        if (editGovernorate && editCity && editStreet && editPostalCode && editFamousPlaceNearby && editHouseNumber) {

            axios.patch(url, {
                _token: token,
                id: editId,
                'governorate': editGovernorate,
                'city': editCity,
                'street': editStreet,
                'house_number': editHouseNumber,
                'postal_code': editPostalCode,
                'famous_place_nearby': editFamousPlaceNearby,
            }).then(function(response) {
                console.log(response);
                if (response.data.status === 'error') {
                    let errors = response.data.errors;
                    let lists = '';
                    for (const [key, value] of Object.entries(errors)) {
                        lists += ` <li class="text-danger">${value}</li>`;
                    }
                    $('#edit-errors').html(`<ul>${lists}</ul>`);
                } else {
                    const address = addressList.find(a => a.id == editId);
                    if (address) {
                        address.governorate = editGovernorate;
                        address.city = editCity;
                        address.street = editStreet;
                        address.postal_code = editPostalCode;
                        address.famous_place_nearby = editFamousPlaceNearby;
                        address.house_number = editHouseNumber;

                        renderAddressList();
                        cancelEditAddress();
                    }
                }
            }).catch(function(error) {
                console.log(error);
            });
        } else {
            alert('Please fill all fields.');
        }
    }

    function deleteAddress(id) {
        axios.delete(
            `/addresses/${id}`
        ).then(function(response) {
            console.log(response);
            addressList = addressList.filter(a => a.id !== id);
            document.getElementById('editAddressForm').style.display = 'none';
            renderAddressList();
        }).catch(function(error) {
            console.log(error);
        })
    }

    function confirmAddress() {
        const selectedAddress = document.querySelector('input[name="address"]:checked');
        if (selectedAddress) {
            const address = addressList.find(a => a.id == selectedAddress.value);
            document.getElementById('selectedAddressInfo').textContent =
                `${address.governorate}, ${address.city}, ${address.street}, ${address.postal_code}`;
            const collapseOne = new bootstrap.Collapse(document.getElementById('collapseOne'), {
                toggle: false
            });
            const collapseTwo = new bootstrap.Collapse(document.getElementById('collapseTwo'), {
                toggle: false
            });
            collapseOne.hide();
            collapseTwo.show();
            document.querySelector('#headingOne .edit-button').style.display = 'block';
        } else {
            alert('Please select an address.');
        }
    }

    function confirmShipping() {
        const selectedShipping = document.querySelector('input[name="shipping"]:checked');
        if (selectedShipping) {
            const shippingText = selectedShipping.nextElementSibling.textContent.trim();
            document.getElementById('selectedShippingInfo').textContent = shippingText;
            const collapseTwo = new bootstrap.Collapse(document.getElementById('collapseTwo'), {
                toggle: false
            });
            const collapseThree = new bootstrap.Collapse(document.getElementById('collapseThree'), {
                toggle: false
            });
            collapseTwo.hide();
            collapseThree.show();
            document.querySelector('#headingTwo .edit-button').style.display = 'block';
        } else {
            alert('Please select a shipping method.');
        }
    }

    function editStage(stage) {
        if (stage === 1) {
            const collapseOne = new bootstrap.Collapse(document.getElementById('collapseOne'), {
                toggle: false
            });
            const collapseTwo = new bootstrap.Collapse(document.getElementById('collapseTwo'), {
                toggle: false
            });
            const collapseThree = new bootstrap.Collapse(document.getElementById('collapseThree'), {
                toggle: false
            });
            collapseOne.show();
            collapseTwo.hide();
            collapseThree.hide();
        } else if (stage === 2) {
            const collapseOne = new bootstrap.Collapse(document.getElementById('collapseOne'), {
                toggle: false
            });
            const collapseTwo = new bootstrap.Collapse(document.getElementById('collapseTwo'), {
                toggle: false
            });
            const collapseThree = new bootstrap.Collapse(document.getElementById('collapseThree'), {
                toggle: false
            });
            collapseOne.hide();
            collapseTwo.show();
            collapseThree.hide();
        } else if (stage === 3) {
            const collapseOne = new bootstrap.Collapse(document.getElementById('collapseOne'), {
                toggle: false
            });
            const collapseTwo = new bootstrap.Collapse(document.getElementById('collapseTwo'), {
                toggle: false
            });
            const collapseThree = new bootstrap.Collapse(document.getElementById('collapseThree'), {
                toggle: false
            });
            collapseOne.hide();
            collapseTwo.hide();
            collapseThree.show();
        }
    }

    function showPaymentForm(paymentMethod) {
        // document.getElementById('visaForm').style.display = 'none';
        // document.getElementById('mastercardForm').style.display = 'none';
        // document.getElementById('selectedPaymentInfo').textContent = '';
        if (paymentMethod === 'visa') {
            // document.getElementById('visaForm').style.display = 'block';
            // document.getElementById('selectedPaymentInfo').textContent = 'Visa';
        } else if (paymentMethod === 'mastercard') {
            // document.getElementById('mastercardForm').style.display = 'block';
            // document.getElementById('selectedPaymentInfo').textContent = 'MasterCard';
        } else if (paymentMethod === 'cod') {
            document.getElementById('selectedPaymentInfo').textContent = 'Cash on Delivery';
        }
    }

    function renderAddressList() {
        const addressListContainer = document.getElementById('addressList');
        addressListContainer.innerHTML = '';
        addressList.forEach(address => {
            const addressItem = document.createElement('div');
            addressItem.className = 'form-check mb-3 address-wrap';
            addressItem.innerHTML = `
            <label class="form-check-label" for="address${address.id}">
                <input class="form-check-input" type="radio" name="address" id="address${address.id}" value="${address.id}">
                ${address.governorate}, ${address.city}, ${address.street}, ${address.postal_code}
            </label>
            <div class="btns">
                <button class="btn-link" onclick="editAddress(${address.id})">Edit</button>
                <button class="btn-link" onclick="deleteAddress(${address.id})">Delete</button>
            </div>
        `;
            addressListContainer.appendChild(addressItem);
        });
    }

    function completeOrder() {
        $('#shipping_id').val($('input[name="shipping"]:checked').val());
        $('#address_id').val($('input[name="address"]:checked').val());
        $('#complete-order-form').submit();
        // axios.post('{{ route('order.checkout.store') }}', {
        //     _token: '{{ csrf_token() }}',
        //     shipping_id: $('input[name="shipping"]:checked').val(),
        //     address_id: $('input[name="address"]:checked').val(),
        // }).then(function(response) {
        //     console.log(response);
        // }).catch(function(error) {
        //     console.log(error);
        // })
        // alert('Order Completed!');
    }

    $('input[name="shipping"]').each(function(index) {
        $(this).on('click', function() {
            let shippingPrice = parseFloat($('#shipping' + index + ':checked').data('shipping-price'))
            $('#shipping-cost').text(shippingPrice);
            calculateTotal()
        })
    })

    function calculateTotal() {
        let cartTotal = parseFloat('{{ $cartTotal }}');
        let shippingCost = parseFloat($('#shipping-cost').text());
        let vat = parseFloat($('#vat').text());
        let orderTotal = cartTotal + shippingCost + vat;
        $('#order-total').text(orderTotal.toFixed(2));
    }

    // Initial render for the address list
    renderAddressList();

    function applyCoupon() {
            let couponCode = $('#coupon-code').val();
            axios.post('{{ route("coupon.check") }}', {
                'coupon_code': couponCode
            }).then((response) => {
                if (response.data.status === 'success') {
                    // console.log(response.data.coupon.discount_value);
                    
                    let coupon = response.data.coupon;
                    if (coupon.discount_type == 'flat') {
                        // console.log(parseFloat($('#final-total-price').text()) - parseFloat(coupon.discount_value));
                        var discountValue = parseFloat(coupon.discount_value);
                    } else {
                        // console.log(parseFloat($('#cart-total').text()) - (parseFloat($('#cart-total').text()) * parseFloat(coupon.discount_value) / 100));
                        var discountValue = parseFloat($('#cart-total').text()) * parseFloat(coupon.discount_value) / 100;
                    }
                    $('#discount-value').text(parseFloat(discountValue) + ' {!! $currency !!}');
                    $('#discount-div').show();
                    $('#coupon_id').val(coupon.id);
                } else {
                    $('#discount-div').hide();
                    console.log(response.data);
                }
            }).catch((error) => {
                $('#discount-div').hide();
                console.log(error);
            });
        }
</script>
