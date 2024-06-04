@extends('themes.theme1.layouts.app')

@section('customcss')
    <link rel="stylesheet" href="{{ asset('theme1-assets/css/intlTelInput.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme1-assets/css/faltpicker.min.css') }}">
@endsection

@section('crumbs')
    <!-- breadcrumbs -->
    <section class="category-crumb">
        <!-- container-->
        <div class="pixel-container">
            <!-- row -->
            <div class="wrap">
                <!-- content -->
                <ul class="breadcrumbs">
                    <li>
                        <a href="{{route('index')}}">
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <span> Wish List</span>
                    </li>
                </ul>
                <!-- ./content -->
            </div>
            <!-- ./row -->
        </div>
        <!-- ./container-->
    </section>
    <!-- breadcrumbs -->
@endsection

@section('content')

    <!-- user-layout -->
    <section class="user-page-layout">
        <div class="pixel-container">
            <div class="wrap">
                <div class="user-layout">
                    @include('themes.theme1.profile.profile_aside')
                    <main>
                        <h1>Wishlist</h1>
                        <div class="whishlist_items">
                            @foreach($favorites as $product)
                                @include('themes.theme1.partials.item')
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
