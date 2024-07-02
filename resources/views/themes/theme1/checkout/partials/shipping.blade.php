<div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
        <div class="title">
            <b><strong>2</strong>  {{ __("Select Shipping Method") }} </b>
            <span id="selectedShippingInfo"></span>
        </div>
        <button class="btn btn-sm btn-link edit-button" style="display:none;" onclick="editStage(2)"> {{ __("Edit") }} </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
        data-bs-parent="#checkoutAccordion">
        <div class="accordion-body">
            <div class="shipping-methods" id="shippingMethods">
                @forelse ($shippings as $index => $shipping)
                    <div class="form-check shipping-wrap">
                        <label class="form-check-label" for="shipping{{ $index }}">
                            <input class="form-check-input" type="radio" name="shipping" id="shipping{{ $index }}"
                                value="{{ $shipping->id }}" data-shipping-price="{{ $shipping->price }}">
                             {{--<img src="images/shipping/01.svg" alt="Express Trade House">--}}
                            <span>  {{ $shipping->name }} </span>
                        </label>
                        <div class="shipping-cost">
                            <span> {{ $shipping->duration }}</span>
                            <span>{{ $shipping->price }} {{ $currency }}</span>
                        </div>
                    </div>
                @empty
                    <p class="text-center"> {{ __("No shipping methods available.") }} </p>
                @endforelse
            </div>
            <button class="btn-save" onclick="confirmShipping()"> {{ __("Confirm Shipping") }} </button>
        </div>
    </div>
</div>
