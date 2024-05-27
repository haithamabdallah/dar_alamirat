@extends('dashboard.layouts.app')


@section('customcss')
    <link href="{{ asset('admin-panel/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
@endsection


@section('content')

    <!-- BEGIN #content -->
    <div id="content" class="app-content">

        <!-- BEGIN breadcrumb -->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">Clients</a></li>
            <li class="breadcrumb-item active">add client</li>
        </ol>
        <!-- END breadcrumb -->

        <!-- BEGIN page-header -->
        <h1 class="page-header">Add Clients</h1>
        <!-- END page-header -->

        <form method="POST" action="{{ route('client.store') }}">
            <!-- BEGIN row -->
            <div class="row mb-3">
                <!-- BEGIN col-6 -->
                <div class="col-xl-6">

                    <!-- BEGIN panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <!-- BEGIN panel-heading -->
                        <div class="panel-heading">
                            <h4 class="panel-title">Add Client in English</h4>
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                        <!-- END panel-heading -->

                        <div class="panel-body">

                                @csrf

                            <div class="row mb-15px">
                                    <label for="first_name" class="form-label col-form-label col-md-3">{{ __('First Name') }}</label>

                                    <div class="col-sm-9">
                                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            <div class="row mb-15px">
                                    <label for="last_name" class="form-label col-form-label col-md-3">{{ __('Last Name') }}</label>

                                    <div class="col-sm-9">
                                        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required>

                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            <div class="row mb-15px">
                                    <label for="email" class="form-label col-form-label col-md-3">{{ __('Email') }}</label>

                                    <div class="col-sm-9">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            <div class="row mb-15px">
                                    <label for="phone_number" class="form-label col-form-label col-md-3">{{ __('Phone Number') }}</label>

                                    <div class="col-sm-9">
                                        <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required>

                                        @error('phone_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-15px">
                                    <label for="birthday" class="form-label col-form-label col-md-3">{{ __('Birthday') }}</label>
                                    <div class="col-sm-9">
                                        <input  type="text" class="form-control @error('birthday') is-invalid @enderror" name="birthday"  placeholder="YYYY-MM-DD" value="{{ old('birthday') }}" required>
                                        @error('birthday')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                            <div class="row mb-15px">
                                    <label class="form-label col-form-label col-md-3">{{ __('Gender') }}</label>

                                    <div class="col-md-9 pt-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="male" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="male">
                                                {{ __('Male') }}
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="female" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="female">
                                                {{ __('Female') }}
                                            </label>
                                        </div>
                                        @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-15px">
                                    <label for="password" class="form-label col-form-label col-md-3">{{ __('Password') }}</label>
                                    <div class="col-sm-9">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-15px">
                                    <label for="password_confirmation" class="form-label col-form-label col-md-3">{{ __('Confirm Password') }}</label>
                                    <div class="col-sm-9">
                                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>


                                <!-- Add other form fields as needed -->

                            <div class="row mb-15px">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary d-block w-100"><i class="fa-regular fa-floppy-disk"></i> {{ __('Submit') }}</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
    <!-- END #content -->

@endsection

@section('scripts')
    <script src="{{ asset('admin-panel/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js') }}"></script>
    <script>
        $("#birthday").datepicker({
            todayHighlight: true,
            autoclose: true,
            format: 'dd, MM, yyyy',
        });
    </script>
@endsection
