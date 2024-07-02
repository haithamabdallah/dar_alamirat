<div class="edit-address-form" id="editAddressForm">
    <h3>{{__("Edit Address")}}</h3>
    <div class="mb-3">
        <label for="editGovernorate" class="form-label"> {{ __("Governorate") }} </label>
        <input type="text" class="form-control" id="editGovernorate" placeholder="{{ __("Governorate") }}">
    </div>
    <div class="mb-3">
        <label for="editCity" class="form-label">{{ __("City") }}</label>
        <input type="text" class="form-control" id="editCity" placeholder="{{ __("City") }}">
    </div>
    <div class="mb-3">
        <label for="editStreet" class="form-label">{{ __("Street") }}</label>
        <input type="text" class="form-control" id="editStreet" placeholder="{{ __("Street") }}">
    </div>
    <div class="mb-3">
        <label for="editPostalCode" class="form-label">{{ __("Postal Code") }}</label>
        <input type="text" class="form-control" id="editPostalCode" placeholder="{{ __("Postal Code") }}">
    </div>
    <div class="mb-3">
        <label for="editNeighborhood" class="form-label">{{ __("Famous Place Nearby") }}</label>
        <input type="text" class="form-control" id="editNeighborhood" placeholder="{{ __("Famous Place Nearby") }}">
    </div>
    <div class="mb-3">
        <label for="editHouseNumber" class="form-label">{{ __("House Number") }}</label>
        <input type="text" class="form-control" id="editHouseNumber" placeholder="{{ __("House Number") }}">
    </div>
    <div class="grid-item">
        <label for="editPhone1" class="form-label">{{ __("Phone1") }}</label>
        <input type="text" class="form-control" id="editPhone1" placeholder="{{ __("Phone1") }}">
    </div>
    <div class="grid-item">
        <label for="editPhone2" class="form-label">{{ __("Phone2") }}</label>
        <input type="text" class="form-control" id="editPhone2" placeholder="{{ __("Phone2") }}">
    </div>
    <div class="" id="edit-errors" > 
    </div>
    <button class="btn btn-primary" onclick="saveEditAddress()">{{ __("Save") }}</button>
    {{-- <button class="btn btn-secondary" onclick="cancelEditAddress()">Cancel</button> --}}
</div>
