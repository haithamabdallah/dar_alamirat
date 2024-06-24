<div class="accordion-item">
  <h2 class="accordion-header" id="headingTwo">
      <div class="title">
          <b><strong>2</strong> Select Shipping Method</b>
          <span id="selectedShippingInfo"></span>
      </div>
      <button class="btn btn-sm btn-link edit-button" style="display:none;"
          onclick="editStage(2)">Edit</button>
  </h2>
  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
      data-bs-parent="#checkoutAccordion">
      <div class="accordion-body">
          <div class="shipping-methods" id="shippingMethods">
              <div class="form-check shipping-wrap">
                  <label class="form-check-label" for="shipping1">
                      <input class="form-check-input" type="radio" name="shipping"
                          id="shipping1" value="companyA">
                      <img src="images/shipping/01.svg" alt="Express Trade House">
                      <span>Express Trade House</span>
                  </label>
                  <span class="shipping-cost">40 LYD</span>
              </div>
              <div class="form-check shipping-wrap">
                  <label class="form-check-label" for="shipping2">
                      <input class="form-check-input" type="radio" name="shipping"
                          id="shipping2" value="companyB">
                      <img src="images/shipping/02.png" alt="Aramix">
                      <span>Aramix Standard Shipping</span>
                  </label>
                  <span class="shipping-cost">30 LYD</span>
              </div>
              <div class="form-check shipping-wrap">
                  <label class="form-check-label" for="shipping3">
                      <input class="form-check-input" type="radio" name="shipping"
                          id="shipping3" value="companyC">
                      <img src="images/shipping/03.png" alt="J&T">
                      <span>J&T Economy Shipping</span>
                  </label>
                  <span class="shipping-cost">20 LYD</span>
              </div>
          </div>
          <button class="btn-save" onclick="confirmShipping()">Confirm Shipping</button>
      </div>
  </div>
</div>