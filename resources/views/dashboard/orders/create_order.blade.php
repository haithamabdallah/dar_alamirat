@extends('dashboard.layouts.app')

@section('customcss')
    <link href="{{ asset('admin-panel/assets/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin-panel/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
@endsection


@section('content')

    <!-- BEGIN #content -->
    <div id="content" class="app-content">

        <!-- BEGIN breadcrumb -->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="">Orders</a></li>
            <li class="breadcrumb-item active">
                Create Order
            </li>
        </ol>
        <!-- END breadcrumb -->

        <!-- BEGIN page-header -->
        <h1 class="page-header">Create Order</h1>
        <!-- END page-header -->

        <!-- BEGIN col-6 -->
        <div class="col-xl-6">
            <!-- panel -->
            <div class="panel panel-inverse">
                <!-- panel heading -->
                <div class="panel-heading ui-sortable-handle">
                    <h4 class="panel-title">Create Order</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <!-- ./panel heading -->

                <!-- panel body -->
                <div class="panel-body">
                    <!-- FORM -->
                    <form action="{{ route('order.store') }}" method="POST">
                    @csrf
                       @method('POST')
                        <!-- item -->
                        {{-- <div class="row mb-15px">
                            <label class="form-label col-form-label col-md-3">Order Number</label>
                            <div class="col-md-9">
                                <input class="form-control" type="number" name='order_number' />
                                @error('order_number')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> --}}
                        <!-- ./item -->

                        <!-- item -->
                        {{-- <div class="row mb-15px">
                            <label class="form-label col-form-label col-md-3">Created Date</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="datepicker-autoClose" />
                            </div>
                        </div> --}}
                        <!-- ./item -->

                        <!-- item -->
                        <div class="row mb-15px">
                            <label class="form-label col-form-label col-md-3">Choose a Product</label>
                            <div class="col-md-9">
                                <select id="product-select" class="form-control" name="product_id">
                                    <option value="">Select a Product</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" ><strong>{{ $product->title }}</strong> </option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                <div class="text-danger">{{ $message }}</div>
                              @enderror
                            </div>
                        </div>
                        <!-- ./item -->

                        <!-- item -->
                        <div class="row mb-15px">
                            <label class="form-label col-form-label col-md-3">Choose a Variant</label>
                            <div class="col-md-9">
                                <select id="variant-select" class="form-control" name="variant_id">
                                    <!-- Variants will be dynamically populated here -->
                                </select>
                            </div>
                        </div>
                        <!-- ./item -->

                        <!-- item -->
                        <div class="row mb-15px">
                            <label class="form-label col-form-label col-md-3">Quantity</label>
                            <div class="col-md-9">
                                <input type="number" class="form-control amount-input" name="quantity" value="" min="1">
                                @error('quantity')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>
                        <!-- ./item -->

                        <!-- item -->
                        <div class="row mb-15px">
                            <label class="form-label col-form-label col-md-3">Choose a Customer</label>
                            <div class="col-md-9">
                                <select id="customer-select" class="form-control" name="user_id">
                                    <option value="">Select a Customer</option>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->full_name }}</option>
                                    @endforeach

                                </select>
                                @error('user_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>
                        <!-- ./item -->

                        <!-- item -->
                        <div class="row mb-15px">
                            <label class="form-label col-form-label col-md-3">Shipping method</label>
                            <div class="col-md-9">
                                <select class="form-select" name="shipping_id">
                                    <option value="">Select a Shipping</option>
                                    @foreach($shippingMethods as $shippingMethod)
                                        <option value="{{ $shippingMethod->id }}">{{ $shippingMethod->name }}</option>
                                    @endforeach
                                </select>
                                @error('shipping_id')
                       <div class="text-danger">{{ $message }}</div>
                        @enderror
                            </div>
                        </div>
                        <!-- ./item -->

                        <!-- item -->
                        {{-- <div class="row mb-15px">
                            <label class="form-label col-form-label col-md-3">Payment method</label>
                            <div class="col-md-9">
                                <select class="form-select" name="">

                                </select>
                            </div>
                        </div> --}}
                        <!-- ./item -->

                        <!-- item -->
                        {{-- <div class="row mb-15px">
                            <label class="form-label col-form-label col-md-3">Payment Status</label>
                            <div class="col-md-9">
                                <select class="form-select" name="">

                                </select>
                            </div>
                        </div> --}}
                        <!-- ./item -->

                        <!-- item -->
                        {{-- <div class="row mb-15px">
                            <label class="form-label col-form-label col-md-3">Fulfillment status</label>
                            <div class="col-md-9">
                                <select class="form-select" name="">

                                </select>
                            </div>
                        </div> --}}
                        <!-- ./item -->

                        <!-- item -->
                        {{-- <div class="row mb-15px">
                            <label class="form-label col-form-label col-md-3">Total</label>
                            <div class="col-md-9">
                                <p class="form-control text-success">$398.00</p>
                            </div>
                        </div> --}}
                        <!-- ./item -->

                        <!-- item -->
                        <div class="row mb-15px">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary d-block w-100"><i class="fa-regular fa-floppy-disk"></i> Save</button>
                            </div>
                        </div>
                        <!-- ./item -->

                    </form>
                    <!-- ./FORM -->
                </div>
                <!-- ./panel body -->
            </div>
            <!-- ./panel -->
        </div>
        <!-- ./END col-6 -->
    </div>
    <!-- END #content -->


@endsection

@section('scripts')
    <script src="{{ asset('admin-panel/assets/plugins/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin-panel/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js') }}"></script>
    <script>

        $(".multiple-select2").select2({ placeholder: "Select a product" });

        $("#datepicker-autoClose").datepicker({
            todayHighlight: true,
            autoclose: true,
            format: 'D, dd, MM, yyyy',
        });

    </script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

    <script type="text/javascript">
        $(document).ready(function () {
            $('#product-select').change(function () {
                var productId = $(this).val();

                $.ajax({
                    url: '{{ route('get.variants') }}',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        product_id: productId
                    },
                    success: function (response) {
                        // Clear previous options
                        $('#variant-select').empty();

                        // Append new options
                        $.each(response, function (key, value) {
                            $('#variant-select').append('<option value="' + value.id + '">' + value.color + ' - ' + value.size + '</option>');
                        });
                    }
                });
            });
        });
    </script>
{{-- <script type="text/javascript">
    $(document).ready(function () {
        // Add another product
        $('.add-product').click(function () {
            var productClone = $('.product-select').first().clone(); // Clone the product selection
            var variantClone = $('.variant-select').first().clone(); // Clone the variant selection
            var amountClone = $('.amount-input').first().clone(); // Clone the amount input

            // Clear selected values in the cloned elements
            variantClone.val('');
            amountClone.val(1);

            // Append the cloned elements to the form
            $('.product-select').last().after(productClone);
            $('.variant-select').last().after(variantClone);
            $('.amount-input').last().after(amountClone);
        });

        // AJAX call to fetch variants based on product selection
$(document).on('change', '.product-select', function () {
    var productId = $(this).val();
    var variantSelect = $(this).closest('.col-4').next().find('.variant-select');

    // Make AJAX call to fetch variants based on productId and update variant dropdown
    $.ajax({
        url: '/get-variants', // Replace with your route to fetch variants
        type: 'GET',
        dataType: 'json',
        data: {
            product_id: productId
        },
        success: function (response) {
            // Clear existing options
            variantSelect.empty();

            // Append new options
            $.each(response, function (key, value) {
                variantSelect.append('<option value="' + value.id + '">' + value.name + '</option>');
            });
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});

    });
</script> --}}
@endsection
