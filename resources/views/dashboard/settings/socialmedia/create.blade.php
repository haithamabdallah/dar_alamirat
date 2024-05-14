@extends('dashboard.layouts.app')

@section('customcss')

@endsection

@section('content')

    <!-- BEGIN #content -->
    <div id="content" class="app-content">

        <!-- BEGIN breadcrumb -->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">Settings</a></li>
            <li class="breadcrumb-item active">Social Medias</li>
        </ol>
        <!-- END breadcrumb -->

        <!-- BEGIN page-header -->
        <h1 class="page-header">Social Media</h1>
        <!-- END page-header -->

        <!-- BEGIN row -->
        <div class="row mb-3">

            <!-- BEGIN col-6 -->
            <div class="col-xl-6">

                    <!-- BEGIN panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <!-- BEGIN panel-heading -->
                        <div class="panel-heading">
                            <h4 class="panel-title">Social Media</h4>
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
                            {{-- <form action="" id="socialMedia">
                                @csrf
                            <div class="row mb-15px">
                                <div class="input-group input-group-lg mb-10px">
                                    <div class="input-group-text"><i class="fa-brands fa-facebook-f"></i></div>
                                    <input type="text" class="form-control" placeholder="facebook">
                                </div>
                            </div>

                            <div class="row mb-15px">
                                <div class="input-group input-group-lg mb-10px">
                                    <div class="input-group-text"><span class="fab fa-twitter"></span></div>
                                    <input type="text" class="form-control" placeholder="facebook">
                                </div>
                            </div>

                            <div class="row mb-15px">
                                <div class="input-group input-group-lg mb-10px">
                                    <div class="input-group-text"><i class="fa-brands fa-instagram"></i></div>
                                    <input type="text" class="form-control" placeholder="facebook">
                                </div>
                            </div>

                            <div class="row mb-15px">
                                <div class="input-group input-group-lg mb-10px">
                                    <div class="input-group-text"><i class="fa-brands fa-youtube"></i></div>
                                    <input type="text" class="form-control" placeholder="facebook">
                                </div>
                            </div>

                            <div class="row mb-15px">
                                <div class="input-group input-group-lg mb-10px">
                                    <div class="input-group-text"><i class="fa-brands fa-whatsapp"></i></div>
                                    <input type="text" class="form-control" placeholder="facebook">
                                </div>
                            </div>

                            <div class="row mb-15px">
                                <div class="input-group input-group-lg mb-10px">
                                    <div class="input-group-text"><i class="fa-brands fa-tiktok"></i></div>
                                    <input type="text" class="form-control" placeholder="facebook">
                                </div>
                            </div>

                            <div class="row mb-15px">
                                <div class="input-group input-group-lg mb-10px">
                                    <div class="input-group-text"><i class="fa-brands fa-snapchat"></i></div>
                                    <input type="text" class="form-control" placeholder="facebook">
                                </div>
                            </div>

                            <div class="row mb-15px">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary d-block w-100"><i class="fa-regular fa-floppy-disk"></i> Save</button>
                                </div>
                            </div>
                        </form> --}}
                        <form action="{{ route('socialMedia.store') }}" method="POST" id="socialMedia">
                            @csrf
                            <div class="row mb-15px">
                                <div class="col-md-6">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter name">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="icon">Icon:</label>
                                    <select class="form-select @error('icon') is-invalid @enderror" id="icon" name="icon">
                                        <option value="fa-brands fa-facebook-f">Facebook</option>
                                        <option value="fab fa-twitter">Twitter</option>
                                        <!-- Add more options for other icons -->
                                    </select>
                                    @error('icon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-15px">
                                <div class="col-md-12">
                                    <label for="value">URL:</label>
                                    <input type="url" class="form-control @error('value') is-invalid @enderror" id="value" name="value" placeholder="Enter URL">
                                    @error('value')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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

@endsection
