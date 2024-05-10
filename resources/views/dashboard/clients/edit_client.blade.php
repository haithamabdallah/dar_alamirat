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
            <li class="breadcrumb-item active">Edit Client</li>
        </ol>
        <!-- END breadcrumb -->

        <!-- BEGIN page-header -->
        <h1 class="page-header">Edit Client</h1>
        <!-- END page-header -->

        <form method="POST" action="{{ route('client.update', $client->id) }}">
            @csrf
            @method('PUT')

            <!-- BEGIN row -->
            <div class="row mb-3">
                <!-- BEGIN col-6 -->
                <div class="col-xl-6">

                    <!-- BEGIN panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <!-- BEGIN panel-heading -->
                        <div class="panel-heading">
                            <h4 class="panel-title">Edit Client in English</h4>
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                        <!-- END panel-heading -->

                        <div class="panel-body">

                            <div class="row mb-15px">
                                <label for="first_name" class="form-label col-form-label col-md-3">{{ __('First Name') }}</label>
                                <div class="col-sm-9">
                                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $client->first_name }}" required autofocus>
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
                                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $client->last_name }}" required>
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
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $client->email }}" required>
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
                                    <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ $client->phone_number }}" required>
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
                                    <input id="birthday" type="text" class="form-control @error('birthday') is-invalid @enderror" name="birthday" pattern="\d{4}-\d{2}-\d{2}" placeholder="YYYY-MM-DD" value="{{ $client->birthday }}" required>
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
                                        <input class="form-check-input" type="radio" name="gender" id="male" value="male" {{ $client->gender === 'male' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="male">{{ __('Male') }}</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="female" value="female" {{ $client->gender === 'female' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="female">{{ __('Female') }}</label>
                                    </div>
                                    @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
{{--
                            <div class="row mb-15px">
                                <label for="password" class="form-label col-form-label col-md-3">{{ __('Password') }}</label>
                                <div class="col-sm-9">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
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
                                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>
 --}}
                            <!-- Add other form fields as needed -->

                            <div class="row mb-15px">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary d-block w-100"><i class="fa-regular fa-floppy-disk"></i> {{ __('Update') }}</button>
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
        $("#datepicker-autoClose").datepicker({
            todayHighlight: true,
            autoclose: true
        });
    </script>
@endsection
