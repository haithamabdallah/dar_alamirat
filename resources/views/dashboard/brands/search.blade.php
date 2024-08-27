@extends('dashboard.layouts.app')
@section('meta')
    <meta charset="utf-8" />
    <title> {{ __('dashboard.brands') }} </title>
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
                    <li class="breadcrumb-item"><a href="{{ route('brand.index') }}">{{ __('dashboard.brands') }}</a></li>
                </ul>
                <h1 class="page-header mb-0">{{ __('dashboard.brands') }}</h1>
            </div>
            <div class="ms-auto">
                <a href="{{ route('dashboard.brand.all') }}" class="btn btn-success btn-rounded px-4 rounded-pill"><i
                    class="fa fa-book fa-lg me-2 ms-n2 text-success-900"></i> Show All Brands</a>
                <a href="{{ route('brand.create') }}" class="btn btn-success btn-rounded px-4 rounded-pill"><i
                        class="fa fa-plus fa-lg me-2 ms-n2 text-success-900"></i> {{ __('dashboard.brand.add') }}</a>
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
                        <form action="{{ route('dashboard.brand.search.post') }}" method="POST">
                            @csrf
                            <div class="d-flex flex-row justify-content-between" style="gap: 1rem">
                                <div class="row mb-3 col-md-12 d-flex flex-col" style="gap: 10px">
                                    <label for="title-input form-label"> Name </label>
                                    <input type="text" name="name" id="name-input" class="form-control rounded w-100"
                                        placeholder="Search By Name">
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
                                    <th width="1%"></th>
                                    <th class="text-nowrap" width="5%">Image</th>
                                    <th class="text-nowrap" width="40%">Name</th>
                                    <th class="text-nowrap" width="5%">status</th>
                                    <th class="text-nowrap" width="10%">created At</th>
                                    <th class="text-nowrap" width="5%">Edit</th>
                                    <th class="text-nowrap" width="5%">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($brands) && count($brands) > 0)
                                    @foreach ($brands as $brand)
                                        <tr class="odd gradeX">
                                            <td width="1%" class="fw-bold text-dark">{{ $loop->iteration }}
                                            </td>
                                            <td width="1%" class="with-img">
                                                <img src="{{ storage_asset($brand->image) }}"
                                                    class="rounded h-30px my-n1 mx-n1" />
                                            </td>
                                            <td>{{ $brand->name }}</td>
                                            {{-- <td>{{$brand->status}}</td> --}}
                                            <td>
                                                {{-- <input type="checkbox" class="switch-status" {!! ($brand->status) ? 'checked' : '' !!} /> --}}
                                                <input type="checkbox" class="switch-status"
                                                    data-url="{{ route('brand.status', $brand->id) }}"
                                                    @if ($brand->status) checked @endif />
                                            </td>
                                            <td>{{ $brand->created_at->format('Y-m-d') }}</td>
                                            <td nowrap="">
                                                <a href="{{ route('brand.edit', $brand->id) }}"
                                                    class="btn btn-sm btn-primary"> <i
                                                        class="fa-regular fa-pen-to-square"></i>
                                                    {{ __('dashboard.brand.edit') }}</a>
                                            </td>
                                            <td nowrap="">
                                                <form id="deleteForm{{ $brand->id }}"
                                                    action="{{ route('brand.destroy', $brand->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="btn delete-btn btn-danger" data-id="{{ $brand->id }}"><i
                                                            class="fa-solid fa-trash-can"></i>
                                                        {{ __('dashboard.brand.delete') }}</a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- ./table -->

                    <!-- pagination -->
                    @if (!isset($isNotPaginated))
                        @if ($brands->lastPage() > 1)
                            @include('shared.dashboard.pagination', ['paginated' => $brands])
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
    <script src="{{ asset('admin-panel/assets/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin-panel/assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('admin-panel/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <script src="{{ asset('admin-panel/assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}">
    </script>
    <script src="{{ asset('admin-panel/assets/plugins/switchery/dist/switchery.min.js') }}"></script>

    <script>
        function searchBrandName() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchForBrand");
            filter = input.value.toUpperCase();
            table = document.getElementById("brandTableList");
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
@endsection
