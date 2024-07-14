@extends('themes.theme3.layouts.app')

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
                                    @include('themes.theme3.partials.item')
                                    <!-- product item -->
                                @endforeach
                            </div>
                            <div class="d-flex justify-content-center">
                                <nav>
                                    <ul class="pagination">
                                        
                                        @if ( $products->currentPage() == 1 )
                                            <li class="page-item disabled" aria-disabled="true" aria-label="« السابق"><span
                                                    class="page-link" aria-hidden="true"> 
                                                    ‹
                                                </span></li>
                                        @else
                                            <li class="page-item"><a class="page-link" href="#" rel="previous"
                                                aria-label="« السابق"> ‹ </a></li>
                                        @endif

                                        @foreach (range($products->currentPage(), $products->lastPage()) as $pageNum)
                                            @if ( $pageNum == $products->currentPage() )
                                                <li class="page-item active" aria-current="page"><span class="page-link">{{ $pageNum }}</span>
                                                </li>
                                            @else
                                                <li class="page-item"><a class="page-link" href="{{ $products->url($pageNum) }}">{{ $pageNum }}</a></li>
                                            @endif
                                        @endforeach

                                        @if ( $products->currentPage() == $products->lastPage() )
                                            <li class="page-item disabled" aria-disabled="true" aria-label="التالي »"><span
                                                    class="page-link" aria-hidden="true"> 
                                                    ›
                                                </span></li>
                                        @else
                                            <li class="page-item"><a class="page-link" href="{{ $products->nextPageUrl() }}" rel="next"
                                                aria-label="التالي »"> › </a></li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
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
