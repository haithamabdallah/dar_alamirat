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
                <a href="{{ route('subscription.create') }}" class="btn btn-success btn-rounded px-4 rounded-pill"><i
                        class="fa fa-plus fa-lg me-2 ms-n2 text-success-900"></i>Send Newsletter </a>
            </div>
        </div>

        <!-- start card -->
        <div class="card border-0">
            <!-- content -->
            <div class="tab-content p-3">
                <!-- tab pane -->
                <div class="tab-pane fade show active" id="allTab">
                    <!-- BEGIN input-group -->
                    {{-- <div class="input-group mb-3">
                        <p class="btn btn-white dropdown-toggle"><span class="d-none d-md-inline">Filter By Product
                                Name</span></p>
                        <div class="flex-fill position-relative">
                            <div class="input-group">
                                <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 start-0"
                                    style="z-index: 1;">
                                    <i class="fa fa-search opacity-5"></i>
                                </div>
                                <input type="text" id="searchForProduct" onkeyup="searchProductName()"
                                    class="form-control px-35px bg-light" placeholder="Search order Number..." />
                            </div>
                        </div>
                    </div> --}}
                    <!-- END input-group -->

                    <!-- BEGIN table -->
                    <div class="row">
                        <table id="data-table-keytable" class="table table-striped table-bordered align-middle">
                            <thead>
                                <tr>
                                    <th width="1%"></th>
                                    <th class="text-nowrap" width="20%">Email</th>
                                    <th class="text-nowrap" width="20%">Status</th>
                                    <!-- Add more columns if needed -->
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($subscribers as $subscriber)
                                    <tr class="odd gradeX">
                                        <td width="1%" class="fw-bold text-dark">{{ $loop->iteration }}</td>
                                        <td>{{ $subscriber->email }}</td>
                                        <td>{{ $subscriber->status ? 'Active' : 'Inactive' }}</td>
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
                    <!-- pagination -->
                    {{-- @include('shared.dashboard.pagination' , ['paginated' => $subscribers]) --}}
                    <!-- ./pagination -->
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
