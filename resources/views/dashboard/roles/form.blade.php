@extends('dashboard.layouts.app')

@section('meta')
    <meta charset="utf-8" />
    <title>{{__('dashboard.role.edit')}}</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
@endsection

@section('content')
    <div id="content" class="app-content">

        <!-- BEGIN breadcrumb -->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="javascript:;">{{__('dashboard.dashboard')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('roles.index')}}">{{__('dashboard.roles')}}</a></li>
            <li class="breadcrumb-item active">
                @if($method == 'PUT')
                    {{__('dashboard.role.edit')}}
                @else
                    {{__('dashboard.role.add')}}
                @endif
            </li>
        </ol>
        <!-- END breadcrumb -->
        <!-- BEGIN page-header -->
        <h1 class="page-header">{{__('dashboard.roles')}}</h1>
        <!-- END page-header -->
        <!-- BEGIN row -->
        <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($method == 'PUT')
                @method('PUT')
            @endif

            <!--begin::Input group-->
            <div class="fv-row mb-10">
                <div class="row">

                    <div class="col-6 mb-5">
                        <label class="fs-5 fw-bold form-label mb-5">{{__('dashboard.role.role')}} {{__('dashboard.role.name')}} :</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" class="form-control form-control-solid" value="{{ old('name') ?? $role->name}}" placeholder="name" name="name" />
                        @error('name')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-6 my-auto mx-auto text-center">
                        {{-- <label class="fs-5 fw-bold form-label">.</label> --}}
                        <input type="checkbox" id="all_checked" class="form-check-input" onclick="checkAllPermission()">
                        {{__('dashboard.permission.all')}}
                    </div>

                    @foreach($permissions as $key => $permission)
                        <div class="col-2">
                            <input type="checkbox" id="{{ $key }}" class="form-check-input all_checked" onclick="sendNameOfPermission('{{ $key }}')">
                            <span>
                                <h4 class="d-inline-block"> {{ $key }} </h4>
                            </span>
                        </div>
                        <div class="col-10">
                            <div class="row">
                                @foreach ($permission as $item)
                                    <div class="col-1"></div>
                                    <div class="col-1 mt-3">
                                        <input type="checkbox" class="form-check-input {{ $key }} all_checked" name="permissions[{{ $item['id'] }}]" value="{{ $item['id'] }}" @if(is_array(old('permissions')) && in_array($item['id'] , old('permissions'))) checked @endif {{ in_array($item['id']  , $selectedPermissions)  ? 'checked' : ''}} />
                                    </div>
                                    <div class="col-1 mt-3">
                                        <label class="fs-5 fw-bold form-label mb-5">{{ $item['name'] }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <hr>
                    @endforeach

                </div>
            </div>
            <!--end::Input group-->

            <!--begin::Actions-->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">
                    <span class="indicator-label">{{__('dashboard.save')}}</span>
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
