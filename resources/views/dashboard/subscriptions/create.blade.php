@extends('dashboard.layouts.app')

@section('meta')
    <meta charset="utf-8" />
    <title>Send Newsletter</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
@endsection

@section('customcss')
    <link href="{{ asset('admin-panel/assets/plugins/summernote/dist/summernote-lite.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <div class="d-flex align-items-center mb-3">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('dashboard.home') }}</a></li>
                    <li class="breadcrumb-item">Send newsletter</li>
                </ul>
                <h1 class="page-header mb-0">Send newsletter</h1>
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
                        {{-- <div class="mb-3">
                            <label for="newsEmailSender" class="form-label">Send From Email</label>
                            <input type="email" name="sender" class="form-control" placeholder="Email Sender">
                        </div> --}}
                        <div class="mb-3">
                            <label for="newsSubject" class="form-label">Subject</label>
                            <input type="text" name="subject" class="form-control" placeholder="Subject">
                        </div>
                        <div class="mb-3">
                            <label for="newsletterContent" class="form-label">Newsletter content</label>
                            <textarea class="summernote" id="newsletterContent" name="content" rows="6" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Send newsletter</button>
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
    <script src="{{ asset('admin-panel/assets/plugins/summernote/dist/summernote-lite.min.js') }}"></script>
    <script>
        $(".summernote").summernote({
            placeholder: 'Hi, this is summernote. Please, write text here! Super simple WYSIWYG editor on Bootstrap',
            height: "300"
        });
    </script>
@endsection
