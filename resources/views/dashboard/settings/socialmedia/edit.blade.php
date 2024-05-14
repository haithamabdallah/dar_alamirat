@extends('dashboard.layouts.app')

@section('customcss')

@endsection

@section('content')

    <!-- BEGIN #content -->
    <div id="content" class="app-content">

        <!-- BEGIN breadcrumb -->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('settings.index') }}">Settings</a></li>
            <li class="breadcrumb-item"><a href="{{ route('socialMedia.index') }}">Social Media</a></li>
            <li class="breadcrumb-item active">Edit Social Media</li>
        </ol>
        <!-- END breadcrumb -->

        <!-- BEGIN page-header -->
        <h1 class="page-header">Edit Social Media</h1>
        <!-- END page-header -->

        <!-- BEGIN row -->
        <div class="row mb-3">

            <!-- BEGIN col-6 -->
            <div class="col-xl-6">

                <!-- BEGIN panel -->
                <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                    <!-- BEGIN panel-heading -->
                    <div class="panel-heading">
                        <h4 class="panel-title">Edit Social Media</h4>
                        <div class="panel-heading-btn">
                            <a href="{{ route('socialMedia.index') }}" class="btn btn-xs btn-icon btn-default"><i class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>
                    <!-- END panel-heading -->

                    <!-- BEGIN panel-body -->
                    <div class="panel-body">
                        <form action="{{ route('socialMedia.update', $socialMediaPlatform->id) }}" method="POST" id="socialMedia">
                            @csrf
                            @method('PUT')
                            <div class="row mb-15px">
                                <div class="col-md-6">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter name" value="{{ old('name', $socialMediaPlatform->name) }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="icon">Icon:</label>
                                    <select class="form-select @error('icon') is-invalid @enderror" id="icon" name="icon">
                                        <option value="fa-brands fa-facebook-f" {{ old('icon', $socialMediaPlatform->icon) == 'fa-brands fa-facebook-f' ? 'selected' : '' }}>Facebook</option>
                                        <option value="fab fa-twitter" {{ old('icon', $socialMediaPlatform->icon) == 'fab fa-twitter' ? 'selected' : '' }}>Twitter</option>
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
                                    <input type="url" class="form-control @error('value') is-invalid @enderror" id="value" name="value" placeholder="Enter URL" value="{{ old('value', $socialMediaPlatform->value) }}">
                                    @error('value')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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

@endsection
