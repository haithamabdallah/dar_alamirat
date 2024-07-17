<div class="new-address-form" id="newAddressForm">
    <a class="btn-close-address" onclick="cancelNewAddress()"><i class="fa-solid fa-xmark"></i></a>
    <div class="grid-list">
        <div class="grid-item">
            <label for="newGovernorate" class="form-label">{{ __("Governorate") }} *</label>
            <input type="text" class="form-control" id="newGovernorate" placeholder="{{ __("Governorate") }}">
            <span class="error-message" id="newGovernorate-error"></span>
        </div>
        <div class="grid-item">
            <label for="newCity" class="form-label">{{ __("City") }} *</label>
            <input type="text" class="form-control" id="newCity" placeholder="{{ __("City") }}">
            <span class="error-message" id="newCity-error"></span>
        </div>
        <div class="grid-item">
            <label for="newStreet" class="form-label">{{ __("Street") }} *</label>
            <input type="text" class="form-control" id="newStreet" placeholder="{{ __("Street") }}">
            <span class="error-message" id="newStreet-error"></span>
        </div>
        <div class="grid-item">
            <label for="newHouseNumber" class="form-label">{{ __("House Number") }}</label>
            <input type="text" class="form-control" id="newHouseNumber" placeholder="{{ __("House Number") }}">
            <span class="error-message" id="newHouseNumber-error"></span>
        </div>
        <div class="grid-item">
            <label for="newPostalCode" class="form-label">{{ __("Postal Code") }}</label>
            <input type="text" class="form-control" id="newPostalCode" placeholder="{{ __("Postal Code") }}">
            <span class="error-message" id="newPostalCode-error"></span>
        </div>
        <div class="grid-item">
            <label for="newFamousPlaceNearby" class="form-label">{{ __("Famous Place Nearby") }}</label>
            <input type="text" class="form-control" id="newFamousPlaceNearby" placeholder="{{ __("Famous Place Nearby") }}">
            <span class="error-message" id="newFamousPlaceNearby-error"></span>
        </div>
        <div class="grid-item">
            <label for="newPhone1" class="form-label">{{ __("Phone1") }} *</label>
            <input type="text" class="form-control" id="newPhone1" placeholder="">
            <span class="error-message" id="newPhone1-error"></span>
        </div>
        <div class="grid-item">
            <label for="newPhone2" class="form-label">{{ __("Phone2") }}</label>
            <input type="text" class="form-control" id="newPhone2" placeholder="">
            <span class="error-message" id="newPhone2-error"></span>
        </div>
        <div id="store-errors"></div>
    </div>
    <button class="btn-save" onclick="saveNewAddress('{{ route('addresses.store') }}', '{{ csrf_token() }}')">{{ __('Save') }}</button>
</div>
