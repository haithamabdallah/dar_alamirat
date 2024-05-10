<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
@section('meta')
    <meta charset="utf-8" />
    <title> {{__('dashboard.login_page')}}</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
@endsection

@include('dashboard.layouts.head')
<body class='pace-top'>
<!-- BEGIN #loader -->
<div id="loader" class="app-loader">
    <span class="spinner"></span>
</div>
<!-- END #loader -->


<!-- BEGIN #app -->
<div id="app" class="app">
    <!-- BEGIN login -->
    <div class="login login-v2 fw-bold">
        <!-- BEGIN login-cover -->
        <div class="login-cover">
            <div class="login-cover-img" style="background-image: url(../assets/img/login-bg/login-bg-17.jpg)" data-id="login-cover-image"></div>
            <div class="login-cover-bg"></div>
        </div>
        <!-- END login-cover -->

        <!-- BEGIN login-container -->
        <div class="login-container">
            <!-- BEGIN login-header -->
            <div class="login-header">
                <div class="brand">
                    <div class="d-flex align-items-center">
                        <span class="logo"></span> <b>Color</b> Admin
                    </div>
                    <small>Bootstrap 5 Responsive Admin Template</small>
                </div>
                <div class="icon">
                    <i class="fa fa-lock"></i>
                </div>
            </div>
            <!-- END login-header -->

            <!-- BEGIN login-content -->
            <div class="login-content">
                @include('dashboard.layouts.alerts')
                <form action="{{route('dashboard.auth.postLogin')}}" method="POST">
                    @csrf
                    <div class="form-floating mb-20px">
                        <input type="text" class="form-control fs-13px h-45px border-0" name="userName" placeholder="{{__('dashboard.forms.user_name')}}" value="{{ old('userName') }}" id="userName" />
                        <label for="emailAddress" class="d-flex align-items-center text-gray-600 fs-13px">{{__('dashboard.forms.user_name')}}</label>
                    </div>
                    @error('userName')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <div class="form-floating mb-20px">
                        <input type="password" class="form-control fs-13px h-45px border-0" name="password" placeholder="{{__('dashboard.forms.password')}}" />
                        <label for="emailAddress" class="d-flex align-items-center text-gray-600 fs-13px">{{__('dashboard.forms.password')}}</label>
                    </div>
                    @error('password')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <div class="form-check mb-20px">
                        <input class="form-check-input border-0" type="checkbox" value="1" {{ old('remember') ? 'checked' : '' }} name="remember" id="rememberMe" />
                        <label class="form-check-label fs-13px text-gray-500" for="rememberMe">
                            {{__('dashboard.forms.remember_me')}}
                        </label>
                    </div>
                    <div class="mb-20px">
                        <button type="submit" class="btn btn-success d-block w-100 h-45px btn-lg">{{__('dashboard.forms.sign_in')}}</button>
                    </div>
{{--                    <div class="text-gray-500">--}}
{{--                        {{__('dashboard.forms.not_member_button')}} <a href="{{route('dashboard.auth.register')}}" class="text-white">{{__('dashboard.here')}}</a> {{__('dashboard.to')}} {{__('dashboard.register')}}--}}
{{--                    </div>--}}
                </form>
            </div>
            <!-- END login-content -->
        </div>
        <!-- END login-container -->
    </div>
    <!-- END login -->

    <!-- BEGIN login-bg -->
    <div class="login-bg-list clearfix">
        <div class="login-bg-list-item active"><a href="javascript:;" class="login-bg-list-link" data-toggle="login-change-bg" data-img="{{asset('admin-panel/assets/img/login-bg/login-bg-17.jpg')}}" style="background-image: url(../assets/img/login-bg/login-bg-17.jpg)"></a></div>
        <div class="login-bg-list-item"><a href="javascript:;" class="login-bg-list-link" data-toggle="login-change-bg" data-img="{{asset('admin-panel/assets/img/login-bg/login-bg-16.jpg')}}" style="background-image: url(../assets/img/login-bg/login-bg-16.jpg)"></a></div>
        <div class="login-bg-list-item"><a href="javascript:;" class="login-bg-list-link" data-toggle="login-change-bg" data-img="{{asset('admin-panel/assets/img/login-bg/login-bg-15.jpg')}}" style="background-image: url(../assets/img/login-bg/login-bg-15.jpg)"></a></div>
        <div class="login-bg-list-item"><a href="javascript:;" class="login-bg-list-link" data-toggle="login-change-bg" data-img="{{asset('admin-panel/assets/img/login-bg/login-bg-14.jpg')}}" style="background-image: url(../assets/img/login-bg/login-bg-14.jpg)"></a></div>
        <div class="login-bg-list-item"><a href="javascript:;" class="login-bg-list-link" data-toggle="login-change-bg" data-img="{{asset('admin-panel/assets/img/login-bg/login-bg-13.jpg')}}" style="background-image: url(../assets/img/login-bg/login-bg-13.jpg)"></a></div>
        <div class="login-bg-list-item"><a href="javascript:;" class="login-bg-list-link" data-toggle="login-change-bg" data-img="{{asset('admin-panel/assets/img/login-bg/login-bg-12.jpg')}}" style="background-image: url(../assets/img/login-bg/login-bg-12.jpg)"></a></div>
    </div>
    <!-- END login-bg -->

</div>
<!-- END #app -->

@include('dashboard.layouts.foot')

</body>

