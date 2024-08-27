@extends('dashboard.layouts.app')
@section('meta')
    <meta charset="utf-8" />
    <title> {{ __('dashboard.orders') }} </title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
@endsection

@section('customcss')
    <link href="{{ asset('admin-panel/assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('admin-panel/assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('admin-panel/assets/plugins/switchery/dist/switchery.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <div class="d-flex align-items-center mb-3">

            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('dashboard.home') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('order.index') }}"> Orders </a></li>
                </ul>
                <h1 class="page-header mb-0"> Orders </h1>
            </div>
            <div class="ms-auto">
                <a href="{{ route('dashboard.order.all') }}" class="btn btn-success btn-rounded px-4 rounded-pill"><i
                        class="fa fa-book fa-lg me-2 ms-n2 text-success-900"></i> Show All Orders</a>
                {{-- <a href="{{ route('order.create') }}" class="btn btn-success btn-rounded px-4 rounded-pill"><i
                        class="fa fa-plus fa-lg me-2 ms-n2 text-success-900"></i> {{ __('dashboard.order.add') }}</a> --}}
            </div>
        </div>

        @include('dashboard.layouts.alerts')

        <!-- start card -->
        <div class="card border-0 mb-3 p-2">
            <!-- tab content -->
            <div class="tab-content p-3">
                <!-- tap panel -->
                <div class="tab-pane fade show active" id="allTab">
                    <div class="row">
                        <form action="{{ route('dashboard.order.search.post') }}" method="POST">
                            @csrf
                            <div class="d-flex flex-row justify-content-between" style="gap: 1rem">
                                <div class="row mb-3 col-md-6 d-flex flex-col" style="gap: 10px">
                                    <label for="title-input form-label"> User Email </label>
                                    <input type="text" name="user_email" id="user-email-input"
                                        class="form-control rounded w-100" placeholder="Search By User Email">
                                    @error('user_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="row mb-3 col-md-6 d-flex flex-col" style="gap: 10px">
                                    <label for="title-input form-label"> Order Number </label>
                                    <input type="text" name="order_number" id="order-number-input"
                                        class="form-control rounded w-100" placeholder="Search By Order Number">
                                    @error('order_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary col-12" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ./end card -->
        <!-- start card -->
        <div class="card border-0">
            <!-- content -->
            <div class="tab-content p-3">
                <!-- tab pane -->
                <div class="tab-pane fade show active" id="allTab">

                    <!-- BEGIN table -->
                    <div class="row">
                        <table id="" class="table table-striped table-bordered align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Customer</th>
                                    <th>VAT</th>
                                    <th>Shipping Price</th>
                                    <th>Final Price</th>
                                    {{-- <th>Currency</th> --}}
                                    <th>Payment status</th>
                                    <th>Fulfillment status</th>
                                    {{-- <th>Delivery method</th> --}}
                                    <th class="text-nowrap" width="5%"> Show </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($orders) && count($orders) > 0)
                                    @forelse ($orders as $index => $order)
                                        <tr>
                                            <td class="w-10px align-middle">
                                                <div class="form-check">
                                                    {{ $index + 1 }}
                                                </div>
                                            </td>
                                            <td> <a
                                                    href="{{ route('order.show', $order->id) }}">{{ $order->order_number }}</a>
                                            </td>
                                            <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                            <td>{{ $order->created_at->format('h:i A') }}</td>
                                            <td>{{ $order->user->full_name }}</td>
                                            <td>{{ $order->vat ?? '---' }}</td>
                                            <td>{{ $order->shipping_price ?? '---' }} ( {{ $order->shippingMethod->name }}
                                                )
                                            </td>
                                            <td>{{ $order->final_price }} </td>
                                            {{-- <td>{{ $currency }}</td> --}}
                                            <td><span
                                                    class="badge border border-{{ $paymentStatuses[$order->payment_status]['color'] }} text-{{ $paymentStatuses[$order->payment_status]['color'] }} px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i
                                                        class="fa fa-circle fs-9px fa-fw me-5px"></i>
                                                    {{ $paymentStatuses[$order->payment_status][app()->currentLocale()] ?? $order->payment_status }}
                                                </span></td>
                                            <td><span
                                                    class="badge border border-{{ $paymentStatuses[$order->payment_status]['color'] }} text-{{ $paymentStatuses[$order->payment_status]['color'] }} px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i
                                                        class="fa fa-circle fs-9px fa-fw me-5px"></i>
                                                    {{ $orderStatuses[$order->status][app()->currentLocale()] ?? $order->status }}
                                                </span></td>

                                            {{-- <td>{{ $order->shippingMethod->name }}</td> --}}
                                            <td nowrap="">
                                                <a href="{{ route('order.show', $order->id) }}"
                                                    class="btn btn-sm btn-primary">
                                                    Show </a>
                                            </td>
                                        </tr>

                                    @empty
                                        <p>NO ORDERS YET</p>
                                    @endforelse
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- ./table -->

                    <!-- pagination -->
                    @if (!isset($isNotPaginated))
                        @if ($orders->lastPage() > 1)
                            @include('shared.dashboard.pagination', ['paginated' => $orders])
                        @endif
                    @endif
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
    <script>
        function searchOrderNumber() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchForOrder");
            filter = input.value.toUpperCase();
            table = document.getElementById("ordersTableList");
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
@endsection
