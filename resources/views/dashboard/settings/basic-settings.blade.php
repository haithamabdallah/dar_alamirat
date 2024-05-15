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
                            {{-- <form action="" id="siteInfo">
                            <div class="row mb-15px">
                                <label class="form-label col-form-label col-md-3">Website Logo</label>
                                <div class="col-sm-9">
                                    <div id="dropzone">
                                        <div action="/upload" class="dropzone needsclick" id="demo-upload">
                                            <div class="dz-message needsclick">
                                                Drop files <b>here</b> or <b>click</b> to upload.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-15px">
                                <label class="form-label col-form-label col-md-3">Website Name</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" placeholder="Website Name"  />
                                </div>
                            </div>

                            <div class="row mb-15px">
                                <label class="form-label col-form-label col-md-3">Website Description</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" placeholder="Website Description"  />
                                </div>
                            </div>

                            <div class="row mb-15px">
                                <label class="form-label col-form-label col-md-3">Website Address</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" placeholder="Website Address"  />
                                </div>
                            </div>

                            <div class="row mb-15px">
                                <label class="form-label col-form-label col-md-3">Website Icon</label>
                                <div class="col-sm-9">
                                    <div id="dropzone">
                                        <div action="/upload" class="dropzone needsclick" id="demo-upload2">
                                            <div class="dz-message needsclick">
                                                Drop files <b>here</b> or <b>click</b> to upload.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-15px">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary d-block w-100"><i class="fa-regular fa-floppy-disk"></i> Save</button>
                                </div>
                            </div>
                            </form> --}}
                            <form action="{{ route('site-info.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-15px">
                                    <label class="form-label col-form-label col-md-3">Website Logo</label>
                                    <div class="col-sm-9">
                                        <div id="dropzone-logo" class="dropzone"></div>
                                        <input type="hidden" name="website_logo" id="website_logo">
                                    </div>
                                </div>
                                <div class="row mb-15px">
                                    <label class="form-label col-form-label col-md-3">Website Name</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="website_name" placeholder="Website Name" required />
                                    </div>
                                </div>
                                <div class="row mb-15px">
                                    <label class="form-label col-form-label col-md-3">Website Description</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="website_description" placeholder="Website Description" required />
                                    </div>
                                </div>
                                <div class="row mb-15px">
                                    <label class="form-label col-form-label col-md-3">Website Address</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="website_address" placeholder="Website Address" required />
                                    </div>
                                </div>
                                <div class="row mb-15px">
                                    <label class="form-label col-form-label col-md-3">Website Icon</label>
                                    <div class="col-sm-9">
                                        <div id="dropzone-icon" class="dropzone"></div>
                                        <input type="hidden" name="website_icon" id="website_icon">
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
   <!-- Include Dropzone.js -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

<script>
    Dropzone.options.dropzoneLogo = {
        url: '{{ route('site-info.upload') }}',
        maxFiles: 1,
        acceptedFiles: 'image/*',
        success: function(file, response) {
            document.getElementById('website_logo').value = response.path;
        }
    };

    Dropzone.options.dropzoneIcon = {
        url: '{{ route('site-info.upload') }}',
        maxFiles: 1,
        acceptedFiles: 'image/*',
        success: function(file, response) {
            document.getElementById('website_icon').value = response.path;
        }
    };
</script>
@endsection
