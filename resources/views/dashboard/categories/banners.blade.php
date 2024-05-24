@extends('dashboard.layouts.app')
@section('meta')
    <meta charset="utf-8" />
    <title> {{__('dashboard.categories')}} </title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
@endsection

@section('customcss')

    <link href="{{ asset('admin-panel/assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin-panel/assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin-panel/assets/plugins/switchery/dist/switchery.min.css') }}" rel="stylesheet" />

@endsection

@section('content')

    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <div class="d-flex align-items-center mb-3">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">{{__('dashboard.home')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('banner.index')}}">{{__('dashboard.banners')}}</a></li>
                </ul>
                <h1 class="page-header mb-0">{{__('dashboard.categories')}}</h1>
            </div>
            <div class="ms-auto">
                <a href="{{ route('banner.create') }}" class="btn btn-success btn-rounded px-4 rounded-pill"><i class="fa fa-plus fa-lg me-2 ms-n2 text-success-900"></i>{{__('dashboard.banner.add')}}</a>
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
                    <div class="input-group mb-3">
                        <p class="btn btn-white dropdown-toggle"><span class="d-none d-md-inline">Filter By Banner Name</span></p>
                        <div class="flex-fill position-relative">
                            <div class="input-group">
                                <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 start-0" style="z-index: 1;">
                                    <i class="fa fa-search opacity-5"></i>
                                </div>
                                <input type="text" id="searchForCategory" onkeyup="searchCategoryName()" class="form-control px-35px bg-light" placeholder="Search order Number..." />
                            </div>
                        </div>
                    </div>
                    <!-- END input-group -->

                    <!-- table -->
                    <div class="table-responsive mb-3">
                        <table id="categoryTableList" class="table table-hover table-panel text-nowrap align-middle mb-0">
                            <thead>
                            <tr>
                                <th width="1%"></th>
                                <th class="text-nowrap" width="5%">Priority</th>
                                <th class="text-nowrap" width="5%">Image</th>
                                <th class="text-nowrap" width="5%">status</th>
                                <th class="text-nowrap" width="5%">Edit</th>
                                <th class="text-nowrap" width="5%">Delete</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($banners as $banner)
                                <tr class="odd gradeX">
                                    <td width="1%" class="fw-bold text-dark">{{ $loop->iteration }}</td>
                                    <td>{{$banner->category->priority}}</td>
                                    <td width="1%" class="with-img">
                                        <img src="{{storage_asset($banner->image)}}" class="rounded h-30px my-n1 mx-n1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" class="switch-status" data-url="{{ route('banner.status' , $banner->id) }}" @if($banner->category->status) checked @endif/>
                                    </td>
                                    <td nowrap="">
                                        @adminCan('categories.edit')
                                        <a href="{{route('banner.edit' , $banner->id)}}" class="btn btn-sm btn-primary"> <i class="fa-regular fa-pen-to-square"></i> {{__('dashboard.banner.edit')}}</a>
                                        @endadminCan
                                    </td>
                                    <td nowrap="">
                                        @adminCan('categories.delete')
                                        <form id="deleteForm{{$banner->id}}" action="{{ route('banner.destroy', $banner->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a class="btn delete-btn btn-danger" data-id="{{$banner->id}}"><i class="fa-solid fa-trash-can"></i> {{__('dashboard.banner.delete')}}</a>
                                        </form>
                                        @endadminCan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- ./table -->

                    <!-- pagination -->
                    <div class="d-md-flex align-items-center">
                        <div class="me-md-auto text-md-left text-center mb-2 mb-md-0">
                            Showing {{ $banners->firstItem() }} to {{ $banners->lastItem() }} of {{ $banners->total() }} entries
                        </div>
                        <ul class="pagination mb-0 justify-content-center">
                            {{ $banners->links('pagination::bootstrap-4') }}
                        </ul>
                    </div>
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
    <script src="{{ asset('admin-panel/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin-panel/assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('admin-panel/assets/plugins/switchery/dist/switchery.min.js') }}"></script>

    <script>
        $('#data-table-default').DataTable({
            responsive: true
        });

        var elems = Array.prototype.slice.call(document.querySelectorAll('.switch-status'));
        elems.forEach(function(html) {
            var switchery = new Switchery(html, {
                color: '#00acac'
            });
        });
    </script>

    <script>
        function searchCategoryName() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchForCategory");
            filter = input.value.toUpperCase();
            table = document.getElementById("categoryTableList");
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
