@extends('dashboard.layouts.app')

@section('meta')
    <meta charset="utf-8" />
    <title>{{__('dashboard.shipping.edit')}}</title>
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
            border: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            grid-gap: 10px;
        }
        .custom-file-upload input[type="file"] {
            position: absolute;
            font-size: 100px;
            opacity: 0;
            right: 0;
            top: 0;
        }
        .upload-area {
            display: inline-block;
            cursor: pointer;
        }
        .icon-upload {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
        }
        .icon-upload::before {
            content: '\f093';
            /* FontAwesome upload icon */
            font-family: 'FontAwesome';
            font-size: 24px;
            color: #999;
        }
        .preview-image {
            max-width: 100px;
            margin: 10px;
        }
    </style>
@endsection

@section('content')

    <!-- BEGIN Content -->
    <div id="content" class="app-content">
        <!-- BEGIN breadcrumb -->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="javascript:;">{{__('dashboard.dashboard')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('shipping.index')}}">{{__('dashboard.shippings')}}</a></li>
            <li class="breadcrumb-item active">
                @if($method == 'PUT')
                    {{__('dashboard.shipping.edit')}}
                @else
                    {{__('dashboard.shipping.add')}}
                @endif
            </li>
        </ol>
        <!-- END breadcrumb -->
        <!-- BEGIN page-header -->
        <h1 class="page-header">{{__('dashboard.shippings')}}</h1>
        <!-- END page-header -->

        <!-- BEGIN row -->
        <div class="row mb-3">
            <!-- BEGIN col-6 -->
            <div class="col-xl-6">
                <!-- BEGIN panel -->
                <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                    <!-- BEGIN panel-heading -->
                    <div class="panel-heading">
                        <h4 class="panel-title">Shipping Methods</h4>
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
                        <!-- BEGIN form -->
                        <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method($method)
                        <!--begin::Input group-->
                            <div class="row mb-15px">
                                @foreach (Config('language') as $key => $lang)
                                    <label class="form-label col-form-label col-md-3">Name In {{ $lang }} :</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control form-control-solid" value="{{ old('name.'.$key) ?? $shipping->getTranslation('name',$key)}}" placeholder="{{ 'name-'.$lang }}" name="name[{{ $key}}]" />
                                        @error('name.'.$key)
                                        <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>
                            <div class="row mb-15px">
                                <label class="form-label col-form-label col-md-3">Duration of shipping </label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control form-control-solid" value="{{ old('duration') ?? $shipping->duration}}" placeholder="Insert the duration of the shipping" name="duration" />
                                    @error('duration')
                                    <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-15px">
                                <label class="form-label col-form-label col-md-3">Shipping Price</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control form-control-solid" value="{{ old('price') ?? $shipping->price}}" placeholder="Insert the duration of the shipping" name="price" />
                                    @error('price')
                                    <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-15px">
                                <label class="form-label col-form-label col-md-3">Company Image</label>
                                <p>minimum image size : 50px X 50px</p>
                                <div class="custom-file-upload">
                                    <label for="formFile2" class="upload-area">
                                        <div class="icon-upload form-control">
                                            <span class="p-1">Upload Images</span>
                                        </div>
                                        <input class="file-input" name="images[]" type="file" id="formFile2" accept=".png, .jpg, .jpeg, .svg, .webp" onchange="previewImages();" multiple/>
                                    </label>
                                </div>
                                <div id="preview-images"></div>
                            </div>
                            <div class="row mb-15px">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary d-block w-100">
                                        <span class="indicator-label"> <i class="fa-regular fa-floppy-disk"></i> Save</span>
                                    </button>
                                </div>
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!-- END form -->
                    </div>
                    <!-- END panel-body -->
                </div>
                <!-- END Panel -->

            </div>
            <!-- End col-6 -->
        </div>
        <!-- ./END Row -->
    </div>
    <!-- ./END Content -->

@endsection

@section('scripts')
    <script>
        function previewImages() {
            var files = document.getElementById('formFile2').files;
            var previewImages = document.getElementById('preview-images');
            previewImages.innerHTML = ''; // Clear previous content

            Array.from(files).forEach(function(file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'preview-image';
                    previewImages.appendChild(img);
                }
                reader.readAsDataURL(file);
            });
        }
    </script>
@endsection
