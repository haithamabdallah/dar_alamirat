@extends('dashboard.layouts.app')

@section('meta')
    <meta charset="utf-8" />
    <title>{{__('dashboard.brand.add')}}</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
@endsection

@section('customcss')
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

        .clear-image {
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
            <li class="breadcrumb-item"><a href="{{route('brand.index')}}">{{__('dashboard.brands')}}</a></li>
            <li class="breadcrumb-item active">
                @if($method == 'PUT')
                    {{__('dashboard.brand.edit')}}
                @else
                    {{__('dashboard.brand.add')}}
                @endif
            </li>
        </ol>
        <!-- END breadcrumb -->

        <!-- BEGIN page-header -->
        <h1 class="page-header">{{__('dashboard.brands')}}</h1>
        <!-- END page-header -->

        <div class="col-xl-6">
            <!-- BEGIN panel -->
            <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                <!-- BEGIN panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Maintenance Mode</h4>
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
                    <!-- BEGIN row -->
                    <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method($method)

                        <div class="row mb-15px">
                            @foreach (Config('language') as $key => $lang)
                                <label class="form-label col-form-label col-md-3">Name In {{ $lang }} :</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control form-control-solid" value="{{ old('name.'.$key) ?? $brand->getTranslation('name',$key)}}" placeholder="{{ 'name-'.$lang }}" name="name[{{ $key}}]" />
                                    @error('name.'.$key)
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            @endforeach
                        </div>

                        <div class="row mb-15px">
                            <label class="form-label col-form-label col-md-3">Brand image :</label>
                            <div class="col-md-9">
                                <p>minimum image size : 250px X 125px</p>
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
                                    <img id="imagePreview" src="{{  storage_asset($brand->image) ?? ''}}" alt="Image preview" style="display: {{isset($brand->image) ?'block' : 'none'}};" width="200" height="200">
                                    <div class="clear-image" onclick="clearImage();" style="display: none;">&times;</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-15px">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary d-block w-100"><i class="fa-regular fa-floppy-disk"></i> Save</button>
                            </div>
                        </div>

                    </form>
                    <!-- END row -->
                </div>
                <!-- ./END Panel Body -->
            </div>
            <!-- ./END Panel -->
        </div>

    </div>
    <!-- ./END Content -->

@endsection

@section('scripts')


    <script>
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
