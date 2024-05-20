@extends('dashboard.layouts.app')


@section('customcss')
    <!-- ================== BEGIN page-css ================== -->
    <link href="{{ asset('admin-panel/assets/plugins/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin-panel/assets/plugins/dropzone/dist/min/dropzone.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin-panel/assets/plugins/tag-it/css/jquery.tagit.css') }}" rel="stylesheet" />
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

    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <div class="d-flex align-items-center mb-3">
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">{{__('dashboard.home')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('product.index')}}">{{__('dashboard.products')}}</a></li>
                    <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i>
                        @if($method == 'PUT')
                            {{__('dashboard.product.edit')}}
                        @else
                            {{__('dashboard.product.add')}}
                        @endif
                    </li>
                </ol>
            </div>
        </div>

        <form action="{{ $action }}" method="POST" enctype="multipart/form-data" id="product-dropzone">
            @csrf
            @method($method)

            <div class="row">
                <div class="col-lg-8">
                    <div class="card border-0 mb-4">
                        <div class="card-header h6 mb-0 bg-none p-3">
                            <i class="fa fa-dolly fa-lg fa-fw text-dark text-opacity-50 me-1"></i> Product Information
                        </div>
                        <div class="card-body">
                            @foreach (Config('language') as $key => $lang)
                                <div class="mb-3">
                                    <label class="form-label">Title  In {{ $lang }} :</label>
                                    <input type="text" class="form-control" name="title[{{ $key }}]" value="{{ old('title.'.$key) ?? $product->getTranslation('title',$key)}}" placeholder="Product Title">
                                </div>
                                @error('title.'.$key)
                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            @endforeach
                            @foreach(Config('language') as $key => $lang)
                                <div class="">
                                    <label class="form-label">Description In {{ $lang }} : </label>
                                    <div class="form-control p-0 overflow-hidden">
                                        <textarea class="textarea form-control wysihtml5" name="description[{{$key}}]" placeholder="Enter text ..." rows="12">{{ old('description.'.$key) ?? $product->getTranslation('description',$key)}}</textarea>
                                    </div>
                                    @error('description.'.$key)
                                    <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            @endforeach
                            @foreach(Config('language') as $key => $lang)
                                <div class="">
                                    <label class="form-label">Instruction In {{ $lang }} : </label>
                                    <div class="form-control p-0 overflow-hidden">
                                        <textarea class="textarea form-control wysihtml5" name="instructions[{{$key}}]"  placeholder="Enter text ..." rows="12">{{ old('instructions.'.$key) ?? $product->getTranslation('instructions',$key)}}</textarea>
                                    </div>
                                    @error('instructions.'.$key)
                                    <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card border-0 mb-4">
                        <div class="card-header h6 mb-0 bg-none p-3">
                            <i class="fa fa-sitemap fa-lg fa-fw text-dark text-opacity-50 me-1"></i> Selectors
                        </div>
                        <div class="m-2">
                            <div class="form-group row">
                                <label class="form-label col-form-label col-lg-4"> Category</label>
                                <div class="col-lg-8">
                                    <select class="default-select2 form-control" name="category_id">
                                        <option selected disabled>Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" @if($category->id == $product->category_id) selected @endif>{{$category->name}}</option>
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
                        <div class="m-2">
                            <div class="form-group row">
                                <label class="form-label col-form-label col-lg-4"> Brand</label>
                                <div class="col-lg-8">
                                    <select class="default-select2 form-control" name="brand_id">
                                        <option selected disabled>Select Brand</option>
                                        @foreach($brands as $brand)
                                            <option value="{{$brand->id}}" @if($brand->id == $product->brand_id) selected @endif>{{$brand->name}}</option>
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
                    <div class="card border-0 mb-4">
                        <div class="card-header h6 mb-0 bg-none p-3">
                            <i class="fa fa-file-image fa-lg fa-fw text-dark text-opacity-50 me-1"></i> Media
                        </div>
                        <div class="card-body">
                            <div class="col-6 mt-5">
                                <div class="custom-file-upload">
                                    <label for="formFile" class="upload-area">
                                        <div class="icon-upload form-control"> <span class="p-1">Upload Thumbnail </span></div>
                                        <input class="file-input" name="thumbnail" type="file" id="formFile" accept=".png, .jpg, .jpeg ,.svg ,.webp" onchange="previewImage();" />
                                    </label>
                                </div>
                                @error('thumbnail')
                                <span class="text-danger" role="alert">
                                     <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <div class="preview-area">
                                    <img id="imagePreview" src="{{  $product->thumbnail ?? ''}}" alt="Image preview" style="display: {{isset($category->icon) ?'block' : 'none'}};" width="200" height="200">
                                    <div class="clear-image" onclick="clearImage();" style="display: none;">x</div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            {{--<div id="dropzone">
                                <input type="file" name="images[]" id="dropzon" multiple>
                            </div>--}}
                            <div id="dropzone">
                                <div action="/upload" class="dropzone needsclick" id="my-awesome-upload">
                                    <div class="dz-message needsclick">
                                        Drop files <b>here</b> or <b>click</b> to upload.<br />
                                        <span class="dz-note needsclick">
        (This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.)
      </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-0 mb-4">
                        <div class="card-header h6 mb-0 bg-none p-3">
                            <i class="fa fa-sitemap fa-lg fa-fw text-dark text-opacity-50 me-1"></i> Variants
                        </div>
                        <div class="card-body">
                            <div class="alert alert-success">
                                Add variants if this product comes in multiple versions, like different sizes or colors.
                            </div>
                            <div class="row mb-3 fw-bold text-dark">
                                <div class="col-5">Size</div>
                                <div class="col-5">Color </div>
                            </div>
                            <div class="row mb-3 gx-3">
                                <div class="col-5">
                                    <input type="text" id="newSize" class="form-control" name="[size]" placeholder="e.g Size" />
                                </div>
                                <div class="col-5">
                                    <input type="text" id="newColor" class="form-control" name="[color]" placeholder="e.g Color" />
                                </div>
                                <div class="col-2">
                                    <button type="button" id="addVariantButton" class="btn btn-primary">Add Variant</button>
                                </div>
                            </div>
                            <p>Modify the variants to be created:</p>
                            <table class="table fw-bold">
                                <thead>
                                <tr>
                                    <th width="1%"></th>
                                    <th>Variant</th>
                                    <th width="150px">Price</th>
                                    <th width="75px">Quantity</th>
                                    <th width="150px"></th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card border-0 mb-4">
                        <div class="card-header h6 mb-0 bg-none p-3 d-flex">
                            <div class="flex-1">
                                <div>Product Discount</div>
                            </div>
                        </div>
                        <div class="card-body fw-bold">
                            <div class="mb-3">
                                <label class="form-label">Discount type</label>
                                <div class="input-group">
                                    <select class="default-select2 form-control" name="discount_type">
                                        <option selected disabled>Select Discount type</option>
                                        <option value="flat">Flat</option>
                                        <option value="percent">Percent</option>
                                    </select>
                                </div>
                                @error('discount_type')
                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-0">
                                <label class="form-label">Discount Value</label>
                                <div class="input-group">
                                    <input type="number" name="discount_value" class="form-control" placeholder="Insert the discount value" />
                                </div>
                                @error('discount_value')
                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <!--begin::Actions-->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">Save</span>
                    </button>
                </div>
                <!--end::Actions-->
            </div>

            <!-- #modal-dialog -->
            <div class="modal fade" id="modalVariant">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Modal Dialog</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <a href="javascript:;" class="btn btn-white" data-bs-dismiss="modal">Close</a>
                            <a href="javascript:;" class="btn btn-success">Action</a>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
    <!-- END #content -->
    <!-- #modal-dialog -->
    <div class="modal fade" id="modal-dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modal Dialog</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-white" data-bs-dismiss="modal">Close</a>
                    <a href="javascript:;" class="btn btn-success">Action</a>
                </div>
            </div>
        </div>
    </div>
    <!-- #modal-dialog -->
