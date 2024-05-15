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
            <li class="breadcrumb-item active">Announcements</li>
        </ol>
        <!-- END breadcrumb -->

        <!-- BEGIN page-header -->
        <h1 class="page-header">Edit Announcement</h1>
        <!-- END page-header -->

        <!-- BEGIN row -->
        <div class="row mb-3">

            <!-- BEGIN col-6 -->
            <div class="col-xl-6">

                    <!-- BEGIN panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <!-- BEGIN panel-heading -->
                        <div class="panel-heading">
                            <h4 class="panel-title">Announcement Details</h4>
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
                            <form action="{{ route('announcement.update', $announcement->id) }}" id="announcements" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row mb-15px">
                                    <label class="form-label col-form-label col-md-10">
                                        <span>Announcement Mode</span>
                                        <h6>After activating announcements mode, Note banner will appear on top of the website for any announcement.</h6>
                                    </label>
                                </div>

                                <div class="row mb-15px">
                                    <label class="form-label col-form-label col-md-3">Announcement Message</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" rows="3" name="announcement_message" placeholder="Our dear customers, we are sorry and we will be back ASAP">{{ $announcement->announcement_message }}</textarea>
                                    </div>
                                </div>

                                <div class="row mb-15px">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary d-block w-100"><i class="fa-regular fa-floppy-disk"></i> Update</button>
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
