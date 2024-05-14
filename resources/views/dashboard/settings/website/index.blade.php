@extends('dashboard.layouts.app')

@section('content')

    <!-- BEGIN #content -->
    <div id="content" class="app-content">

        <!-- BEGIN breadcrumb -->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">Settings</a></li>
            <li class="breadcrumb-item active">Website Info</li>
        </ol>
        <!-- END breadcrumb -->

        <!-- BEGIN page-header -->
        <h1 class="page-header">Website Info</h1>
        <!-- END page-header -->


        <!-- BEGIN row -->
        <div class="row mb-3">

            <!-- BEGIN col-6 -->
            <div class="col-xl-6">
                <!-- BEGIN panel -->
                <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                    <!-- BEGIN panel-heading -->
                    <div class="panel-heading">
                        <h4 class="panel-title">Website Info</h4>
                    </div>
                    <!-- END panel-heading -->

                    <!-- BEGIN panel-body -->
                    <div class="panel-body">
                        <div class="row mb-15px">
                            <label class="form-label col-form-label col-md-3">Website Logo</label>
                            <div class="col-sm-9">
                                <img src="{{ asset($website->logo) }}" alt="Website Logo" width="100">
                            </div>
                        </div>

                        <div class="row mb-15px">
                            <label class="form-label col-form-label col-md-3">Website Name</label>
                            <div class="col-sm-9">
                                <p>{{ $website->name }}</p>
                            </div>
                        </div>

                        <div class="row mb-15px">
                            <label class="form-label col-form-label col-md-3">Website Description</label>
                            <div class="col-sm-9">
                                <p>{{ $website->description }}</p>
                            </div>
                        </div>

                        <div class="row mb-15px">
                            <label class="form-label col-form-label col-md-3">Website Address</label>
                            <div class="col-sm-9">
                                <p>{{ $website->address }}</p>
                            </div>
                        </div>

                        <div class="row mb-15px">
                            <label class="form-label col-form-label col-md-3">Website Icon</label>
                            <div class="col-sm-9">
                                <img src="{{ asset($website->icon) }}" alt="Website Icon" width="100">
                            </div>
                        </div>
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
