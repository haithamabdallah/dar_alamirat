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
            <li class="breadcrumb-item active">Maintenance Mode</li>
        </ol>
        <!-- END breadcrumb -->

        <!-- BEGIN page-header -->
        <h1 class="page-header">Maintenance Mode</h1>
        <!-- END page-header -->


        <!-- BEGIN row -->
        <div class="row mb-3">

            <!-- BEGIN col-6 -->
            <div class="col-xl-6">


                    <!-- BEGIN panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <!-- BEGIN panel-heading -->
                        <div class="panel-heading">
                            <h4 class="panel-title">Maintenance Mode</h4>
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
                            <form action="{{ route('maintenance') }}" id="maintenanceMode" method="POST">
                                @csrf
                            <div class="row mb-15px">
                                <label class="form-label col-form-label col-md-10">
                                    <span>Maintenance Mode</span>
                                    <h6>After activating operation mode, you will log in to the demo store on the device, while customers appear on the maintenance page.</h6>
                                </label>

                            </div>
                            <div class="col-sm-2">
                                <input type="radio" class="" name="maintenance_mode" value="enabled" >
                                <label for="maintenance_mode">Enabled</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="radio" class="" name="maintenance_mode" value="disabled" >
                                <label for="maintenance_mode">Disabled</label>
                            </div>

                            <div class="row mb-15px">
                                <label class="form-label col-form-label col-md-3">Maintenance Title</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="maintenance_title" rows="3" placeholder="we back soon"></textarea>
                                </div>
                            </div>

                            <div class="row mb-15px">
                                <label class="form-label col-form-label col-md-3">Maintenance Message</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="maintenance_message" rows="3" placeholder="Our dear customers, we are sorry and we will back ASAP"></textarea>
                                </div>
                            </div>

                            <div class="row mb-15px">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary d-block w-100"><i class="fa-regular fa-floppy-disk"></i> Save</button>
                                </div>
                            </div>
                        </form>
                        </div>
                        <!-- END panel-body -->

                    </div>
                    <!-- END panel -->


            </div>
            <!-- END col-6 -->

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
@endsection
