@extends('themes.theme2.layouts.app')

@section('crumbs')
    <!-- breadcrumbs container-->
    <div class="pixel-container">
        <!-- row -->
        <div class="wrap">
            <!-- content -->
            <ul class="breadcrumbs">
                <li>
                    <a href="{{route('index')}}">
                        <span>{{ __("Home") }}</span>
                    </a>
                </li>
                <li>
                    <span>{{ __("Cart") }}</span>
                </li>
            </ul>
            <!-- ./content -->
        </div>
        <!-- ./row -->
    </div>
    <!-- ./breadcrumbs container-->
@endsection

@section('content')

    <!-- no content -->
    <section id="full-layout">
        <div class="pixel-container">
            <!-- row -->
            <div class="wrap">
                <!-- content -->
                <main>
                    <div class="main-content">
                        <div class="no-content-placeholder">
                            <i class="sicon-shopping-bag icon"></i>
                            <p>{{ __("Empty Cart") }}</p>
                            <a href="{{route('index')}}" class="btn btn--outline-primary">{{ __("Home Page") }}</a>
                        </div>
                    </div>
                </main>

                <!-- .content -->
            </div>
            <!-- ./row -->
        </div>
    </section>
    <!-- no content -->
@endsection
