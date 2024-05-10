@extends('themes.theme1.layouts.app')

@section('crumbs')
    <!-- breadcrumbs container-->
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
                    <span>Cart</span>
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
                            <p>Empty Cart</p>
                            <a href="{{route('index')}}" class="btn btn--outline-primary">Back home</a>
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
