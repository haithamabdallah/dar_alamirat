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
                        <h4 class="panel-title">Spcial Media</h4>
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                                    class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i
                                    class="fa fa-redo"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                                    class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i
                                    class="fa fa-times"></i></a>
                        </div>
                    </div>
                    <!-- END panel-heading -->
                    @php
                        use App\Models\Setting;

                        $setting = Setting::where('type', 'social_media')->first();
                    @endphp
                    <!-- BEGIN panel-body -->
                    <div class="panel-body">
                        <form action="{{ route('social') }}" id="socialMedia" method="POST">
                            @csrf
                            <div class="row mb-15px">
                                <div class="input-group input-group-lg mb-10px">
                                    <div class="input-group-text"><i class="fa-brands fa-facebook-f"></i></div>
                                    <input type="text" name="facebook" class="form-control" placeholder="facebook"
                                        value="{{ isset($setting->value['facebook']) ? $setting->value['facebook'] : '' }}">
                                    <input type="checkbox" class="m-2" name="status[facebook]" 
                                    {!! isset($setting->value['status']['facebook']) && $setting->value['status']['facebook'] == true  ? 'checked' : ''  !!} value="1">

                                </div>
                            </div>
                            @error('facebook')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="row mb-15px">
                                <div class="input-group input-group-lg mb-10px">
                                    <div class="input-group-text"><span class="fab fa-twitter"></span></div>
                                    <input type="text" name="twitter" class="form-control" placeholder="twitter"
                                        value="{{ isset($setting->value['twitter']) ? $setting->value['twitter'] : '' }}">
                                    <input type="checkbox" class="m-2" name="status[twitter]" 
                                    {!! isset($setting->value['status']['twitter']) && $setting->value['status']['twitter'] == true  ? 'checked' : ''  !!} value="1">
                                </div>
                            </div>
                            @error('twitter')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="row mb-15px">
                                <div class="input-group input-group-lg mb-10px">
                                    <div class="input-group-text"><i class="fa-brands fa-instagram"></i></div>
                                    <input type="text" name="instagram" class="form-control" placeholder="instagram"
                                        value="{{ isset($setting->value['instagram']) ? $setting->value['instagram'] : '' }}">
                                    <input type="checkbox" class="m-2" name="status[instagram]" 
                                    {!! isset($setting->value['status']['instagram']) && $setting->value['status']['instagram'] == true  ? 'checked' : ''  !!} value="1">

                                </div>
                            </div>
                            @error('instagram')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="row mb-15px">
                                <div class="input-group input-group-lg mb-10px">
                                    <div class="input-group-text"><i class="fa-brands fa-youtube"></i></div>
                                    <input type="text" name="youtube" class="form-control" placeholder="youtube"
                                        value="{{ isset($setting->value['youtube']) ? $setting->value['youtube'] : '' }}">
                                    <input type="checkbox" class="m-2" name="status[youtube]" 
                                    {!! isset($setting->value['status']['youtube']) && $setting->value['status']['youtube'] == true  ? 'checked' : ''  !!} value="1">

                                </div>
                            </div>
                            @error('youtube')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="row mb-15px">
                                <div class="input-group input-group-lg mb-10px">
                                    <div class="input-group-text"><i class="fa-brands fa-whatsapp"></i></div>
                                    <input type="text" name="whatsapp" class="form-control"
                                        placeholder="https://wa.me/+123456789"
                                        value="{{ isset($setting->value['whatsapp']) ? $setting->value['whatsapp'] : '' }}">
                                    <input type="checkbox" class="m-2" name="status[whatsapp]" 
                                    {!! isset($setting->value['status']['whatsapp']) && $setting->value['status']['whatsapp'] == true  ? 'checked' : ''  !!} value="1">

                                </div>
                            </div>
                            @error('whatsapp')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="row mb-15px">
                                <div class="input-group input-group-lg mb-10px">
                                    <div class="input-group-text"><i class="fa-brands fa-tiktok"></i></div>
                                    <input type="text" name="tiktok" class="form-control" placeholder="tiktok"
                                        value="{{ isset($setting->value['tiktok']) ? $setting->value['tiktok'] : '' }}">
                                    <input type="checkbox" class="m-2" name="status[tiktok]" 
                                    {!! isset($setting->value['status']['tiktok']) && $setting->value['status']['tiktok'] == true  ? 'checked' : ''  !!} value="1">

                                </div>
                            </div>
                            @error('tiktok')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="row mb-15px">
                                <div class="input-group input-group-lg mb-10px">
                                    <div class="input-group-text"><i class="fa-brands fa-snapchat"></i></div>
                                    <input type="text" name="snapchat" class="form-control" placeholder="snapchat"
                                        value="{{ isset($setting->value['snapchat']) ? $setting->value['snapchat'] : '' }}">
                                    <input type="checkbox" class="m-2" name="status[snapchat]" 
                                    {!! isset($setting->value['status']['snapchat']) && $setting->value['status']['snapchat'] == true  ? 'checked' : ''  !!} value="1">

                                </div>
                            </div>
                            @error('snapchat')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="row mb-15px">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary d-block w-100"><i
                                            class="fa-regular fa-floppy-disk"></i> Save</button>
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
