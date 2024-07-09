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
                            <img class="brand-item w-full object-contain" src="{{storage_asset($brand->image)}}" alt="{{ $brand->name }}">
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

                <!-- header -->
                <section class="s-block">
                    <!-- brand product items -->
                    <div class="brand_products">
                        @forelse ($brand->products as $product)
                            @include('themes.theme1.partials.item')

                        @empty
                            <p>{{ __("No products found for this brand.") }}</p>
                        @endforelse
                    </div>
                    <!-- ./brand product items -->
                    <div class="d-flex justify-content-center">
                        <nav>
                            <ul class="pagination">
                                <li class="page-item disabled" aria-disabled="true" aria-label="« السابق"><span class="page-link" aria-hidden="true">‹</span></li>
                                <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item"><a class="page-link" href="#" rel="next" aria-label="التالي »">›</a></li>
                            </ul>
                        </nav>
                    </div>
                </section>
                <!-- ./header -->

            </div>
            <!-- ./row -->
        </div>
        <!-- ./container -->
    </section>
    <!-- ./single brand -->

@endsection
