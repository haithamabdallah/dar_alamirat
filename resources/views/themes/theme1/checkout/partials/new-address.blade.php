
<div class="new-address-form" id="newAddressForm">
  <a class="btn-close-address" onclick="cancelNewAddress()"><i
          class="fa-solid fa-xmark"></i></a>
  <div class="grid-list">
      <div class="grid-item">
          <label for="newGovernorate" class="form-label">Governorate</label>
          <input type="text" class="form-control" id="newGovernorate"
              placeholder="Enter your governorate">
      </div>
      <div class="grid-item">
          <label for="newCity" class="form-label">City</label>
          <input type="text" class="form-control" id="newCity"
              placeholder="Enter your city">
      </div>
      <div class="grid-item">
          <label for="newStreet" class="form-label">Street</label>
          <input type="text" class="form-control" id="newStreet"
              placeholder="Enter your street">
      </div>
      <div class="grid-item">
          <label for="newHouseNumber" class="form-label">House Number</label>
          <input type="text" class="form-control" id="newHouseNumber"
              placeholder="Enter your house number">
      </div>
      <div class="grid-item">
          <label for="newPostalCode" class="form-label">Postal Code</label>
          <input type="text" class="form-control" id="newPostalCode"
              placeholder="Enter your postal code">
      </div>
      <div class="grid-item">
          <label for="newFamousPlaceNearby" class="form-label">Famous Place
              Nearby</label>
          <input type="text" class="form-control" id="newFamousPlaceNearby"
              placeholder="Enter your famous Place Nearby">
      </div>
      <div class="" id="store-errors" > 
      </div>
  </div>
  <button class="btn-save" onclick="saveNewAddress('{{ route('addresses.store') }}' , '{{ csrf_token() }}')">Save Address</button>
</div>