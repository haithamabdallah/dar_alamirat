@extends('dashboard.layouts.app')

@section('customcss')
    <link href="{{ asset('admin-panel/assets/plugins/dropzone/dist/min/dropzone.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin-panel/assets/plugins/switchery/dist/switchery.min.css') }}" rel="stylesheet" />
@endsection

@section('content')

    <!-- BEGIN #content -->
    <div id="content" class="app-content">

        <!-- BEGIN breadcrumb -->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">Settings</a></li>
            <li class="breadcrumb-item active">Maintenance</li>
        </ol>
        <!-- END breadcrumb -->
        @if ($maintenances->isEmpty())
        <div class="ms-auto">
            <a href="{{ route('maintenance.create') }}" class="btn btn-success btn-rounded px-4 rounded-pill"><i class="fa fa-plus fa-lg me-2 ms-n2 text-success-900"></i> {{ __('dashboard.page.add') }}</a>
        </div>
    @endif
        <!-- BEGIN page-header -->
        <h1 class="page-header">Maintenance</h1>
        <!-- END page-header -->

        <!-- BEGIN row -->
        <div class="row mb-3">

            <!-- BEGIN col-12 -->
            <div class="col-xl-12">

                <!-- BEGIN panel -->
                <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                    <!-- BEGIN panel-heading -->
                    <div class="panel-heading">
                        <h4 class="panel-title">Maintenance</h4>
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                    </div>
                    <!-- END panel-heading -->

                   <!-- table -->
                   <div class="table-responsive mb-3">
                    <table id="pagesTableList" class="table table-hover table-panel text-nowrap align-middle mb-0">
                        <thead>
                        <tr>
                            <th width="1%"></th>
                            <th class="text-nowrap" width="40%">Message</th>
                            <th class="text-nowrap" width="5%">Maintenance Mode</th>
                            <th class="text-nowrap" width="20%">created At</th>
                            <th class="text-nowrap" width="5%">Edit</th>
                            {{-- <th class="text-nowrap" width="5%">Delete</th> --}}
                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($maintenances  as $page)
                            <tr class="odd gradeX">
                                <td width="1%" class="fw-bold text-dark">{{ $page->id }}</td>
                                <td>{{ $page->maintenance_message }}</td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input id="toggleStatusCheckbox{{ $page->id }}"
                                            class="form-check-input toggle-status-checkbox {{ $page->maintenance_mode ? '1' : '0' }}"
                                            type="checkbox" {{ $page->maintenance_mode ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td>{{ $page->created_at->format('Y-m-d') }}</td>
                                <td nowrap="">
                                    <a href="{{route('maintenance.edit' , $page->id)}}" class="btn btn-sm btn-primary"> <i class="fa-regular fa-pen-to-square"></i> Edit</a>
                                </td>
                                {{-- <td nowrap="">
                                    <form id="deleteForm{{$page->id}}" action="{{ route('announcement.destroy', $page->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a class="btn delete-btn btn-danger" data-id="{{$page->id}}"><i class="fa-solid fa-trash-can"></i> Delete</a>
                                    </form>
                                </td> --}}
                            </tr>
                            @empty
                            <p>No Pages Found </p>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- ./table -->

                </div>
                <!-- END panel -->

            </div>
            <!-- END col-12 -->

        </div>
        <!-- ./row -->

    </div>
    <!-- END #content -->

@endsection

@section('scripts')
    <script src="{{ asset('admin-panel/assets/plugins/dropzone/dist/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin-panel/assets/plugins/switchery/dist/switchery.min.js') }}"></script>
    <script>
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
                var isActive = $(this).is(':checked');
                var modelId = $(this).attr('id').replace('toggleStatusCheckbox', '');

                $.ajax({
                    url: '{{ route('maintenance.toggle-status') }}',
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
