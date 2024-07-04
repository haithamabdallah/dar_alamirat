@extends('dashboard.layouts.app')

@section('content')

    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <div class="d-flex align-items-center mb-3">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Extra</a></li>
                    <li class="breadcrumb-item active">Orders</li>
                </ul>
                <h1 class="page-header mb-0">Orders</h1>
            </div>
            {{-- <div class="ms-auto">
                <a href="{{route('order.create')  }}" class="btn btn-success btn-rounded px-4 rounded-pill"><i class="fa fa-plus fa-lg me-2 ms-n2 text-success-900"></i> Create Orders</a>
            </div> --}}
        </div>

        @include('dashboard.layouts.alerts')


        <div class="card border-0">
            <ul class="nav nav-tabs nav-tabs-v2 px-3">
                <li class="nav-item me-2"><a href="#allTab" class="nav-link px-2 active" data-bs-toggle="tab">All</a></li>
                {{-- <li class="nav-item me-2"><a href="#publishedTab" class="nav-link px-2" data-bs-toggle="tab">Unfulfilled</a></li>
                <li class="nav-item me-2"><a href="#expiredTab" class="nav-link px-2" data-bs-toggle="tab">Unpaid</a></li>
                <li class="nav-item me-2"><a href="#deletedTab" class="nav-link px-2" data-bs-toggle="tab">Open</a></li>
                <li class="nav-item me-2"><a href="#deletedTab" class="nav-link px-2" data-bs-toggle="tab">Closed</a></li>
                <li class="nav-item me-2"><a href="#deletedTab" class="nav-link px-2" data-bs-toggle="tab">Local delivery</a></li> --}}
            </ul>
            <div class="tab-content p-3">
                <div class="tab-pane fade show active" id="allTab">
                    <!-- BEGIN input-group -->
                    <div class="input-group mb-3">
                        <p class="btn btn-white dropdown-toggle"><span class="d-none d-md-inline">Filter By order Number</span></p>
                        <div class="flex-fill position-relative">
                            <div class="input-group">
                                <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 start-0" style="z-index: 1;">
                                    <i class="fa fa-search opacity-5"></i>
                                </div>
                                <input type="text" id="searchForOrder" onkeyup="searchOrderNumber()" class="form-control px-35px bg-light" placeholder="Search order Number..." />
                            </div>
                        </div>
                    </div>
                    <!-- END input-group -->

                    <!-- BEGIN table -->
                    <div class="table-responsive mb-3">
                        <table id="ordersTableList" class="table table-hover table-panel text-nowrap align-middle mb-0">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Order</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Customer</th>
                                <th>VAT</th>
                                <th>Shipping Price</th>
                                <th>Final Price</th>
                                <th>Payment status</th>
                                <th>Fulfillment status</th>
                                <th>Delivery method</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order )

                            <tr>
                                <td class="w-10px align-middle">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="product1">
                                        <label class="form-check-label" for="product1"></label>
                                    </div>
                                </td>
                                <td> <a href="{{ route('order.show', $order->id) }}">{{ $order->order_number }}</a></td>
                                <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                <td>{{ $order->created_at->format('h:i A') }}</td>
                                <td>{{ $order->user->full_name }}</td>
                                <td>{{ $order->vat }}</td>
                                <td>{{ $order->Shipping_price }}</td>
                                <td>{{  $order->final_price }} {{ $currency }}</td>
                                <td><span class="badge border border-success text-success px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> {{ $order->payment_status }} </span></td>
                                <td><span class="badge border border-success text-success px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> {{ $order->status }} </span></td>

                                <td>{{ $order->shippingMethod->name }}</td>
                            </tr>

                            @empty
                            <p>NO ORDERS YET</p>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- END table -->

                    <!-- pagination -->
                    <div class="d-md-flex align-items-center">
                        <div class="me-md-auto text-md-left text-center mb-2 mb-md-0">
                            Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} entries
                        </div>
                        <ul class="pagination mb-0 justify-content-center">
                            {{-- Previous Page Link --}}
                            @if ($orders->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">Previous</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $orders->previousPageUrl() }}" rel="prev">Previous</a>
                                </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                                @if ($page == $orders->currentPage())
                                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($orders->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $orders->nextPageUrl() }}" rel="next">Next</a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">Next</span>
                                </li>
                            @endif
                        </ul>
                    </div>

                    <!-- ./pagination -->
                </div>
            </div>
        </div>
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
