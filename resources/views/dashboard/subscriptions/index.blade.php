@extends('dashboard.layouts.app')

@section('meta')
    <meta charset="utf-8" />
    <title>Subscribers</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
@endsection

@section('customcss')
    <!-- Include your custom CSS here -->
@endsection

@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <div class="d-flex align-items-center mb-3">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('dashboard.home') }}</a></li>
                    <li class="breadcrumb-item">Subscribers</li>
                </ul>
                <h1 class="page-header mb-0">Subscribers</h1>
            </div>
            <div class="ms-auto">
                <a href="{{ route('subscription.create') }}" class="btn btn-success btn-rounded px-4 rounded-pill"><i class="fa fa-plus fa-lg me-2 ms-n2 text-success-900"></i>Send Newsletter </a>
            </div>
        </div>

        <!-- start card -->
        <div class="card border-0">
            <!-- content -->
            <div class="tab-content p-3">
                <!-- tab pane -->
                <div class="tab-pane fade show active" id="allTab">
                    <!-- table -->
                    <div class="table-responsive mb-3">
                        <table id="subscriberTableList" class="table table-hover table-panel text-nowrap align-middle mb-0">
                            <thead>
                                <tr>
                                    <th width="1%"></th>
                                    <th class="text-nowrap" width="20%">Email</th>
                                    <!-- Add more columns if needed -->
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($subscribers as $subscriber)
                                    <tr class="odd gradeX">
                                        <td width="1%" class="fw-bold text-dark">{{ $loop->iteration }}</td>
                                        <td>{{ $subscriber->email }}</td>
                                        <!-- Add more columns if needed -->
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center">No Subscribers found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- ./table -->
                </div>
                <!-- ./tab pane -->
            </div>
            <!-- ./content -->
        </div>
        <!-- ./end card -->
    </div>
    <!-- END #content -->
@endsection

@section('scripts')
    <!-- Include your scripts here -->
@endsection
