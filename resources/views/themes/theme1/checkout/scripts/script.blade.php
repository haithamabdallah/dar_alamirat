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
        document.getElementById('newPhone1').value = '';
        document.getElementById('newPhone2').value = '';
    }

    function saveNewAddress(url, token) {
        const newGovernorate = document.getElementById('newGovernorate').value;
        const newCity = document.getElementById('newCity').value;
        const newStreet = document.getElementById('newStreet').value;
        const newPostalCode = document.getElementById('newPostalCode').value;
        const newFamousPlaceNearby = document.getElementById('newFamousPlaceNearby').value;
        const newHouseNumber = document.getElementById('newHouseNumber').value;
        const newPhone1 = document.getElementById('newPhone1').value;
        const newPhone2 = document.getElementById('newPhone2').value;
        if (newGovernorate && newCity && newStreet && newPostalCode && newFamousPlaceNearby && newHouseNumber &&
            newPhone1 && newPhone2) {
            axios.post(url, {
                __token: token,
                'governorate': $('#newGovernorate').val(),
                'city': $('#newCity').val(),
                'street': $('#newStreet').val(),
                'house_number': $('#newHouseNumber').val(),
                'postal_code': $('#newPostalCode').val(),
                'famous_place_nearby': $('#newFamousPlaceNearby').val(),
                'phone1': $('#newPhone1').val(),
                'phone2': $('#newPhone2').val()
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
                        house_number: response.data.address.house_number,
                        phone1: (response.data.address?.phone1 ?? ''),
                        phone2: (response.data.address?.phone2 ?? '')
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
                    <label for="editGovernorate" class="form-label">{{ __("Governorate") }}</label>
                    <input type="text" class="form-control" id="editGovernorate" value="${address.governorate??''}">
                </div>
                <div class="grid-item">
                    <label for="editCity" class="form-label">{{ __("City") }}</label>
                    <input type="text" class="form-control" id="editCity" value="${address.city??''}">
                </div>
                <div class="grid-item">
                    <label for="editStreet" class="form-label">{{ __("Street") }}</label>
                    <input type="text" class="form-control" id="editStreet" value="${address.street??''}">
                </div>
                <div class="grid-item">
                    <label for="editHouseNumber" class="form-label">{{ __("House Number") }}</label>
                    <input type="text" class="form-control" id="editHouseNumber" value="${address.house_number??''}">
                </div>
                <div class="grid-item">
                    <label for="editPostalCode" class="form-label">{{ __("Postal Code") }}</label>
                    <input type="text" class="form-control" id="editPostalCode" value="${address.postal_code??''}">
                </div>
                <div class="grid-item">
                    <label for="editFamousPlaceNearby" class="form-label">{{ __("Famous Place Nearby") }}</label>
                    <input type="text" class="form-control" id="editFamousPlaceNearby" value="${address.famous_place_nearby??''}">
                </div>
                <div class="grid-item">
                    <label for="editPhone1" class="form-label">{{ __("Phone1") }}</label>
                    <input type="text" class="form-control" id="editPhone1" value="${address.phone1??''}">
                </div>
                <div class="grid-item">
                    <label for="editPhone2" class="form-label">{{ __("Phone2") }}</label>
                    <input type="text" class="form-control" id="editPhone2" value="${address.phone2??''}">
                </div>
            </div>
            <div class="" id="edit-errors" > 
            </div>
            <button class="btn-save" onclick="saveEditedAddress()">Save</button>
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
        var editPhone1 = document.getElementById('editPhone1').value;
        var editPhone2 = document.getElementById('editPhone2').value;

        if (editGovernorate && editCity && editStreet && editPostalCode && editFamousPlaceNearby && editHouseNumber &&
            editPhone1 && editPhone2) {

            axios.patch(url, {
                _token: token,
                id: editId,
                'governorate': editGovernorate,
                'city': editCity,
                'street': editStreet,
                'house_number': editHouseNumber,
                'postal_code': editPostalCode,
                'famous_place_nearby': editFamousPlaceNearby,
                'phone1': editPhone1,
                'phone2': editPhone2
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
                        address.phone1 = editPhone1;
                        address.phone2 = editPhone2;

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
                ${address.governorate}, ${address.city}, ${address.street}, ${address.postal_code} , ${address.phone1??'no phone'}, ${address.phone2??'no phone'}
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

    $(document).ready(function() {
        if ($('#coupon-code').val() != '') {
            $('#coupon-code-btn')[0].click();
            applyCoupon();
        }
    });
</script>

@include('themes.theme1.shared-scripts.apply-coupon')

