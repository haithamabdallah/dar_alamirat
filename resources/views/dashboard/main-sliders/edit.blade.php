@extends('dashboard.layouts.app')

@section('content')

    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <div class="d-flex align-items-center mb-3">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Sliders</li>
                </ul>
                <h1 class="page-header mb-0">Sliders</h1>
            </div>
        </div>

        <!-- panel -->
        <div class="panel panel-inverse">
            <!-- panel heading -->
            <div class="panel-heading ui-sortable-handle">
                <h4 class="panel-title">Edit Slider</h4>
                <!-- Panel buttons -->
                <div class="panel-heading-btn">
                    <!-- You can add panel buttons here if needed -->
                </div>
            </div>
            <!-- ./panel heading -->

            <!-- panel body -->
            <div class="panel-body">
                <form action="{{ route('dashboard.slider.update', $slider->id ) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    @include('dashboard.main-sliders.partials.form')
                </form>
            </div>
            <!-- ./panel body -->
        </div>
        <!-- ./panel -->
    </div>
    <!-- END #content -->

@endsection


@section('scripts')
<script>
  function preview1() { frame1.src=URL.createObjectURL(event.target.files[0]); }
  function preview2() { frame2.src=URL.createObjectURL(event.target.files[0]); }
</script>
@endsection
