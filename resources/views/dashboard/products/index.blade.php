@extends('dashboard.layouts.app')

@section('customcss')
    <link href="{{ asset('admin-panel/assets/plugins/switchery/dist/switchery.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">

        <div class="d-flex align-items-center mb-3">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"> Home </a></li>
                    <li class="breadcrumb-item"><a href="{{ route('product.index') }}"> Products </a></li>
                </ul>
                <h1 class="page-header mb-0"> Products </h1>
            </div>
            <div class="ms-auto">
                <a href="{{ route('product.create') }}" class="btn btn-success btn-rounded px-4 rounded-pill"><i
                        class="fa fa-plus fa-lg me-2 ms-n2 text-success-900"></i> Add Product</a>
            </div>
        </div>

        @include('dashboard.layouts.alerts')

        <!-- start card -->
        <div class="card border-0">
            <!-- tab content -->
            <div class="tab-content p-3">
                <!-- tap panel -->
                <div class="tab-pane fade show active" id="allTab">
                    <!-- BEGIN table -->
                    <div class="row">
                        <table id="data-table-keytable" class="table table-striped table-bordered align-middle">
                            <thead>
                                <tr>
                                    @include('dashboard.products.partials.table-head')
                                </tr>
                            </thead>
                            <tbody>
                                @include('dashboard.products.partials.table-body')
                            </tbody>
                        </table>
                    </div>
                    <!-- END table -->

                    <!-- pagination -->
                    {{-- @include('shared.dashboard.pagination' , ['paginated' => $products]) --}}
                    <!-- ./pagination -->
                </div>
                <!-- ./tap panel -->
            </div>
            <!-- ./tab content -->
        </div>
        <!-- ./End Card -->
    </div>
    <!-- END #content -->
@endsection

@section('scripts')
    <script src="{{ asset('admin-panel/assets/plugins/switchery/dist/switchery.min.js') }}"></script>

    <script>
        function searchProductName() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchForProduct");
            filter = input.value.toUpperCase();
            table = document.getElementById("productsTableList");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

    <script>
        $(document).ready(function() {

            $('.toggle-status-checkbox').change(function() {
                var is_returnable = $(this).is(':checked');
                var product_id = $(this).data('id');

                $.ajax({
                    url: '{{ route('product.toggle-returnable') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        is_returnable: is_returnable,
                        product_id: product_id
                    },
                    success: function(response) {
                        // Handle success response
                        console.log(response);
                    },
                    error: function(xhr) {
                        // Handle error response
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
