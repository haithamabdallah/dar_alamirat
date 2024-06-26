@extends('dashboard.layouts.app')

@section('customcss')
    <link href="{{ asset('admin-panel/assets/plugins/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.min.css') }}" rel="stylesheet" />
@endsection

@section('content')

    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <div class="d-flex align-items-center mb-3">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Pages</li>
                </ul>
                <h1 class="page-header mb-0">Pages</h1>
            </div>
        </div>

        <!-- panel -->
        <div class="panel panel-inverse">
            <!-- panel heading -->
            <div class="panel-heading ui-sortable-handle">
                <h4 class="panel-title">Edit Page</h4>
                <!-- Panel buttons -->
                <div class="panel-heading-btn">
                    <!-- You can add panel buttons here if needed -->
                </div>
            </div>
            <!-- ./panel heading -->

            <!-- panel body -->
            <div class="panel-body p-0">
                <form action="{{ route('page.update', ['page' => $page->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        @foreach(Config('language') as $key => $lang)
                            <div class="col-6">
                                <label class="form-label mb-3">Page Name In {{ $lang }}</label>
                                @if(is_array($page->name) && array_key_exists($key, $page->name))
                                <input class="form-control" type="text" name="name[{{$key}}]" value="{{ $page->name[$key] }}"/>
                            @else
                                <!-- Handle the case where $page->name is not an array or the key doesn't exist -->
                                <input class="form-control" type="text" name="name[{{$key}}]" value="{{ $page->name }}"/>
                            @endif                                @error('name.'.$key)
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        @endforeach
                        @foreach(Config('language') as $key => $lang)
                            <div class="col-12">
                                <div>
                                    <label class="form-label">Content In {{ $lang }} : </label>
                                    <div class="form-control p-0 overflow-hidden">
                                        @if(is_array($page->content) && array_key_exists($key, $page->content))
                                        <textarea class="textarea form-control wysihtml5" name="content[{{$key}}]" placeholder="Enter text ..." rows="12">{{ $page->content[$key] }}</textarea>
                                    @else
                                        <!-- Handle the case where $page->content is not an array or the key doesn't exist -->
                                        <textarea class="textarea form-control wysihtml5" name="content[{{$key}}]" placeholder="Enter text ..." rows="12">{{ $page->content }}</textarea>
                                    @endif
                                                                        </div>
                                    @error('content.'.$key)
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                        <div class="col-12">
                            <div class="m-3">
                                <label class="fs-5 fw-bold form-label mb-3">Priority:</label>
                                <select class="form-control" name="priority" required>
                                    <option disabled>Select Priority</option>
                                    @for ($i = 0; $i <= 10; $i++)
                                        <option value="{{$i}}" @if($page->priority == $i) selected @endif>{{$i}}</option>
                                    @endfor
                                </select>
                                @error('priority')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="text-center m-3">
                                <button type="submit" class="btn btn-primary">
                                    <span class="indicator-label">Update</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- ./panel body -->
        </div>
        <!-- ./panel -->
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
