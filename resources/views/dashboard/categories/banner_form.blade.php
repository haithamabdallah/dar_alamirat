@extends('dashboard.layouts.app')

@section('meta')
    <meta charset="utf-8" />
    <title>{{__('dashboard.banner.add')}}</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
@endsection

@section('customcss')

    <link href="{{ asset('admin-panel/assets/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />

<!-- ================== END page-css ================== -->

    <style>
        .custom-file-upload {
            justify-content: center;
            align-items: center;
            position: relative;
            cursor: pointer;
            border: 1px dashed #495057;
        }
        .custom-file-upload .form-control {
            border:0;
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
            opacity: 0; /* Hide the default file input */
            position: absolute;
            top: 0;
            left: 0;
            cursor: pointer;
        }

        .icon-upload::before {
            content: '\f093'; /* FontAwesome upload icon */
            font-family: 'FontAwesome';
            font-size: 24px;
            color: #999;
        }

        .preview-area {
            position: relative;
            display: block;
            justify-content: center;
            align-items: center;
            max-width: 100px;
            max-height: 100px;
            /*width: 200px;  Width of the preview area */
            /*height: 200px;  Height of the preview area */
            overflow: inherit; /* Hide the overflow to maintain the area size */
        }

        #imagePreview {
            max-width: 100px;
            max-height: 100px;
            border-radius: 10px;
            margin-top: 15px;
            display: none; /* Hide until an image is selected */
        }

        .clear-image,
        .banner-clear-image {
            position: absolute;
            right: -10px;
            top: -10px;
            font-size: 16px;
            color: #fff;
            cursor: pointer;
            width: 20px;
            height: 20px;
            background: red;
            border-radius: 100%;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }

    </style>
@endsection

