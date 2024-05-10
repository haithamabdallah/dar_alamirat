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
                    <li class="breadcrumb-item"><a href="{{route('brand.index')}}">{{__('dashboard.pages')}}</a></li>
                </ul>
                <h1 class="page-header mb-0">{{__('dashboard.pages')}}</h1>
            </div>
            <div class="ms-auto">
                <a href="{{route('page.create')}}" class="btn btn-success btn-rounded px-4 rounded-pill"><i class="fa fa-plus fa-lg me-2 ms-n2 text-success-900"></i> {{__('dashboard.page.add')}}</a>
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
                        <p class="btn btn-white dropdown-toggle"><span class="d-none d-md-inline">Filter By Page Name</span></p>
                        <div class="flex-fill position-relative">
                            <div class="input-group">
                                <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 start-0" style="z-index: 1;">
                                    <i class="fa fa-search opacity-5"></i>
                                </div>
                                <input type="text" id="searchForPage" onkeyup="searchPagesName()" class="form-control px-35px bg-light" placeholder="Search For Page..." />
                            </div>
                        </div>
                    </div>
                    <!-- END input-group -->

                    <!-- table -->
                    <div class="table-responsive mb-3">
                        <table id="pagesTableList" class="table table-hover table-panel text-nowrap align-middle mb-0">
                            <thead>
                            <tr>
                                <th width="1%"></th>
                                <th class="text-nowrap" width="40%">Name</th>
                                <th class="text-nowrap" width="5%">status</th>
                                <th class="text-nowrap" width="20%">created At</th>
                                <th class="text-nowrap" width="5%">Edit</th>
                                <th class="text-nowrap" width="5%">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse ($pages as $page)
                                <tr class="odd gradeX">
                                    <td width="1%" class="fw-bold text-dark">{{ $page->id }}</td>
                                    <td>{{ $page->name }}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input id="toggleStatusCheckbox{{ $page->id }}"
                                                class="form-check-input toggle-status-checkbox {{ $page->status ? '1' : '0' }}"
                                                type="checkbox" {{ $page->status ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td>{{ $page->created_at->format('Y-m-d') }}</td>
                                    <td nowrap="">
                                        <a href="{{route('page.edit' , $page->id)}}" class="btn btn-sm btn-primary"> <i class="fa-regular fa-pen-to-square"></i> Edit</a>
                                    </td>
                                    <td nowrap="">
                                        <form id="deleteForm{{$page->id}}" action="{{ route('page.destroy', $page->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a class="btn delete-btn btn-danger" data-id="{{$page->id}}"><i class="fa-solid fa-trash-can"></i> Delete</a>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <p>No Pages Found </p>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- ./table -->

                   <!-- pagination -->
                   {{-- <div class="d-md-flex align-items-center">
                    <div class="me-md-auto text-md-left text-center mb-2 mb-md-0">
                        Showing {{ $pages->firstItem() }} to {{ $pages->lastItem() }} of {{ $pages->total() }} entries
                    </div>
                    <ul class="pagination mb-0 justify-content-center">
                        {{ $pages->links('pagination::bootstrap-4') }}
                    </ul>
                   </div> --}}
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
        function searchPagesName() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchForPage");
            filter = input.value.toUpperCase();
            table = document.getElementById("pagesTableList");
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
                    url: '{{ route('page.toggle-status') }}',
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
