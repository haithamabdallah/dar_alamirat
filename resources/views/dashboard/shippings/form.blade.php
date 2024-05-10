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
            border: solid;
            justify-content: center;
            align-items: center;
            position: relative;
            padding: 10px;
            cursor: pointer;
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
            width: 200px; /* Width of the preview area */
            height: 200px; /* Height of the preview area */
            overflow: inherit; /* Hide the overflow to maintain the area size */
        }

        #imagePreview {
            max-width: 100%;
            max-height: 100%;
            display: none; /* Hide until an image is selected */
        }

        .clear-image {
            position: absolute;
            right: 10px;
            top: 10px;
            font-size: 24px;
            color: #999;
            cursor: pointer;
        }

        /* Styling when user hovers over the upload area */
        .custom-file-upload:hover .icon-upload::before {
            color: #333;
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
        function previewImage() {
            var file = document.getElementById('formFile').files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                var imgElement = document.getElementById('imagePreview');
                var clearBtn = document.querySelector('.clear-image');
                imgElement.src = e.target.result;
                imgElement.style.display = 'block';
                clearBtn.style.display = 'block';
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