@section('content')

    <!-- BEGIN Content -->
    <div id="content" class="app-content">
        <!-- BEGIN breadcrumb -->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="javascript:;">{{__('dashboard.dashboard')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('banner.index')}}">{{__('dashboard.banners')}}</a></li>
            <li class="breadcrumb-item active">
                @if($method == 'PUT')
                    {{__('dashboard.banner.edit')}}
                @else
                    {{__('dashboard.banner.add')}}
                @endif
            </li>
        </ol>
        <!-- END breadcrumb -->

        <!-- BEGIN page-header -->
        <h1 class="page-header">
            @if($method == 'PUT')
                {{__('dashboard.banner.edit')}}
            @else
                {{__('dashboard.banner.add')}}
            @endif
        </h1>
        <!-- END page-header -->

        <!-- BEGIN row -->
        <div class="row mb-3">

            <!-- BEGIN col-6 -->
            <div class="col-xl-6">
                <!-- BEGIN panel -->
                <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                    <!-- BEGIN panel-heading -->
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            @if($method == 'PUT')
                                {{__('dashboard.banner.edit')}}
                            @else
                                {{__('dashboard.banner.add')}}
                            @endif
                        </h4>
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
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method($method)
                            
                            @if($method != 'PUT')
                            <div class="card border-0 mb-4">
                                <div class="m-2">
                                    <div class="form-group row">
                                        <label class="form-label col-form-label col-md-3"> Type: </label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="type" id="type-selector">
                                                <option selected disabled value="null">Select Type</option>
                                                <option value="category"> {{ __('Category') }} </option>
                                                <option value="brand"> {{ __('Brand') }} </option>
                                            </select>
                                        </div>
                                    </div>
                                    @error('type')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="m-2" id="selector-container">
                                    <div   id="category-selector">
                                        <div class="form-group row">
                                            <label class="form-label col-form-label col-md-3"> Category : </label>
                                            <div class="col-sm-9">
                                                {{-- <select class="default-select2 form-control" name="category_id" id="category-selector-element"> --}}
                                                <select class="form-control" name="bannerableId" id="category-selector-element">
                                                    <option selected disabled value="null">Select Category</option>
                                                    @foreach ($categories as $id => $name)
                                                        <option value="{{ $id }}"> {{ $name }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @error('category_id')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div  id="brand-selector">
                                        <div class="form-group row">
                                            <label class="form-label col-form-label col-md-3"> Brand : </label>
                                            <div class="col-sm-9">
                                                {{-- <select class="default-select2  form-control" name="brand_id" id="brand-selector-element"> --}}
                                                <select class="form-control" name="bannerableId" id="brand-selector-element">
                                                    <option selected disabled value="null">Select Brand</option>
                                                    @foreach ($brands as $id => $name)
                                                        <option value="{{ $id }}"> {{ $name }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @error('brand_id')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            @endif
                            {{-- <div class="row mb-15px">
                                <label class="form-label col-form-label col-md-3">priority :</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="priority" id="" required>
                                        <option disabled selected>Select Priority</option>
                                        @for ($i = 0; $i <= 100; $i++)
                                            <option value="{{$i}}" @if(isset($banner->category) && $banner->category->priority == $i) selected @endif>{{$i}}</option>
                                        @endfor
                                    </select>
                                    @error('priority')
                                    <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div> --}}
                            @if($method == 'POST')
                                <div class="row mb-15px" id="bannerImageRow">
                                    <label class="form-label col-form-label col-md-3"> Banner Image: </label>
                                    <div class="col-sm-9">
                                        <p>minimum image size : 100% X 300px</p>
                                        <div class="custom-file-upload">
                                            <label for="formFile" class="upload-area">
                                                <div class="icon-upload form-control"> <span class="p-1"> Upload Banner Image </span></div>
                                                <input class="file-input" name="image" type="file" accept=".png, .jpg, .jpeg ,.svg ,.webp" onchange="preview()"/>
                                            </label>
                                        </div>
                                        <div class="preview-area">
                                            <img id="frame" src="" style="display: none ; margin: 1rem auto" width="100px" height="100px"/> 
                                        </div>
                                        @error('icon')
                                        <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            @else
                                <div class="row mb-15px categoryDetails">
                                    <label class="form-label col-form-label col-md-3">Banner Image :</label>
                                    <div class="col-md-9">
                                        <div class="custom-file-upload">
                                            <label for="formFile" class="upload-area">
                                                <div class="icon-upload form-control"> <span class="p-1">Upload Image </span></div>
                                                <input class="file-input" name="image" type="file" id="formFile" accept=".png, .jpg, .jpeg ,.svg ,.webp" onchange="previewImage();" />
                                            </label>
                                        </div>
                                        @error('image')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                        <div class="preview-area">
                                            <img id="imagePreview" src="{{  storage_asset($banner->image) ?? ''}}" alt="Image preview" style="display: {{isset($banner->image) ?'block' : 'none'}};" width="200" height="200">
                                            <div class="clear-image" onclick="clearImage();" style="display: none;">&times;</div>
                                        </div>
                                    </div>
                                </div>
                            @endif

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
        <!-- ./END Row -->

    </div>
    <!-- END Content -->

@endsection

@section('scripts')
    <script src="{{ asset('admin-panel/assets/plugins/select2/dist/js/select2.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            let typeSelector = $("#type-selector");
            let selectorContainer = $("#selector-container");
            let categorySelector = $("#category-selector");
            let brandSelector = $("#brand-selector");
            let categorySelectorDiv = $("#category-selector").prop('outerHTML');
            let brandSelectorDiv = $("#brand-selector").prop('outerHTML');

            selectorContainer.html('')

            typeSelector.on('change', function () {
                if (typeSelector.val() == "category") {
                    selectorContainer.html(categorySelectorDiv)
                } else if (typeSelector.val() == "brand") {
                    selectorContainer.html(brandSelectorDiv)
                }
            })

        })

        function preview() { frame.src=URL.createObjectURL(event.target.files[0]); $("#frame").show() }

        function previewImage() {
            var file = document.getElementById('formFile').files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                var imgElement = document.getElementById('imagePreview');
                var clearBtn = document.querySelector('.clear-image');
                imgElement.src = e.target.result;
                imgElement.style.display = 'block';
                clearBtn.style.display = 'flex';
            };
            reader.readAsDataURL(file);
        }

        function clearImage() {
            var fileInput = document.getElementById('formFile');
            var imgElement = document.getElementById('imagePreview');
            var clearBtn = document.querySelector('.clear-image');
            fileInput.value = ''; // Clear the file input
            imgElement.src = '';
            imgElement.style.display = 'none';
            clearBtn.style.display = 'none';
        }
    </script>
@endsection
