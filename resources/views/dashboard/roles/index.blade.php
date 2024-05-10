@extends('dashboard.layouts.app')

@section('meta')
    <meta charset="utf-8" />
    <title> {{__('dashboard.roles')}} </title>
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
            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">{{__('dashboard.home')}}</a></li>
            <li class="breadcrumb-item active"><a href="{{route('roles.index')}}">{{__('dashboard.roles')}}</a></li>
        </ol>
        <!-- END breadcrumb -->
        <!-- BEGIN page-header -->
        <h1 class="page-header"> {{__('dashboard.roles')}} </h1>
        <!-- END page-header -->
        @include('dashboard.layouts.alerts')
        <!-- BEGIN row -->
        <div class="row">
            <!-- BEGIN col-10 -->
            <div class="col-xl-12">
                <div class="panel panel-inverse">
                    <!-- BEGIN panel-heading -->
                    <div class="panel-heading">

                        <h4 class="panel-title">{{__('dashboard.roles') . ' - '  .__('dashboard.table')}}</h4>
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
                        <a href="{{route('roles.create')}}" class="btn btn-primary btn-lg m-2" > {{__('dashboard.role.add')}}</a>
                        <table id="data-table-combine" class="table table-striped table-bordered align-middle">
                            <thead class="text-center">
                                <tr>
                                    <th width="1%">#</th>
                                    <th width="1%">{{__('dashboard.role.name')}}</th>
                                    <th class="text-nowrap">{{__('dashboard.role.guard_name')}}</th>
                                    <th class="text-nowrap">{{__('dashboard.created_at')}}</th>
                                    <th class="text-nowrap">{{__('dashboard.action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                    <tr class="odd gradeX">
                                        <td width="1%" class="fw-bold text-dark">1</td>
                                        <td>{{strtoupper($role->name)}}</td>
                                        <td>{{$role->guard_name}}</td>
                                        <td>{{$role->created_at->format('Y-m-d')}}</td>
                                        <td class="text-center">

                                            <div class="btn-group me-1 mb-1">
                                                <a href="javascript:;" class="btn btn-default">{{__('dashboard.action')}}</a>
                                                <a href="#" data-bs-toggle="dropdown" class="btn btn-default dropdown-toggle"><i class="fa fa-caret-down"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="{{route('roles.edit' , $role->id)}}" class="dropdown-item">{{__('dashboard.role.edit')}}</a>
                                                    <div class="dropdown-divider"></div>
                                                    <form id="deleteForm{{$role->id}}" action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item delete-btn" style="background-color: transparent; border: none;" data-id="{{$role->id}}">{{__('dashboard.role.delete')}}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
    <!-- script -->
    <script>
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
    </script>
@endsection
