@extends('dashboard.layouts.app')

@section('customcss')
    <link href="{{ asset('admin-panel/assets/plugins/switchery/dist/switchery.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin-panel/assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin-panel/assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin-panel/assets/plugins/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css') }}" rel="stylesheet" />

@endsection

@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">

        <div class="d-flex align-items-center mb-3">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('dashboard.home') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">{{ __('dashboard.products') }}</a></li>
                </ul>
                <h1 class="page-header mb-0">{{ __('dashboard.products') . ' - ' . __('dashboard.table') }}</h1>
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
                    <!-- BEGIN input-group -->
                    <div class="input-group mb-3">
                        <p class="btn btn-white dropdown-toggle"><span class="d-none d-md-inline">Filter By Product
                                Name</span></p>
                        <div class="flex-fill position-relative">
                            <div class="input-group">
                                <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 start-0"
                                    style="z-index: 1;">
                                    <i class="fa fa-search opacity-5"></i>
                                </div>
                                <input type="text" id="searchForProduct" onkeyup="searchProductName()"
                                    class="form-control px-35px bg-light" placeholder="Search order Number..." />
                            </div>
                        </div>
                    </div>
                    <!-- END input-group -->

                    <!-- BEGIN table -->
                    <div class="table-responsive mb-3">
                        <table id="productsTableList" class="table table-hover table-panel text-nowrap align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="pt-0 pb-2" width="1%"></th>
                                    <th class="pt-0 pb-2" width="1%">Image</th>
                                    <th class="pt-0 pb-2" width="20%">Title</th>
                                    {{-- <th class="pt-0 pb-2" width="20%">Choice</th> --}}
                                    <th class="pt-0 pb-2" width="20%">Variants ( index ----- name ----- price ----- sku )
                                    </th>
                                    {{-- <th class="pt-0 pb-2" width="20%">Price</th>
                                    <th class="pt-0 pb-2" width="20%">SKU</th> --}}
                                    <th class="pt-0 pb-2" width="15%">Quantity</th>
                                    <th class="pt-0 pb-2" width="10%">Category</th>
                                    <th class="pt-0 pb-2" width="10">Brand</th>
                                    <th class="pt-0 pb-2" width="5%">Returnable ?</th>
                                    <th class="pt-0 pb-2" width="5%">Edit</th>
                                    <th class="pt-0 pb-2" width="5%">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td class="w-10px align-middle">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="{{ $product->id }}">
                                                <label class="form-check-label" for="product1"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div
                                                    class="w-30px h-30px bg-light d-flex align-items-center justify-content-center">
                                                    <img alt="" class="mw-100 mh-100"
                                                        src="{{ $product->thumbnail }}" />
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('product', $product->id) }}"
                                                class="text-dark text-decoration-none">{{ $product->title }}</a>
                                        </td>
                                        <td>
                                            <ul>
                                                @foreach ($product->variants as $index => $variant)
                                                    <li>{{ $index + 1 }} ----- {{ $variant->variant_name }} -----
                                                        {{ $variant->price_with_discount }} ----- {{ $variant->sku }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td class="align-middle">{{ $product->inventory->sum('quantity') }} in stock for
                                            {{ $product->variants->count() }} variants</td>
                                        <td class="align-middle">{{ $product->category->name }}</td>
                                        <td class="align-middle">{{ $product->brand->name }}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input id="toggleStatusCheckbox{{ $product->id }}"
                                                    class="form-check-input toggle-status-checkbox {{ $product->is_returnable ? '1' : '0' }}"
                                                    data-id="{{ $product->id }}"
                                                    type="checkbox" {{ $product->is_returnable ? 'checked' : '' }}>
                                            </div>
                                        </td>
                                        <td nowrap="">
                                            @adminCan('categories.edit')
                                                <a href="{{ route('product.edit', $product->id) }}"
                                                    class="btn btn-sm btn-primary"> <i class="fa-regular fa-pen-to-square"></i>
                                                    {{ __('dashboard.product.edit') }}</a>
                                            @endadminCan
                                        </td>
                                        <td nowrap="">
                                            @adminCan('categories.delete')
                                                <form id="deleteForm{{ $product->id }}"
                                                    action="{{ route('product.destroy', $product->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="btn delete-btn btn-danger" data-id="{{ $product->id }}"> <i
                                                            class="fa-solid fa-trash-can"></i>
                                                        {{ __('dashboard.product.delete') }}</a>
                                                </form>
                                            @endadminCan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- END table -->

                    <div class="row">
                        <table id="data-table-keytable" class="table table-striped table-bordered align-middle">
                            <thead>
                            <tr>
                                <th class="pt-0 pb-2" width="1%"></th>
                                <th class="pt-0 pb-2" width="1%">Image</th>
                                <th class="pt-0 pb-2" width="20%">Title</th>
                                <th class="pt-0 pb-2" width="20%">Variants ( index - name - price - sku )</th>
                                <th class="pt-0 pb-2" width="15%">Quantity</th>
                                <th class="pt-0 pb-2" width="10%">Category</th>
                                <th class="pt-0 pb-2" width="10">Brand</th>
                                <th class="pt-0 pb-2" width="5%">Returnable ?</th>
                                <th class="pt-0 pb-2" width="5%">Edit</th>
                                <th class="pt-0 pb-2" width="5%">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>22</td>
                                <td>1545464</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>22</td>
                                <td>12324234</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>22</td>
                                <td>1777</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>22</td>
                                <td>1456232</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>22</td>
                                <td>156456546</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>22</td>
                                <td>1234234</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>22</td>
                                <td>123234</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>22</td>
                                <td>123123</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>22</td>
                                <td>1345345</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>22</td>
                                <td>131231</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>22</td>
                                <td>14545645</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>22</td>
                                <td>2342341</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>22</td>
                                <td>20</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                                <td>22</td>
                                <td>1</td>
                            </tr>


                            </tbody>
                        </table>
                    </div>

                    <!-- pagination -->
                    {{--@include('shared.dashboard.pagination' , ['paginated' => $products])--}}
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
    <script src="{{ asset('admin-panel/assets/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin-panel/assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('admin-panel/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin-panel/assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('admin-panel/assets/plugins/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('admin-panel/assets/plugins/datatables.net-keytable-bs5/js/keyTable.bootstrap5.min.js') }}"></script>

    <script>
        $('#data-table-keytable').DataTable({
            autoWidth: true,
            keys: true,
            responsive: true
        });
    </script>

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
        $('#data-table-default').DataTable({
            responsive: true
        })

        var elems = Array.prototype.slice.call(document.querySelectorAll('.switch-status'));
        elems.forEach(function(html) {
            var switchery = new Switchery(html, {
                color: '#00acac'
            });
        });
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