@endsection

@section('scripts')
    <!-- ================== BEGIN page-js ================== -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('admin-panel/assets/plugins/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <script src="{{ asset('admin-panel/assets/plugins/dropzone/dist/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin-panel/assets/plugins/jquery-migrate/dist/jquery-migrate.min.js') }}"></script>
    <script src="{{ asset('admin-panel/assets/plugins/tag-it/js/tag-it.min.js') }}"></script>
    <script src="{{ asset('admin-panel/assets/js/demo/product-details.demo.js') }}"></script>
    <script src="{{ asset('admin-panel/assets/plugins/select2/dist/js/select2.min.js') }}"></script>

    <!-- ================== END page-js ================== -->
    <!-- script -->
    <script>
        $('.wysihtml5').wysihtml5();
        $(".default-select2").select2();
    </script>
    <script>
        document.getElementById('addVariantButton').addEventListener('click', function() {
            const size = document.getElementById('newSize').value.trim();
            const color = document.getElementById('newColor').value.trim();
            const tableBody = document.querySelector('.table tbody');

            const newIndex = tableBody.rows.length;

            if (size || color) {
                let variantExists = false;
                document.querySelectorAll('.table tbody tr').forEach(row => {
                    const rowSize = row.querySelector(`input[name="variant[${row.rowIndex}][size]"]`)?.value.toLowerCase();
                    const rowColor = row.querySelector(`input[name="variant[${row.rowIndex}][color]"]`)?.value.toLowerCase();
                    if (rowSize === size.toLowerCase() && rowColor === color.toLowerCase()) {
                        variantExists = true;
                    }
                });
                if (!variantExists) {
                    const row = tableBody.insertRow();
                    row.innerHTML = `
                <td class="align-middle">
                    <div class="form-check">
                        <input type="checkbox" name="variant[${newIndex}][enabled]" class="form-check-input" checked />
                        <label class="form-check-label">&nbsp;</label>
                    </div>
                </td>
                <td class="fs-13px align-middle">
                    <input type="hidden" name="variant[${newIndex}][size]" value="${size}" />
                    <input type="hidden" name="variant[${newIndex}][color]" value="${color}" />
                    <span>${size ? size : ''}${size && color ? ' • ' : ''}${color ? color : ''}</span>
                </td>
                <td><input type="text" class="form-control" name="variant[${newIndex}][price]" placeholder="0.00" /></td>
                <td><input type="text" class="form-control" name="variant[${newIndex}][quantity]" placeholder="0" /></td>
                <td><a href="#modal-dialog" class="btn btn-primary" data-bs-toggle="modal">Modal</a></td>
            `;
                    document.getElementById('newSize').value = '';
                    document.getElementById('newColor').value = '';
                } else {
                    alert('This variant already exists.');
                }
            } else {
                alert('Please enter at least size or color.');
            }
        });
    </script>

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
<!-- toggler -->

