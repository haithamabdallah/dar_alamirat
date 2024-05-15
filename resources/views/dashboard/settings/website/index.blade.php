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
        @if ($siteInfo->count() == 0)
        <div class="ms-auto">
            <a href="{{ route('site-info.create') }}" class="btn btn-success btn-rounded px-4 rounded-pill"><i class="fa fa-plus fa-lg me-2 ms-n2 text-success-900"></i> {{ __('dashboard.page.add') }}</a>
        </div>
       @endif

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
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand">
                                <i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload">
                                <i class="fa fa-redo"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse">
                                <i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove">
                                <i class="fa fa-times"></i></a>
                        </div>
                    </div>
                    <!-- END panel-heading -->

                    <!-- BEGIN panel-body -->
                    <div class="panel-body">
                        @if ($siteInfo)
                            <div class="row mb-15px">
                                <label class="form-label col-form-label col-md-3">Website Logo</label>
                                <div class="col-sm-9">
                                    @if($siteInfo->website_logo)
                                        <img src="{{ $siteInfo->website_logo }}" alt="Website Logo" class="img-fluid mb-3">
                                    @else
                                        <p>No logo uploaded</p>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-15px">
                                <label class="form-label col-form-label col-md-3">Website Name</label>
                                <div class="col-sm-9">
                                    <p>{{ $siteInfo->website_name }}</p>
                                </div>
                            </div>
                            <div class="row mb-15px">
                                <label class="form-label col-form-label col-md-3">Website Description</label>
                                <div class="col-sm-9">
                                    <p>{{ $siteInfo->website_description }}</p>
                                </div>
                            </div>
                            <div class="row mb-15px">
                                <label class="form-label col-form-label col-md-3">Website Address</label>
                                <div class="col-sm-9">
                                    <p>{{ $siteInfo->website_address }}</p>
                                </div>
                            </div>
                            <div class="row mb-15px">
                                <label class="form-label col-form-label col-md-3">Website Icon</label>
                                <div class="col-sm-9">
                                    @if($siteInfo->website_icon)
                                        <img src="{{ $siteInfo->website_icon }}" alt="Website Icon" class="img-fluid mb-3">
                                    @else
                                        <p>No icon uploaded</p>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-15px">
                                <label class="form-label col-form-label col-md-3">Edit Website</label>
                                <div class="col-sm-9">
                                    <a href="{{route('site-info.edit' , $siteInfo->id)}}" class="btn btn-sm btn-primary"> <i class="fa-regular fa-pen-to-square"></i> Edit</a>

                                </div>
                            </div>
                        @else
                            <p>No website info available</p>
                        @endif
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
@endsection
