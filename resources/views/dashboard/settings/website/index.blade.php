@extends('dashboard.layouts.app')

@section('customcss')
    <link href="{{ asset('admin-panel/assets/plugins/dropzone/dist/min/dropzone.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin-panel/assets/plugins/switchery/dist/switchery.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('theme1-assets/css/intlTelInput.min.css') }}">

    <style>
        .iti {
            width: 100%;
        }

        .custom-file-upload {
            justify-content: center;
            align-items: center;
            position: relative;
            cursor: pointer;
            border: 1px dashed #495057;
        }

        .custom-file-upload .form-control {
            border: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            grid-gap: 10px;
        }

        .upload-area {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .file-input {
            width: 100%;
            height: 100%;
            opacity: 0;
            /* Hide the default file input */
            position: absolute;
            top: 0;
            left: 0;
            cursor: pointer;
        }

        .icon-upload::before {
            content: '\f093';
            /* FontAwesome upload icon */
            font-family: 'FontAwesome';
            font-size: 24px;
            color: #999;
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

                        $setting = Setting::where('type', 'general')->first();
                    @endphp
                    <!-- BEGIN panel-body -->
                    <div class="panel-body">
                        <form action="{{ route('site') }}" id="siteInfo" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-15px">
                                <label class="form-label col-form-label col-md-3">Website Theme</label>
                                <div class="col-sm-9">
                                    <select name="theme" id="theme" class="form-control @error('theme') is-invalid @enderror">
                                        @foreach (['theme1' => 'Theme 1' /* , 'theme2' => 'Theme 2', 'theme3' => 'Theme 3' */ ] as $key => $value)
                                            <option value="{{ $key }}" {!! isset($setting->value['theme']) && $setting->value['theme'] == $key ? 'selected' : '' !!}> {{ $value }} </option>
                                        @endforeach
                                    </select>
                                    @error('theme')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-15px">
                                <label class="form-label col-form-label col-md-3">Website Logo</label>
                                <div class="col-sm-9">
                                    <p>minimum image size : 100px X 100px</p>
                                    <input type="file" name="website_logo"
                                        class="form-control @error('website_logo') is-invalid @enderror"
                                        onchange="preview1()">
                                    @error('website_logo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <img id="frame1" src="" width="50px" height="50px" class="my-2"
                                        alt="img preview" />
                                </div>
                            </div>
                            <div class="row mb-15px">
                                <label class="form-label col-form-label col-md-3">Website Icon</label>
                                <div class="col-sm-9">
                                    <p>minimum image size : 50px X 50px</p>
                                    <input type="file" name="website_icon"
                                        class="form-control @error('website_icon') is-invalid @enderror"
                                        onchange="preview2()">
                                    @error('website_icon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <img id="frame2" src="" width="50px" height="50px" class="my-2"
                                        alt="img preview" />
                                </div>
                            </div>

                            <div class="row mb-15px">
                                <label class="form-label col-form-label col-md-3">Website Name</label>
                                <div class="col-sm-9">
                                    <input class="form-control @error('website_name') is-invalid @enderror"
                                        name="website_name" type="text" placeholder="Website Name"
                                        value="{{ isset($setting->value['website_name']) ? $setting->value['website_name'] : '' }}" />
                                    @error('website_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-15px">
                                <label class="form-label col-form-label col-md-3">Website Description</label>
                                <div class="col-sm-9">
                                    <input class="form-control @error('website_description') is-invalid @enderror"
                                        name="website_description" type="text" placeholder="Website Description"
                                        value="{{ isset($setting->value['website_description']) ? $setting->value['website_description'] : '' }}" />
                                    @error('website_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-15px">
                                <label class="form-label col-form-label col-md-3">Website Address</label>
                                <div class="col-sm-9">
                                    <input class="form-control @error('website_address') is-invalid @enderror"
                                        name="website_address" type="text" placeholder="Website Address"
                                        value="{{ isset($setting->value['website_address']) ? $setting->value['website_address'] : '' }}" />
                                    @error('website_address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-15px">
                                <label class="form-label col-form-label col-md-3">Phone Number</label>
                                <div class="col-sm-9">
                                    <input class="form-control @error('tel') is-invalid @enderror" name="tel"
                                        type="number" placeholder="Phone Number" min="0"
                                        value="{{ isset($setting->value['tel']) ? $setting->value['tel'] : '' }}" />
                                    @error('tel')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-15px">
                                <label class="form-label col-form-label col-md-3">WhatsApp</label>
                                <div class="col-sm-9">
                                    <input class="form-control @error('whats_app') is-invalid @enderror" name="whats_app"
                                        type="number" placeholder="WhatsApp" min="0"
                                        value="{{ isset($setting->value['whats_app']) ? $setting->value['whats_app'] : '' }}" />
                                    @error('whats_app')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            @foreach (config('language') as $key => $lang)
                                <div class="row mb-15px">
                                    <label class="form-label col-form-label col-md-3">Currency {{ $lang }}</label>
                                    <div class="col-sm-9">
                                        <input class="form-control @error('currency-{{$key}}') is-invalid @enderror" name="currency-{{$key}}"
                                            type="text" placeholder="Currency {{ $lang }}"
                                            value="{{ isset($setting->value["currency-$key"]) ? $setting->value["currency-$key"] : '' }}" />
                                        @error('currency-{{$key}}')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach

                            <div class="row mb-15px">
                                <label class="form-label col-form-label col-md-3">Vat</label>
                                <div class="col-sm-9">
                                    <input class="form-control @error('vat') is-invalid @enderror" name="vat"
                                        type="number" min="0" placeholder="vat"
                                        value="{{ isset($setting->value['vat']) ? $setting->value['vat'] : '' }}" />
                                    @error('vat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- NEW CODE HERE -->
                            {{-- <div class="row mb-15px">
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
                                </div> --}}
                            <!-- NEW CODE HERE -->

                            <!-- Main Banner Image -->

                            <div class="row mb-15px categoryDetails">
                                <label class="form-label col-form-label col-md-3">Main Banner Image :</label>
                                <div class="col-md-9">
                                    <p>minimum image size : 100% X 500px</p>
                                    <div class="custom-file-upload">
                                        <label for="formFile" class="upload-area">
                                            <div class="icon-upload form-control"> <span class="p-1">Upload Image
                                                </span></div>
                                            <input class="file-input" name="main_banner" type="file" id="formFile"
                                                accept=".png, .jpg, .jpeg ,.svg ,.webp" onchange="preview3();" />
                                        </label>
                                    </div>
                                    @error('main_banner')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <div class="preview-area d-flex">
                                        @if (isset($setting?->value['main_banner']))
                                            <div class="" style="position: relative;">
                                                <img id="" class=" m-2"
                                                    src="{{ isset($setting?->value['main_banner']) ? storage_asset($setting?->value['main_banner']) : '' }}"
                                                    alt="Image preview"
                                                    style="display: {{ isset($setting?->value['main_banner']) ? 'flex' : 'none' }};"
                                                    width="200" height="200">

                                                <div class="bg-danger p-2 d-flex justify-content-center align-items-center "
                                                    style="top:10px ; right: 10px ; position: absolute; font-weight: 600">
                                                    status : &nbsp; &nbsp;
                                                    <input type="checkbox" name="main_banner_status" id=""
                                                        value="1" {!! isset($setting?->value['main_banner_status']) && $setting?->value['main_banner_status'] == true
                                                            ? 'checked'
                                                            : '' !!}>
                                                </div>
                                        @endif

                                    </div>
                                    <img id="frame3" src="" alt="Image preview" style="display: none;"
                                        class=" m-2" width="200" height="200">
                                </div>
                            </div>
                    </div>

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
    <script src="{{ asset('admin-panel/assets/plugins/dropzone/dist/min/dropzone.min.js') }}"></script>
    <script>
        $('#frame1').hide()
        $('#frame2').hide()

        function preview1() {
            frame1.src = URL.createObjectURL(event.target.files[0]);
            $('#frame1').show()
        }

        function preview2() {
            frame2.src = URL.createObjectURL(event.target.files[0]);
            $('#frame2').show()
        }

        function preview3() {
            frame3.src = URL.createObjectURL(event.target.files[0]);
            $('#frame3').show()
        }
    </script>
    {{-- <script src="{{ asset('theme1-assets/js/intlTelInput.min.js') }}"></script>
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
    </script> --}}
@endsection
