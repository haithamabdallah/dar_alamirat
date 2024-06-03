@extends('dashboard.layouts.app')

@section('customcss')
    <link href="{{ asset('admin-panel/assets/plugins/dropzone/dist/min/dropzone.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin-panel/assets/plugins/switchery/dist/switchery.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('theme1-assets/css/intlTelInput.min.css') }}">

    <style>
        .iti {
            width: 100%;
        }
    </style>
@endsection

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
                            <form action="{{ route('site') }}" id="siteInfo" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-15px">
                                    <label class="form-label col-form-label col-md-3">Website Logo</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="website_logo" class="form-control @error('website_logo') is-invalid @enderror">
                                        @error('website_logo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-15px">
                                    <label class="form-label col-form-label col-md-3">Website Icon</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="website_icon" class="form-control @error('website_icon') is-invalid @enderror">
                                        @error('website_icon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-15px">
                                    <label class="form-label col-form-label col-md-3">Website Name</label>
                                    <div class="col-sm-9">
                                        <input class="form-control @error('website_name') is-invalid @enderror" name="website_name" type="text" placeholder="Website Name"  />
                                        @error('website_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-15px">
                                    <label class="form-label col-form-label col-md-3">Website Description</label>
                                    <div class="col-sm-9">
                                        <input class="form-control @error('website_description') is-invalid @enderror" name="website_description" type="text" placeholder="Website Description"  />
                                        @error('website_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-15px">
                                    <label class="form-label col-form-label col-md-3">Website Address</label>
                                    <div class="col-sm-9">
                                        <input class="form-control @error('website_address') is-invalid @enderror" name="website_address" type="text" placeholder="Website Address"  />
                                        @error('website_address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-15px">
                                    <label class="form-label col-form-label col-md-3">Phone Number</label>
                                    <div class="col-sm-9">
                                        <input class="form-control @error('tel') is-invalid @enderror" name="tel" type="tel" placeholder="Phone Number"  />
                                        @error('tel')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-15px">
                                    <label class="form-label col-form-label col-md-3">WhatsApp</label>
                                    <div class="col-sm-9">
                                        <input class="form-control @error('whats_app') is-invalid @enderror" name="whats_app" type="tel" placeholder="WhatsApp"  />
                                        @error('whats_app')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- NEW CODE HERE -->
                                {{--<div class="row mb-15px">
                                    <label class="form-label col-form-label col-md-3">Phone Number</label>
                                    <div class="col-sm-9">
                                        <input id="phone" type="tel" name="tel" class="form-control @error('tel') is-invalid @enderror"  style="width: 100%;">
                                        @error('tel')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-15px">
                                    <label class="form-label col-form-label col-md-3">WhatsApp</label>
                                    <div class="col-sm-9">
                                        <input id="whatsapp" type="tel" name="whats_app" class="form-control @error('whats_app') is-invalid @enderror"  style="width: 100%;">
                                        @error('whats_app')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>--}}
                                <!-- NEW CODE HERE -->


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
    {{--<script src="{{ asset('theme1-assets/js/intlTelInput.min.js') }}"></script>
    <script>
        const phone = document.querySelector("#phone");
        window.intlTelInput(phone, {
            showSelectedDialCode: true,
            initialCountry: "auto",
            geoIpLookup: function(callback) {
                fetch("https://ipapi.co/json")
                    .then(function(res) { return res.json(); })
                    .then(function(data) { callback(data.country_code); })
                    .catch(function() { callback(); });
            },
            utilsScript: "{{ asset('theme1-assets/js/utils.js') }}",
        });
    </script>

    <script>
        const whatsapp = document.querySelector("#whatsapp");
        window.intlTelInput(whatsapp, {
            showSelectedDialCode: true,
            initialCountry: "auto",
            geoIpLookup: function(callback) {
                fetch("https://ipapi.co/json")
                    .then(function(res) { return res.json(); })
                    .then(function(data) { callback(data.country_code); })
                    .catch(function() { callback(); });
            },
            utilsScript: "{{ asset('theme1-assets/js/utils.js') }}",
        });
    </script>--}}

@endsection
