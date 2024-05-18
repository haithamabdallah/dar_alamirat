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
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('settings.index') }}">Settings</a></li>
            <li class="breadcrumb-item active">Maintenance</li>
        </ol>
        <!-- END breadcrumb -->

        <!-- BEGIN page-header -->
        <h1 class="page-header">Edit Maintenance Settings</h1>
        <!-- END page-header -->

        <!-- BEGIN row -->
        <div class="row mb-3">
            <!-- BEGIN col-12 -->
            <div class="col-xl-12">
                <!-- BEGIN panel -->
                <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                    <!-- BEGIN panel-heading -->
                    <div class="panel-heading">
                        <h4 class="panel-title">Maintenance Settings</h4>
                    </div>
                    <!-- END panel-heading -->

                    <!-- BEGIN panel-body -->
                    <div class="panel-body">
                        <form method="POST" action="{{ route('maintenance.update', $maintenance->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="maintenance_title" class="form-label">Maintenance Title</label>
                                <input type="text" class="form-control" id="maintenance_title" name="maintenance_title" value="{{ $maintenance->maintenance_title }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="maintenance_message" class="form-label">Maintenance Message</label>
                                <textarea class="form-control" id="maintenance_message" name="maintenance_message" rows="5" required>{{ $maintenance->maintenance_message }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                    <!-- END panel-body -->
                </div>
                <!-- END panel -->
            </div>
            <!-- END col-12 -->
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
