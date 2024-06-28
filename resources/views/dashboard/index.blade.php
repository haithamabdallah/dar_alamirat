@extends('dashboard.layouts.app')

@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">

        <!-- BEGIN breadcrumb -->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
            <li class="breadcrumb-item active">Statistics</li>
        </ol>
        <!-- END breadcrumb -->
        <!-- BEGIN page-header -->
        {{-- <h1 class="page-header">Dashboard v2 <small>header small text goes here...</small></h1> --}}
        <h1 class="page-header"> Dashboard Statistics </h1>
        <!-- END page-header -->
        <!-- BEGIN row -->
        <div class="row">
            <!-- BEGIN col-3 -->
            <div class="col-xl-3 col-md-6">
                <div class="widget widget-stats bg-teal">
                    <div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
                    <div class="stats-content">
                        <div class="stats-title">Clients</div>
                        <div class="stats-number">{{ $counts['users'] }}</div>
                        {{-- <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 70.1%;"></div>
                        </div>
                        <div class="stats-desc">Better than last week (70.1%)</div> --}}
                    </div>
                </div>
            </div>
            <!-- END col-3 -->
            <!-- BEGIN col-3 -->
            <div class="col-xl-3 col-md-6">
                <div class="widget widget-stats bg-blue">
                    <div class="stats-icon stats-icon-lg"><i class="fa fa-dollar-sign fa-fw"></i></div>
                    <div class="stats-content">
                        <div class="stats-title">Orders</div>
                        <div class="stats-number">{{ $counts['orders'] }}</div>
                        {{-- <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 40.5%;"></div>
                        </div> --}}
                        {{-- <div class="stats-desc">Better than last week (40.5%)</div> --}}
                    </div>
                </div>
            </div>
            <!-- END col-3 -->
            <!-- BEGIN col-3 -->
            <div class="col-xl-3 col-md-6">
                <div class="widget widget-stats bg-indigo">
                    <div class="stats-icon stats-icon-lg"><i class="fa fa-archive fa-fw"></i></div>
                    <div class="stats-content">
                        <div class="stats-title">Products</div>
                        <div class="stats-number">{{ $counts['products'] }}</div>
                        {{-- <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 76.3%;"></div>
                        </div> --}}
                        {{-- <div class="stats-desc">Better than last week (76.3%)</div> --}}
                    </div>
                </div>
            </div>
            <!-- END col-3 -->
            <!-- BEGIN col-3 -->
            <div class="col-xl-3 col-md-6">
                <div class="widget widget-stats bg-gray-900">
                    <div class="stats-icon stats-icon-lg"><i class="fa fa-comment-alt fa-fw"></i></div>
                    <div class="stats-content">
                        <div class="stats-title">Brands</div>
                        <div class="stats-number">{{ $counts['brands'] }}</div>
                        {{-- <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 54.9%;"></div>
                        </div> --}}
                        {{-- <div class="stats-desc">Better than last week (54.9%)</div> --}}
                    </div>
                </div>
            </div>
            <!-- END col-3 -->
        </div>
        <!-- END row -->

    </div>
    <!-- END #content -->
@endsection
