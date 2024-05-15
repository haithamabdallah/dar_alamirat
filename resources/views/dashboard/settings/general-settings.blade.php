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
            <li class="breadcrumb-item active">Base Settings</li>
        </ol>
        <!-- END breadcrumb -->

        <!-- BEGIN page-header -->
        <h1 class="page-header">Base Settings</h1>
        <!-- END page-header -->

        <!-- row -->
        <div class="row">

            <!-- BEGIN col-3 -->
            <div class="col-xl-3 col-md-6">
                <!-- BEGIN widget-card -->
                <a href="{{ route('site-info.index') }}" class="widget-card rounded mb-20px" data-id="widget">
                    <div class="widget-card-cover rounded"></div>
                    <div class="widget-card-content">
                        <h5 class="fs-12px text-black text-opacity-75" data-id="widget-elm"
                            data-light-class="fs-12px text-black text-opacity-75"
                            data-dark-class="fs-12px text-white text-opacity-75"><b>Edit Store Info</b></h5>
                        <h4 class="mb-10px text-success"><b>Website Info</b></h4>
                        <i class="fa-solid fa-shop fa-5x text-success text-opacity-50"></i>
                    </div>
                    <div class="widget-card-content bottom">
                        <b class="text-black text-opacity-75" data-id="widget-elm"
                           data-light-class="fs-12px text-black text-opacity-75"
                           data-dark-class="fs-12px text-white text-opacity-75">Logo, favicon, Name, Addresses</b>
                    </div>
                </a>
                <!-- END widget-card -->
            </div>
            <!-- END col-3 -->

            <!-- BEGIN col-3 -->
            <div class="col-xl-3 col-md-6">
                <!-- BEGIN widget-card -->
                <a href="{{ route('announcement.index') }}" class="widget-card rounded mb-20px" data-id="widget">
                    <div class="widget-card-cover rounded"></div>
                    <div class="widget-card-content">
                        <h5 class="fs-12px text-black text-opacity-75" data-id="widget-elm"
                            data-light-class="fs-12px text-black text-opacity-75"
                            data-dark-class="fs-12px text-white text-opacity-75"><b>Edit Announcements Options</b></h5>
                        <h4 class="mb-10px text-success"><b>Announcements Options</b></h4>
                        <i class="fa-solid fa-list-ul fa-5x text-success text-opacity-50"></i>
                    </div>
                    <div class="widget-card-content bottom">
                        <b class="text-black text-opacity-75" data-id="widget-elm"
                           data-light-class="fs-12px text-black text-opacity-75"
                           data-dark-class="fs-12px text-white text-opacity-75">Control your Notes</b>
                    </div>
                </a>

                <!-- END widget-card -->
            </div>
            <!-- END col-3 -->

            <!-- BEGIN col-3 -->
            <div class="col-xl-3 col-md-6">
                <!-- BEGIN widget-card -->
                <a href="{{ route('maintenance.index') }}" class="widget-card rounded mb-20px" data-id="widget">
                    <div class="widget-card-cover rounded"></div>
                    <div class="widget-card-content">
                        <h5 class="fs-12px text-black text-opacity-75" data-id="widget-elm"
                            data-light-class="fs-12px text-black text-opacity-75"
                            data-dark-class="fs-12px text-white text-opacity-75"><b>Active Maintenance Mode</b></h5>
                        <h4 class="mb-10px text-success"><b>Maintenance Mode</b></h4>
                        <i class="fa-solid fa-truck fa-5x text-success text-opacity-50"></i>
                    </div>
                    <div class="widget-card-content bottom">
                        <b class="text-black text-opacity-75" data-id="widget-elm"
                           data-light-class="fs-12px text-black text-opacity-75"
                           data-dark-class="fs-12px text-white text-opacity-75">Activate Maintenance Mode</b>
                    </div>
                </a>
                <!-- END widget-card -->
            </div>
            <!-- END col-3 -->

            <!-- BEGIN col-3 -->
            <div class="col-xl-3 col-md-6">
                <!-- BEGIN widget-card -->
                <a href="{{ route('socialMedia.index') }}" class="widget-card rounded mb-20px" data-id="widget">
                    <div class="widget-card-cover rounded"></div>
                    <div class="widget-card-content">
                        <h5 class="fs-12px text-black text-opacity-75" data-id="widget-elm"
                            data-light-class="fs-12px text-black text-opacity-75"
                            data-dark-class="fs-12px text-white text-opacity-75"><b>Social Media info</b></h5>
                        <h4 class="mb-10px text-success"><b>Social Media</b></h4>
                        <i class="fa-solid fa-wallet fa-5x text-success text-opacity-50"></i>
                    </div>
                    <div class="widget-card-content bottom">
                        <b class="text-black text-opacity-75" data-id="widget-elm"
                           data-light-class="fs-12px text-black text-opacity-75"
                           data-dark-class="fs-12px text-white text-opacity-75">Add, Edit, Social Media Links</b>
                    </div>
                </a>
                <!-- END widget-card -->
            </div>
            <!-- END col-3 -->

        </div>
        <!-- END row -->

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
