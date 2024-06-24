<div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
    data-bs-parent="#checkoutAccordion">
    <div class="accordion-body">
        <div class="payment-options">
            <div class="form-check payment-wrap">
                <label class="form-check-label" for="visa">
                    <input class="form-check-input" type="radio" name="payment" id="visa" value="visa"
                        onclick="showPaymentForm('visa')">
                    <img src="visa_logo.png" alt="Visa" style="width: 50px;">
                </label>
            </div>
            <div class="form-check payment-wrap">
                <label class="form-check-label" for="mastercard">
                    <input class="form-check-input" type="radio" name="payment" id="mastercard" value="mastercard"
                        onclick="showPaymentForm('mastercard')">
                    <img src="images/payment/mada_mini.webp" alt="MasterCard" style="width: 50px;">
                </label>
            </div>
            <div class="form-check payment-wrap">
                <label class="form-check-label" for="cod">
                    <input class="form-check-input" type="radio" name="payment" id="cod" value="cod"
                        onclick="showPaymentForm('cod')">
                    <img src="images/payment/apple_pay_mini.webp" alt="Cash on Delivery" style="width: 50px;">
                </label>
            </div>
        </div>
        <div class="visa-form" id="visaForm" style="display:none;">
            <div class="payment-wrapper">
                <div class="mb-3">
                    <label for="visaCardNumber" class="form-label">Card Number</label>
                    <input type="text" class="form-control" id="visaCardNumber" placeholder="Enter your card number">
                </div>
                <div class="mb-3">
                    <label for="visaExpiryDate" class="form-label">Expiry Date</label>
                    <input type="text" class="form-control" id="visaExpiryDate" placeholder="MM/YY">
                </div>
                <div class="mb-3">
                    <label for="visaCVC" class="form-label">CVC</label>
                    <input type="text" class="form-control" id="visaCVC" placeholder="Enter your CVC">
                </div>
            </div>
        </div>

        <div class="mastercard-form" id="mastercardForm" style="display:none;">
            <div class="payment-wrapper">
                <div class="mb-3">
                    <label for="masterCardNumber" class="form-label">Card Number</label>
                    <input type="text" class="form-control" id="masterCardNumber"
                        placeholder="Enter your card number">
                </div>
                <div class="mb-3">
                    <label for="masterExpiryDate" class="form-label">Expiry Date</label>
                    <input type="text" class="form-control" id="masterExpiryDate" placeholder="MM/YY">
                </div>
                <div class="mb-3">
                    <label for="masterCVC" class="form-label">CVC</label>
                    <input type="text" class="form-control" id="masterCVC" placeholder="Enter your CVC">
                </div>
            </div>
        </div>

        <button class="btn-save" onclick="completeOrder()">Complete Order</button>
    </div>
</div>
