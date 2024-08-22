@extends('themes.theme1.layouts.app')

@section('content')
    <!-- single brand -->
    <section class="category-page single_brand">
        <!-- container -->
        <div class="pixel-container">
            <!-- row -->
            <div class="wrap">
                <!-- header -->
                <section class="s-block">
                    <!-- brand data -->

                    <div class="brand_data">
                        <!-- img -->
                        <div class="brand_img">
                            <img class="brand-item w-full object-contain" src="{{ storage_asset($brand->image) }}"
                                alt="{{ $brand->name }}">
                        </div>
                        <!-- ./img -->
                        <!-- title -->
                        <div class="brand_title">
                            <h1>{{ $brand->name }}</h1>
                            {{-- <p>For a bolder and more attractive look</p> --}}
                        </div>
                        <!-- ./title -->
                    </div>
                    <!-- ./brand data -->
                </section>
                <!-- ./header -->
                @if (count($brand->products) > 0)
                    <!-- header -->
                    <section class="s-block">
                        <!-- brand product items -->
                        <div class="brand_products">
                            @foreach ($brand->products as $product)
                                @include('themes.theme1.partials.item')
                            @endforeach
                        </div>
                        <!-- ./brand product items -->
                        @if ($products->lastPage() > 1)
                            @include('themes.theme1.partials.pagination' , ['items' => $products])
                        @endif
                    </section>
                    <!-- ./header -->
                @else
                    <!-- no content -->
                    <section id="full-layout" style="margin: 1rem auto ; text-align: center">
                        <div class="pixel-container">
                            <!-- row -->
                            <div class="wrap">
                                <!-- content -->
                                <main>
                                    <div class="main-content">
                                        <div class="no-content-placeholder">
                                            {{-- <i class="sicon-shopping-bag icon"></i> --}}
                                            <p style="font-size: 3rem">{{ __('No Products') }}</p>
                                            {{-- <a href="{{ route('index') }}"
                                                class="btn btn--outline-primary">{{ __('Home Page') }}</a> --}}
                                        </div>
                                    </div>
                                </main>

                                <!-- .content -->
                            </div>
                            <!-- ./row -->
                        </div>
                    </section>
                    <!-- no content -->
                @endif

            </div>
            <!-- ./row -->
        </div>
        <!-- ./container -->
    </section>
    <!-- ./single brand -->
@endsection
