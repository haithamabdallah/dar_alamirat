@extends('dashboard.layouts.app')

@section('meta')
    <meta charset="utf-8" />
    <title>{{ __('dashboard.admins') }}</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
@endsection

@section('content')
    <div class="app-sidebar-bg"></div>
    <div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a></div>
    <!-- END #sidebar -->

    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <!-- BEGIN breadcrumb -->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('dashboard.home') }}</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('admin.index') }}">{{ __('dashboard.admins') }}</a></li>
        </ol>
        <!-- END breadcrumb -->
        <!-- BEGIN page-header -->
        <h1 class="page-header">{{ __('dashboard.admins') }}</h1>
        <!-- END page-header -->
        @include('dashboard.layouts.alerts')
        <!-- BEGIN row -->
        <div class="row">
            <!-- BEGIN col-10 -->
            <div class="col-xl-12">
                <div class="panel panel-inverse">
                    <!-- BEGIN panel-heading -->
                    <div class="panel-heading">
                        <h4 class="panel-title">{{ __('dashboard.admins') . ' - '  . __('dashboard.table') }}</h4>
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                    </div>
                    <!-- END panel-heading -->
                    <!-- BEGIN panel-body -->
                    <div class="panel-body">
                        <a href="{{ route('admin.create') }}" class="btn btn-primary btn-lg m-2">{{ __('dashboard.admin.add') }}</a>
                        <table id="data-table-combine" class="table table-striped table-bordered align-middle">
                            <!-- Table header -->
                            <thead class="text-center">
                                <tr>
                                    <th width="1%">#</th>
                                    <th width="1%">{{ __('dashboard.admin.name') }}</th>
                                    <th width="1%">{{ __('dashboard.admin.email') }}</th>
                                    <th width="1%">{{ __('dashboard.admin.role') }}</th>
                                    <th width="1%">{{ __('dashboard.admin.image') }}</th>
                                    <th class="text-nowrap">{{ __('dashboard.created_at') }}</th>
                                    <th class="text-nowrap">{{ __('dashboard.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Table data -->
                                @foreach($admins as $admin)
                                    <tr class="odd gradeX">
                                        <td width="1%" class="fw-bold text-dark">{{ $loop->iteration }}</td>
                                        <td>{{ strtoupper($admin->name) }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>
                                            @foreach($admin->roles as $role)
                                                 {{ $role->name }}
                                            @endforeach
                                        </td>
                                        <td>
                                            <img src="{{ $admin->image }}" alt="" class="mw-100 w-70px rounded">
                                        </td>
                                        <td>{{ $admin->created_at->format('Y-m-d') }}</td>
                                        <td class="text-center">
                                            @if($admin->system == 0)
                                                <div class="btn-group me-1 mb-1">
                                                    <a href="javascript:;" class="btn btn-default">{{ __('dashboard.action') }}</a>
                                                    <a href="#" data-bs-toggle="dropdown" class="
                                                    btn btn-default dropdown-toggle"><i class="fa fa-caret-down"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        @adminCan('admins.edit')
                                                            <a href="{{ route('admin.edit', $admin->id) }}" class="dropdown-item">{{ __('dashboard.admin.edit') }}</a>
                                                        @endadminCan
                                                        @adminCan('admins.delete')
                                                            <div class="dropdown-divider"></div>
                                                            <form id="deleteForm{{ $admin->id }}" action="{{ route('admin.destroy', $admin->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="dropdown-item delete-btn" style="background-color: transparent; border: none;" data-id="{{ $admin->id }}">{{ __('dashboard.admin.delete') }}</button>
                                                            </form>
                                                        @endadminCan
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- pagination -->
                        <div class="d-md-flex align-items-center">
                            <div class="me-md-auto text-md-left text-center mb-2 mb-md-0">
                                Showing {{ $admins->firstItem() }} to {{ $admins->lastItem() }} of {{ $admins->total() }} entries
                            </div>
                            <ul class="pagination mb-0 justify-content-center">
                                @if ($admins->previousPageUrl())
                                    <li class="page-item"><a class="page-link" href="{{ $admins->previousPageUrl() }}">Previous</a></li>
                                @else
                                    <li class="page-item disabled"><span class="page-link">Previous</span></li>
                                @endif

                                @for ($i = 1; $i <= $admins->lastPage(); $i++)
                                    <li class="page-item {{ $admins->currentPage() == $i ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $admins->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                @if ($admins->nextPageUrl())
                                    <li class="page-item"><a class="page-link" href="{{ $admins->nextPageUrl() }}">Next</a></li>
                                @else
                                    <li class="page-item disabled"><span class="page-link">Next</span></li>
                                @endif
                            </ul>
                        </div>


                    </div>


                    <!-- END panel-body -->
                </div>
                <!-- END panel -->
            </div>
            <!-- END col-10 -->
        </div>
        <!-- END row -->
    </div>
    <!-- END #content -->
@endsection

@section('scripts')
    <!-- Include your scripts here -->
    {{-- <script>
        var options = {
            dom: '<"dataTables_wrapper dt-bootstrap"<"row"<"col-xl-7 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex me-0 me-md-3"l><"d-block d-lg-inline-flex"B>><"col-xl-5 d-flex d-xl-block justify-content-center"fr>>t<"row"<"col-md-5"i><"col-md-7"p>>>',
            buttons: [
                { extend: 'copy', className: 'btn-sm' },
                { extend: 'csv', className: 'btn-sm' },
                { extend: 'excel', className: 'btn-sm' },
                { extend: 'pdf', className: 'btn-sm' },
                { extend: 'print', className: 'btn-sm' }
            ],
            responsive: true,
            colReorder: true,
            keys: true,
            rowReorder: true,
            select: true
        };

        if ($(window).width() <= 767) {
            options.rowReorder = false;
            options.colReorder = false;
        }
        $('#data-table-combine').DataTable(options);
    </script> --}}

@endsection
