<div class="">
    <!-- item -->
    <div class="row mb-15px">
        <label class="form-label col-form-label col-md-3">Code <small>(Ex.
                SPRING-2022)</small></label>
        <div class="col-md-9">
            <input class="form-control" type="text" name="code" placeholder="SPRING-2022"
                value="{{ $coupon->code ?? old('code') }}" required />
            @error('code')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <!-- ./item -->

    @if (! request()->route()->named('dashboard.coupons.edit') )

        <div class="">
            <!-- ./item -->
            @php
                $discount_type = $coupon->discount_type ?? (old('discount_type') ?? 'flat');
            @endphp

            <div class="row mb-15px">
                <label class="form-label col-form-label col-md-3">Discount type</label>
                <div class="col-md-9">
                    <select class=" form-control" name="discount_type" required>
                        <option disabled>Select Discount type</option>
                        @foreach (['flat' => 'Flat', 'percent' => 'Percent'] as $key => $value)
                            <option {{ $discount_type == $key ? 'selected' : '' }} value="{{ $key }}">
                                {{ $value }}</option>
                        @endforeach
                    </select>
                    @error('discount_type')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <!-- ./item -->

            <!-- ./item -->
            <div class="row mb-15px">
                <label class="form-label col-form-label col-md-3">Discount Value</label>
                <div class="col-md-9">
                    <input type="number" name="discount_value" class="form-control"
                        placeholder="Insert the discount value" min="0" required
                        value="{{ $coupon->discount_value ?? old('discount_value') }}" />
                    @error('discount_value')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <!-- item -->
        </div>
    @endif

    <!-- item -->
    <div class="row mb-15px">
        <label class="form-label col-form-label col-md-3">Start Date <small> (Ex.
                2022-02-22)</small></label>
        <div class="col-md-9">
            <div class="input-group">
                <input
                    type="text"
                    id="start_date"
                    name="start_date"
                    class="form-control"
                    value="{{ $coupon->start_date ?? old('start_date') }}"
                    placeholder="click to select the Start date" required />
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
            @error('start_date')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <!-- ./item -->

    <!-- item -->
    <div class="row mb-15px">
        <label class="form-label col-form-label col-md-3">End Date <small> (Ex.
                2022-02-22)</small></label>
        <div class="col-md-9">
            <div class="input-group">
                <input
                    type="text"
                    id="end_date"
                    name="end_date"
                    class="form-control"
                    value="{{ $coupon->end_date ?? old('end_date') }}"
                    placeholder="click to select the End Date" required />
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
            @error('end_date')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <!-- ./item -->

    <!-- item -->
    <div class="row mb-15px">
        <label class="form-label col-form-label col-md-3">Limit Per User</label>
        <div class="col-md-9">
            <input class="form-control" type="number" name="limit_per_user" min="1" placeholder="1"
                value="{{ $coupon->limit_per_user ?? old('limit_per_user') }}" required />
            @error('limit_per_user')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <!-- ./item -->

    <!-- item -->
    <div class="row mb-15px">
        <label class="form-label col-form-label col-md-3">Usage Limit</label>
        <div class="col-md-9">
            <input class="form-control" type="number" name="usage_limit" min="1" placeholder="1"
                value="{{ $coupon->usage_limit ?? old('usage_limit') }}" required />
            @error('usage_limit')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <!-- ./item -->

    <!-- item -->
    <div class="row mb-15px">
        <label class="form-label col-form-label col-md-3">Note</label>
        <div class="col-md-9">
            <input class="form-control" type="text" name="note" placeholder="Note for this coupon"
                value="{{ $coupon->note ?? old('note') }}"  />
            @error('note')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <!-- ./item -->

    <!-- item -->
    <div class="row mb-15px">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary d-block w-100"><i class="fa-regular fa-floppy-disk"></i>
                Save</button>
        </div>
    </div>
    <!-- ./item -->
</div>