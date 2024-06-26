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
                    <li class="breadcrumb-item active">Coupons</li>
                </ul>
                <h1 class="page-header mb-0">Coupons</h1>
            </div>
        </div>

        <!-- panel -->
        <div class="panel panel-inverse">
            <!-- panel heading -->
            <div class="panel-heading ui-sortable-handle">
                <h4 class="panel-title">Edit Coupon</h4>
                <!-- Panel buttons -->
                <div class="panel-heading-btn">
                    <!-- You can add panel buttons here if needed -->
                </div>
            </div>
            <!-- ./panel heading -->

            <!-- panel body -->
            <div class="panel-body">
                <form action="{{ route('dashboard.coupons.update', $coupon->id ) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('dashboard.coupons.partials.form')
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
