@extends('dashboard.layouts.app')


@section('customcss')
    <link href="{{ asset('admin-panel/assets/plugins/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.min.css') }}" rel="stylesheet" />
@endsection


@section('content')

    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <!-- BEGIN breadcrumb -->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('category.index')}}">Pages</a></li>
            <li class="breadcrumb-item active">
                Create Page
            </li>
        </ol>
        <!-- END breadcrumb -->
        <!-- BEGIN page-header -->
        <h1 class="page-header">Create Page</h1>
        <!-- END page-header -->

        <!-- BEGIN row -->
        <div class="row mb-3">

            <!-- BEGIN col-6 -->
            <div class="col-xl-8">

                <!-- panel -->
                <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                    <!-- panel heading -->
                    <div class="panel-heading ui-sortable-handle">
                        <h4 class="panel-title">Create Page</h4>
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                    </div>
                    <!-- ./panel heading -->

                    <!-- panel body -->
                    <div class="panel-body">
                        <form action="{{ route('page.store') }}" method="POST">
                            @csrf

                            <!-- item -->
                            @foreach(Config('language') as $key => $lang)
                                <div class="row mb-15px">
                                    <label class="form-label col-form-label col-md-3">Page Name In {{ $lang }}</label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="name[{{$key}}]"/>
                                        @error('name.'.$key)
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach
                            <!-- ./item -->

                            <!-- item -->
                            @foreach(Config('language') as $key => $lang)
                                <div class="row mb-15px">
                                    <label class="form-label col-form-label col-md-12">Content In {{ $lang }} : </label>
                                    <div class="col-md-12">
                                        <div class="form-control">
                                            <textarea class="textarea form-control wysihtml5" name="content[{{$key}}]" placeholder="Enter text ..." rows="12"></textarea>
                                            @error('content.'.$key)
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <!-- ./item -->
                            <!-- item -->
                            <div class="row mb-15px">
                                <label class="form-label col-form-label col-md-3">Priority:</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="priority" required>
                                        <option disabled selected>Select Priority</option>
                                        @for ($i = 0; $i <= 10; $i++)
                                            <option value="{{$i}}" @if(old('priority') == $i) selected @endif>{{$i}}</option>
                                        @endfor
                                    </select>
                                    @error('priority')
                                    <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- ./item -->

                            <!-- item -->
                            <div class="row mb-15px">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary d-block w-100"><i class="fa-regular fa-floppy-disk"></i> Save</button>
                                </div>
                            </div>
                            <!-- ./item -->
                        </form>
                    </div>

                    <!-- ./panel body -->
                </div>
                <!-- ./panel -->

            </div>
            <!-- ./End col -->
        </div>
        <!-- ./End Row -->

    </div>
    <!-- END #content -->

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('admin-panel/assets/plugins/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <script>
        $('.wysihtml5').wysihtml5();
    </script>
@endsection
