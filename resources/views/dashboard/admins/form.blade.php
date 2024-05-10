@extends('dashboard.layouts.app')

@section('meta')
    <meta charset="utf-8" />
    <title>{{__('dashboard.admin.edit')}}</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
@endsection

@section('content')
    <div id="content" class="app-content">

        <!-- BEGIN breadcrumb -->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="javascript:;">{{__('dashboard.dashboard')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">{{__('dashboard.admins')}}</a></li>
            <li class="breadcrumb-item active">
                @if($method == 'PUT')
                    {{__('dashboard.admin.edit')}}
                @else
                    {{__('dashboard.admin.add')}}
                @endif
            </li>
        </ol>
        <!-- END breadcrumb -->
        <!-- BEGIN page-header -->
        <h1 class="page-header">{{__('dashboard.admins')}}</h1>
        <!-- END page-header -->
        <!-- BEGIN row -->
        <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($method)
            <!--begin::Input group-->
            <div class="fv-row mb-10">
                <div class="row">

                    <div class="col-6 mt-5">
                        <label class="fs-5 fw-bold form-label mb-5">Name :</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" class="form-control form-control-solid" value="{{ old('name') ?? $admin->name}}" placeholder="name" name="name" />
                        @error('name')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    @if($admin->system == 0)
                    <div class="col-6 mt-5">
                        <label class="fs-5 fw-bold form-label mb-5">User Name :</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" class="form-control form-control-solid" value="{{ old('userName') ?? $admin->userName}}" placeholder="userName" name="userName" />
                        @error('userName')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    @endif
                    <div class="col-6 mt-5">
                        <label class="fs-5 fw-bold form-label mb-5">Email :</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="email" class="form-control form-control-solid" value="{{ old('email') ?? $admin->email}}" placeholder="email" name="email" />
                        @error('email')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-6 mt-5">
                        <label class="fs-5 fw-bold form-label mb-5">Phone :</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="number" pattern="^\d{11}$" title="The number must be exactly 11 digits long." class="form-control form-control-solid" value="{{ old('phone') ?? $admin->phone}}" placeholder="phone" name="phone" />
                        @error('phone')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    @if($admin->system == 0)
                    <div class="col-6 mt-5">
                        <label class="fs-5 fw-bold form-label mb-5">Password :</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="password" class="form-control form-control-solid" placeholder="password" name="password" />
                        @error('password')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-6 mt-5">
                        <label class="fs-5 fw-bold form-label mb-5">Role:</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <select name="role" class="form-control form-control-solid">
                            <option value="">---</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ in_array($role->id  , $admin->roles->pluck('id')->toArray() )  ? 'selected' : ''}}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('type')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    @endif

                    <div class="col-6 mt-5">
                        <label class="fs-5 fw-bold form-label mb-5">Photo :</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input class="form-control form-control-solid" name="image" type="file" id="formFile" />
                        @error('image')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    @if($admin->image != null)
                        <img src="{{ $admin->image }}" class="col-3 mt-5" alt="brand" width="200" height="200">
                    @endif
                </div>
            </div>
            <!--end::Input group-->

            <!--begin::Actions-->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">
                    <span class="indicator-label">Save</span>
                </button>
            </div>
            <!--end::Actions-->
        </form>

        <!-- END row -->

    </div>

@endsection

@section('scripts')

    <script>

        function sendNameOfPermission(name) {

            $('#' + name).change(function() {
                if ($(this).is(":checked")) {
                    $('.' + name).prop('checked', true);
                } else {
                    $('.' + name).prop('checked', false);
                }
            });

            $("." + name).change(function() {
                if ($('.' + name + ':checked').length == $("." + name).length) {
                    $('#' + name).prop('checked', true);
                } else {
                    $('#' + name).prop('checked', false);
                }
            });

        }

        function checkAllPermission() {
            $('#all_checked').change(function() {
                if ($(this).is(":checked")) {
                    $('.all_checked').prop('checked', true);
                } else {
                    $('.all_checked').prop('checked', false);
                }
            });
        }

        $(".all_checked").change(function() {
            if ($('.all_checked:checked').length == $('.all_checked').length) {
                $('#all_checked').prop('checked', true);
            } else if ($('.all_checked:checked').length == $('.all_checked').length - 1) {
                $('#all_checked').prop('checked', true);
            } else {
                $('#all_checked').prop('checked', false);
            }
        });

    </script>

@endsection
