@extends('themes.theme2.layouts.app')

@section('customcss')
    <link rel="stylesheet" href="{{ asset('theme1-assets/css/intlTelInput.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme1-assets/css/faltpicker.min.css') }}">
@endsection

@section('crumbs')
    <section class="user-cover">
        <div class="pixel-container">
            <div class="wrap">
                <div class="cover-contents">
                    <!-- breadcrumbs container-->
                    <div class="pixel-container">
                        <!-- row -->
                        <div class="wrap">
                            <!-- content -->

                            <ul class="breadcrumbs">
                                <li>
                                    <a href="{{ route('index') }}">
                                        <span>{{ __("Home") }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <span>{{ __("Wishlist") }}</span>
                                    </a>
                                </li>

                            </ul>
                            <!-- ./content -->
                        </div>
                        <!-- ./row -->
                    </div>
                    <!-- ./breadcrumbs container-->
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')

    <!-- user-layout -->
    <section class="user-page-layout">
        <div class="pixel-container">
            <div class="wrap">
                <div class="user-layout">
                    @include('themes.theme2.profile.profile_aside')
                    <main>
                        <h1>{{ __("Wishlist") }}</h1>
                        <div class="whishlist_items">
                            @foreach($favorites as $product)
                                @include('themes.theme2.partials.item')
                            @endforeach
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')

@endsection
