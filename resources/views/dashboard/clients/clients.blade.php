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
                    <li class="breadcrumb-item"><a href="{{route('brand.index')}}">{{__('dashboard.clients')}}</a></li>
                </ul>
                <h1 class="page-header mb-0">{{__('dashboard.clients')}}</h1>
            </div>
            <div class="ms-auto">
                <a href="{{route('client.create')}}" class="btn btn-success btn-rounded px-4 rounded-pill"><i class="fa fa-plus fa-lg me-2 ms-n2 text-success-900"></i> {{__('dashboard.client.add')}}</a>
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
                        <p class="btn btn-white dropdown-toggle"><span class="d-none d-md-inline">Filter By Client Name</span></p>
                        <div class="flex-fill position-relative">
                            <div class="input-group">
                                <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 start-0" style="z-index: 1;">
                                    <i class="fa fa-search opacity-5"></i>
                                </div>
                                <input type="text" id="searchForClient" onkeyup="searchClientName()" class="form-control px-35px bg-light" placeholder="Search For Page..." />
                            </div>
                        </div>
                    </div>
                    <!-- END input-group -->

                    <!-- table -->
                    <div class="table-responsive mb-3">
                        <table id="clientsTableList" class="table table-hover table-panel text-nowrap align-middle mb-0">
                            <thead>
                            <tr>
                                <th width="1%"></th>
                                <th width="5%">Name</th>
                                <th class="text-nowrap" width="40%">Email</th>
                                <th class="text-nowrap" width="40%">Phone</th>
                                <th class="text-nowrap" width="40%">Gender</th>
                                <th class="text-nowrap" width="40%">Age</th>
                                <th class="text-nowrap" width="5%">Edit</th>
                                <th class="text-nowrap" width="5%">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse ($clients as $client )


                            <tr class="odd gradeX">
                                <td width="1%" class="fw-bold text-dark">{{ $client->id }}</td>
                                <td>{{ $client->full_name }}</td>
                                <td>{{ $client->email }}</td>
                                <td>{{ $client->phone_number }}</td>
                                <td>{{ $client->gender }}</td>
                                <td>{{ $client->age }}</td>
                                <td nowrap="">
                                    <a href="{{route('client.edit' , $client->id)}}" class="btn btn-sm btn-primary"> <i class="fa-regular fa-pen-to-square"></i> Edit</a>
                                </td>
                                <td nowrap="">
                                    <form id="deleteForm{{$client->id}}" action="{{ route('client.destroy', $client->id) }}" method="POST">
                                        @csrf
                                            @method('DELETE')
                                        <a class="btn delete-btn btn-danger" data-id="{{$client->id}}"><i class="fa-solid fa-trash-can"></i> Delete</a>
                                    </form>
                                </td>
                            </tr>
                            @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- ./table -->

                    <!-- pagination -->
                    <div class="d-md-flex align-items-center">
                        <div class="me-md-auto text-md-left text-center mb-2 mb-md-0">
                            Showing {{ $clients->firstItem() }} to {{ $clients->lastItem() }} of {{ $clients->total() }} entries
                        </div>
                        <ul class="pagination mb-0 justify-content-center">
                            {{ $clients->links('pagination::bootstrap-4') }}
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
        function searchClientName() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchForClient");
            filter = input.value.toUpperCase();
            table = document.getElementById("clientsTableList");
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
