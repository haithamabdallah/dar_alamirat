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
                    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">{{__('dashboard.home')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('dashboard.coupons.index')}}">{{__('dashboard.coupons')}}</a></li>
                </ul>
                <h1 class="page-header mb-0">{{__('dashboard.coupons')}}</h1>
            </div>
            <div class="ms-auto">
                <a href="{{route('dashboard.coupons.create')}}" class="btn btn-success btn-rounded px-4 rounded-pill"><i class="fa fa-plus fa-lg me-2 ms-n2 text-success-900"></i> {{__('dashboard.coupon.add')}}</a>
            </div>
        </div>

    @include('dashboard.layouts.alerts')

    <!-- start card -->
        <div class="card border-0">
            <!-- content -->
            <div class="tab-content p-3">
                <!-- tab pane -->
                <div class="tab-pane fade show active" id="allTab">

                    <!-- BEGIN input-group -->
                    {{-- <div class="input-group mb-3">
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
                    </div> --}}
                    <!-- END input-group -->

                    <!-- BEGIN table -->
                    <div class="row">
                        <table id="data-table-keytable" class="table table-striped table-bordered align-middle">
                            <thead>
                            <tr>
                                <th width="1%">#</th>
                                <th class="text-nowrap" width="10%">Code</th>
                                <th class="text-nowrap" width="10%">Start Date </th>
                                <th class="text-nowrap" width="10%">End Date </th>
                                <th class="text-nowrap" width="10%">discount type</th>
                                <th class="text-nowrap" width="10%">discount value</th>
                                <th class="text-nowrap" width="10%">Min Purchase Limit</th>
                                <th class="text-nowrap" width="10%">Note</th>
                                <th class="text-nowrap" width="10%">Limit Per User</th>
                                <th class="text-nowrap" width="10%">Usage Limit</th>
                                <th class="text-nowrap" width="10%">Usage Count</th>
                                <th class="text-nowrap" width="5%">status</th>
                                <th class="text-nowrap" width="10%">created At</th>
                                <th class="text-nowrap" width="5%">Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse ($coupons as $index => $coupon)
                                <tr class="odd gradeX">
                                    <td width="1%" class="fw-bold text-dark">{{ $index + 1 }}</td>
                                    <td>{{ $coupon->code }}</td>
                                    <td>{{ $coupon->start_date }}</td>
                                    <td>{{ $coupon->end_date }}</td>
                                    <td>{{ $coupon->discount_type }}</td>
                                    <td>{{ $coupon->discount_value }}</td>
                                    <td>{{ $coupon->min_purchase_limit }}</td>
                                    <td>{{ $coupon->note }}</td>
                                    <td>{{ $coupon->limit_per_user }}</td>
                                    <td>{{ $coupon->usage_limit }}</td>
                                    <td>{{ $coupon->usage_count }}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input id="toggleStatusCheckbox{{ $coupon->id }}"
                                                class="form-check-input toggle-status-checkbox {{ $coupon->status ? '1' : '0' }}"
                                                type="checkbox" {{ $coupon->status ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td>{{ $coupon->created_at->format('Y-m-d') }}</td>
                                    <td nowrap="">
                                        <a href="{{route('dashboard.coupons.edit' , $coupon->id)}}" class="btn btn-sm btn-primary"> <i class="fa-regular fa-pen-to-square"></i> Edit</a>
                                    </td>
                                </tr>
                                @empty
                                <p>No Coupons Found </p>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- ./table -->

                    <!-- pagination -->
                       {{-- @include('shared.dashboard.pagination' , ['paginated' => $coupons]) --}}
                    <!-- ./pagination -->
                </div>
                <!-- ./tab pane -->
            </div>
            <!-- ./content -->
        </div>
        <!-- ./end card -->
    </div>
    <!-- END #content -->

@endsection


@section('scripts')
    <script src="{{ asset('admin-panel/assets/plugins/switchery/dist/switchery.min.js') }}"></script>

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
        function searchCouponsName() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchForPage");
            filter = input.value.toUpperCase();
            table = document.getElementById("couponsTableList");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
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
                var isActive = $(this).is(':checked');
                var modelId = $(this).attr('id').replace('toggleStatusCheckbox', '');

                $.ajax({
                    url: '{{ route("dashboard.coupons.toggle-status") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        isActive: isActive,
                        modelId: modelId
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
