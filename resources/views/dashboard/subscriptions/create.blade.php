@extends('dashboard.layouts.app')

@section('meta')
    <meta charset="utf-8" />
    <title>{{ __('dashboard.send_newsletter') }}</title>
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
                    <li class="breadcrumb-item">{{ __('dashboard.send_newsletter') }}</li>
                </ul>
                <h1 class="page-header mb-0">{{ __('dashboard.send_newsletter') }}</h1>
            </div>
        </div>

        <!-- start card -->
        <div class="card border-0">
            <!-- content -->
            <div class="tab-content p-3">
                <!-- tab pane -->
                <div class="tab-pane fade show active" id="allTab">
                    <!-- newsletter form -->
                    <form action="{{ route('send-newsletter') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="newsletterContent" class="form-label">{{ __('dashboard.newsletter_content') }}</label>
                            <textarea class="form-control" id="newsletterContent" name="content" rows="6" required></textarea>
                        </div>
                        {{-- <div class="mb-3">
                            <label for="newsletterImage" class="form-label">{{ __('dashboard.newsletter_image') }}</label>
                            <input type="file" class="form-control" id="newsletterImage" name="image" accept="image/*" required>
                        </div> --}}
                        <button type="submit" class="btn btn-primary">{{ __('dashboard.send_newsletter') }}</button>
                    </form>

                    <!-- ./newsletter form -->
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
