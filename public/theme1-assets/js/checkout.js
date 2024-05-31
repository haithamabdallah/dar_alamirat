
    "use strict";

    let addressList = [];

    function showNewAddressForm() {
        document.getElementById('newAddressForm').style.display = 'block';
        document.getElementById('editAddressForm').style.display = 'none';
    }

    function cancelNewAddress() {
        clearNewAddressForm();
        document.getElementById('newAddressForm').style.display = 'none';
    }

    function clearNewAddressForm() {
        document.getElementById('newCountry').value = '';
        document.getElementById('newCity').value = '';
        document.getElementById('newStreet').value = '';
        document.getElementById('newPostalCode').value = '';
        document.getElementById('newNeighborhood').value = '';
        document.getElementById('newHouseNumber').value = '';
    }

    function saveNewAddress() {
        const newCountry = document.getElementById('newCountry').value;
        const newCity = document.getElementById('newCity').value;
        const newStreet = document.getElementById('newStreet').value;
        const newPostalCode = document.getElementById('newPostalCode').value;
        const newNeighborhood = document.getElementById('newNeighborhood').value;
        const newHouseNumber = document.getElementById('newHouseNumber').value;

        if (newCountry && newCity && newStreet && newPostalCode && newNeighborhood && newHouseNumber) {
            const newId = addressList.length + 1;
            addressList.push({
                id: newId,
                country: newCountry,
                city: newCity,
                street: newStreet,
                postalCode: newPostalCode,
                neighborhood: newNeighborhood,
                houseNumber: newHouseNumber
            });
            renderAddressList();
            clearNewAddressForm();
            document.getElementById('newAddressForm').style.display = 'none';
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
                        <label for="editCountry" class="form-label">Country</label>
                        <input type="text" class="form-control" id="editCountry" value="${address.country}">
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
                        <input type="text" class="form-control" id="editPostalCode" value="${address.postalCode}">
                    </div>
                    <div class="grid-item">
                        <label for="editNeighborhood" class="form-label">Neighborhood</label>
                        <input type="text" class="form-control" id="editNeighborhood" value="${address.neighborhood}">
                    </div>
                    <div class="grid-item">
                        <label for="editHouseNumber" class="form-label">House Number</label>
                        <input type="text" class="form-control" id="editHouseNumber" value="${address.houseNumber}">
                    </div>
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
        var editCountry = document.getElementById('editCountry').value;
        var editCity = document.getElementById('editCity').value;
        var editStreet = document.getElementById('editStreet').value;
        var editPostalCode = document.getElementById('editPostalCode').value;
        var editNeighborhood = document.getElementById('editNeighborhood').value;
        var editHouseNumber = document.getElementById('editHouseNumber').value;

        if (editCountry && editCity && editStreet && editPostalCode && editNeighborhood && editHouseNumber) {
            const address = addressList.find(a => a.id == editId);
            if (address) {
                address.country = editCountry;
                address.city = editCity;
                address.street = editStreet;
                address.postalCode = editPostalCode;
                address.neighborhood = editNeighborhood;
                address.houseNumber = editHouseNumber;

                renderAddressList();
                cancelEditAddress();
            }
        } else {
            alert('Please fill all fields.');
        }
    }

    function deleteAddress(id) {
        addressList = addressList.filter(a => a.id !== id);
        document.getElementById('editAddressForm').style.display = 'none';
        renderAddressList();
    }

    function confirmAddress() {
        const selectedAddress = document.querySelector('input[name="address"]:checked');
        if (selectedAddress) {
            const address = addressList.find(a => a.id == selectedAddress.value);
            document.getElementById('selectedAddressInfo').textContent = `${address.country}, ${address.city}, ${address.street}, ${address.postalCode}`;
            const collapseOne = new bootstrap.Collapse(document.getElementById('collapseOne'), { toggle: false });
            const collapseTwo = new bootstrap.Collapse(document.getElementById('collapseTwo'), { toggle: false });
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
            const collapseTwo = new bootstrap.Collapse(document.getElementById('collapseTwo'), { toggle: false });
            const collapseThree = new bootstrap.Collapse(document.getElementById('collapseThree'), { toggle: false });
            collapseTwo.hide();
            collapseThree.show();
            document.querySelector('#headingTwo .edit-button').style.display = 'block';
        } else {
            alert('Please select a shipping method.');
        }
    }

    function editStage(stage) {
        if (stage === 1) {
            const collapseOne = new bootstrap.Collapse(document.getElementById('collapseOne'), { toggle: false });
            const collapseTwo = new bootstrap.Collapse(document.getElementById('collapseTwo'), { toggle: false });
            const collapseThree = new bootstrap.Collapse(document.getElementById('collapseThree'), { toggle: false });
            collapseOne.show();
            collapseTwo.hide();
            collapseThree.hide();
        } else if (stage === 2) {
            const collapseOne = new bootstrap.Collapse(document.getElementById('collapseOne'), { toggle: false });
            const collapseTwo = new bootstrap.Collapse(document.getElementById('collapseTwo'), { toggle: false });
            const collapseThree = new bootstrap.Collapse(document.getElementById('collapseThree'), { toggle: false });
            collapseOne.hide();
            collapseTwo.show();
            collapseThree.hide();
        } else if (stage === 3) {
            const collapseOne = new bootstrap.Collapse(document.getElementById('collapseOne'), { toggle: false });
            const collapseTwo = new bootstrap.Collapse(document.getElementById('collapseTwo'), { toggle: false });
            const collapseThree = new bootstrap.Collapse(document.getElementById('collapseThree'), { toggle: false });
            collapseOne.hide();
            collapseTwo.hide();
            collapseThree.show();
        }
    }

    function showPaymentForm(paymentMethod) {
        document.getElementById('visaForm').style.display = 'none';
        document.getElementById('mastercardForm').style.display = 'none';
        document.getElementById('selectedPaymentInfo').textContent = '';
        if (paymentMethod === 'visa') {
            document.getElementById('visaForm').style.display = 'block';
            document.getElementById('selectedPaymentInfo').textContent = 'Visa';
        } else if (paymentMethod === 'mastercard') {
            document.getElementById('mastercardForm').style.display = 'block';
            document.getElementById('selectedPaymentInfo').textContent = 'MasterCard';
        } else if (paymentMethod === 'cod') {
            document.getElementById('selectedPaymentInfo').textContent = 'Cash on Delivery';
        }
    }

    function completeOrder() {
        alert('Order Completed!');
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
                    ${address.country}, ${address.city}, ${address.street}, ${address.postalCode}
                </label>
                <div class="btns">
                    <button class="btn-link" onclick="editAddress(${address.id})">Edit</button>
                    <button class="btn-link" onclick="deleteAddress(${address.id})">Delete</button>
                </div>
            `;
            addressListContainer.appendChild(addressItem);
        });
    }

    // Initial render for the address list
    renderAddressList();

