@extends('themes.theme1.layouts.app')

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
                        <a>
                            @if (isset($query) && !empty($query))
                                <span>   {{ __('Search For') }} <span> ({{ $query }})</span></span>
                            @else
                                <span> {{ __('Search For') }} <span> ( {{ __('All Products') }} )</span></span>
                            @endif
                        </a>
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
    <section class="category-page">
        <div class="pixel-container">
            <div class="wrap">
                <div class="content-page">
                    <main class="products-container" style="width: 70vw !important ; margin: 0 auto" >
                        @if ($products->count() > 0)
                            <div class="main products-container">
                                @foreach ($products as $product)
                                    <!-- product item -->
                                    @include('themes.theme1.partials.item')
                                    <!-- product item -->
                                @endforeach
                            </div>
                            @if ($products->lastPage() > 1)
                                @include('themes.theme1.partials.pagination' , ['items' => $products])
                            @endif
                        @else
                            <!-- no content -->
                            <section id="full-layout">
                                <div class="pixel-container">
                                    <!-- row -->
                                    <div class="wrap">
                                        <!-- content -->
                                        <div class="main-content">
                                            <div class="no-content-placeholder">
                                                {{-- <i class="sicon-shopping-bag icon"></i> --}}
                                                <p class="text-center my-5" style="font-size: 2rem">{{ __('No Products') }}</p>
                                                {{-- <a href="{{ route('index') }}"
                                                    class="btn btn--outline-primary">{{ __('Home Page') }}</a> --}}
                                            </div>
                                        </div>
                                        <!-- .content -->
                                    </div>
                                    <!-- ./row -->
                                </div>
                            </section>
                            <!-- no content -->
                        @endif
                    </main>
                </div>
            </div>
        </div>
    </section>
@endsection
