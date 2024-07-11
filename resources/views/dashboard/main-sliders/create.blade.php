@extends('dashboard.layouts.app')

@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <!-- BEGIN breadcrumb -->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.slider.index') }}">sliders</a></li>
            <li class="breadcrumb-item active">
                Create Slider
            </li>
        </ol>
        <!-- END breadcrumb -->
        <!-- BEGIN page-header -->
        <h1 class="page-header">Create Slider</h1>
        <!-- END page-header -->

        <!-- BEGIN row -->
        <div class="row mb-3">

            <!-- BEGIN col-6 -->
            <div class="col-xl-8">

                <!-- panel -->
                <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                    <!-- panel heading -->
                    <div class="panel-heading ui-sortable-handle">
                        <h4 class="panel-title">Create Slider</h4>
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
                    <!-- ./panel heading -->

                    <!-- panel body -->
                    <div class="panel-body">
                        <form action="{{ route('dashboard.slider.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @include('dashboard.main-sliders.partials.form')
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
<script>
  function preview1() { frame1.src=URL.createObjectURL(event.target.files[0]); }
  function preview2() { frame2.src=URL.createObjectURL(event.target.files[0]); }
</script>
@endsection