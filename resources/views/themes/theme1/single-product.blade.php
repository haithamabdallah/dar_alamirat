@extends('themes.theme1.layouts.app')

@section('customcss')
    <link rel="stylesheet" href="{{asset('theme1-assets/css/magnific-popup.css')}}">
    <style>
        .price , #base-price , #total-price {
            font-size: 24px !important;
        }
        .price  {
            color: green;
        }
    </style>
@endsection

@section('content')
    <!-- Product Page -->
    <section id="product_page">
        <!-- container -->
        <div class="pixel-container">
            <!-- row -->
            <div class="wrap">
                <!-- content -->
                <div class="product_page s-block">
                    <!-- Product Details -->
                    <main>
                        <!-- brand -->
                        <div class="item_brand">
                            <!-- img -->
                            <div class="brand_img">
                                <img class="" src="{{ storage_asset($product->brand->image) }}"
                                    alt="{{ $product->brand->name }}">
                            </div>
                            <!-- ./img -->
                            <!-- data -->
                            <div class="brand_data">
                                {{-- <p class="status">100 Original</p> --}}
                                <a href="{{ route('brand', $product->brand->id) }}">Click here fo more of
                                    <strong>{{ $product->brand->name }}</strong></a>
                            </div>
                            <!-- ./data -->
                        </div>
                        <!-- ./brand -->

                        <!-- product info -->
                        <h2 class="product_info">{{ $product->title }}</h2>
                        <!-- ./product info -->

                        <!-- product info -->
                        <div class="product_description">
                            <p>{!! $product->description !!}</p>
                        </div>
                        <!-- ./product info -->


                    <!-- price -->
                    <div class="item-price">
                        @if($product->discount_value > 0 && $product->variants->first()->price_with_discount)
                            <h4 class="before-dis">
                                <strong><span>{{ $currency }}</span> {{ number_format($product->variants->first()->price, 2) }}</strong>
                            </h4>
                            <h4 class="after-dis">
                                <strong><span>{{ $currency }}</span> {{ number_format($product->variants->first()->price_with_discount, 2) }}</strong>
                                @if( $product->discount_type == 'flat'  )
                                <span class="discount">- {{ $product->discount_value }} {{ $currency }}</span>
                                @elseif($product->discount_type == 'percent')
                                <span class="discount">- {{ $product->discount_value }}%</span>
                                @endif
                            </h4>
                        @else
                            <h4 class="after-dis">
                                <strong><span>{{ $currency }}</span> {{ number_format($product->variants->first()->price, 2) }}</strong>
                            </h4>
                        @endif
                    </div>
                    <!-- ./price -->

                    <div class="quantity-controls">
                        <button id="decrease-quantity">-</button>
                        <input type="number" id="quantity" class="quantity" value="1" min="1" readonly>
                        <button id="increase-quantity">+</button>
                    </div>

                    <div class="variants">
                        <h4>Variants</h4>
                        <select id="variant-select" class="form-control">
                            @foreach ($product->variants as $variant)
                                <option value="{{$variant->id}}">  Name  : ( {{ $variant->variantName }} ) #####  SKU : <span > ( {{ $variant->sku }} ) </span> </option>
                            @endforeach
                        </select>
                    </div>


                    <!-- vat -->
                     <p class="vat">VAT included</p>
                    <!-- ./vat -->

                    <!-- item -->
                    <div class="price">Price: <span id="base-price"> {{ $product->variants->first()->price_with_discount }}</span> {{ $currency }} </div>


                    <div>
                        <h3>Total Price: <span id="total-price"> {{ $product->variants->first()->price_with_discount }} </span> {{ $currency }} </h3>
                    </div>
                    <!-- ./item -->

                    <!-- alert -->
                    <div class="alert alert-danger" role="alert">This item cannot be returned or replaced</div>
                    <!-- ./alert -->
                        <!-- button cart -->
                        <button class="tocart add-to-cart button--submit" data-title="Add to Cart" data-variant-id="{{ $product->variants->first()->id }}" data-cart-url="{{route('cart.add', $product->id)}}" onclick="addToCart(this , {{ $product->variants->first()->id }})">
                            <span class="button-title">Add to Cart</span>
                            <i class="sicon-shopping button-icon icon-tocart" data-icon="tocart"></i>
                        </button>
                        {{-- 
                        <button class="tocart add-to-cart button--submit" data-title="Add to Cart" onclick="addToCart(this)" data-cart-url="{{route('cart.add', $product->id)}}">
                            <span class="button-title"></span>
                            <i class="sicon-shopping button-icon icon-tocart" data-icon="tocart"></i>

                            <span class="button-icon icon-wait" data-icon="tocart" style="display: none;">
                                <svg width="24" height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M19,8L15,12H18A6,6 0 0,1 12,18C11,18 10.03,17.75 9.2,17.3L7.74,18.76C8.97,19.54 10.43,20 12,20A8,8 0 0,0 20,12H23M6,12A6,6 0 0,1 12,6C13,6 13.97,6.25 14.8,6.7L16.26,5.24C15.03,4.46 13.57,4 12,4A8,8 0 0,0 4,12H1L5,16L9,12">
                                    </path>
                                </svg>
                            </span>

                            <span class="button-icon icon-success" style="display: none;" data-icon="tocart">
                                <svg width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M21,7L9,19L3.5,13.5L4.91,12.09L9,16.17L19.59,5.59L21,7Z"></path>
                                </svg>
                            </span>

                        </button>
                        --}}
                        <!-- ./button cart -->

                    </main>
                    <!-- ./product Details -->

                    <!-- product Images -->
                    <aside>
                        <div class="sticky-top">
                            <div class="p-slider">
                                <div class="swiper p-full-image zoom-gallery">
                                    <div class="swiper-wrapper">
                                        <li class="swiper-slide">
                                            <a href="{{ $product->thumbnail }}" title="{{ $product->slug }}">
                                                <img src="{{ $product->thumbnail }}" alt="{{ $product->slug }}">
                                            </a>
                                        </li>
                                        @if (count($product->media) > 0)
                                            @foreach ($product->media as $image)
                                                <li class="swiper-slide">
                                                    <a href="{{ $image->file }}"
                                                        title="{{ $product->slug . $image->id }}">
                                                        <img src="{{ $image->file }}"
                                                            alt="{{ $product->slug . $image->id }}">
                                                    </a>
                                                </li>
                                            @endforeach
                                        @endif
                                        @if (count($product->variants->first()->images) > 0)
                                            @foreach ($product->variants->first()->images as $image)
                                                <li class="swiper-slide">
                                                    <a href="{{ $image->image }}"
                                                        title="{{ $product->slug . $image->id }}">
                                                        <img src="{{ $image->image }}"
                                                            alt="{{ $product->slug . $image->id }}">
                                                    </a>
                                                </li>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="p-prev"><i class="fa-solid fa-chevron-left"></i></div>
                                    <div class="p-next"><i class="fa-solid fa-chevron-right"></i></div>
                                </div>
                                <div thumbsSlider="" class="swiper p-thumb">
                                    <div class="swiper-wrapper">
                                        <li class="swiper-slide">
                                            <img src="{{ $product->thumbnail }}" />
                                        </li>
                                        @if (count($product->media) > 0)
                                            @foreach ($product->media as $image)
                                                <li class="swiper-slide">
                                                    <img src="{{ $image->file }}" />
                                                </li>
                                            @endforeach
                                        @endif
                                        @if (count($product->variants->first()->images) > 0)
                                            @foreach ($product->variants->first()->images as $image)
                                                <li class="swiper-slide">
                                                    <img src="{{ $image->image }}" />
                                                </li>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>
                    <!-- ./product Images -->
                </div>
                <!-- ./content -->
            </div>
            <!-- ./row -->

            <!-- row -->
            <div class="wrap">
                <!-- Full Descriptions -->
                <div class="s-block product_tabs">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                data-bs-target="#description" type="button" role="tab" aria-controls="description"
                                aria-selected="true">description</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="use-tab" data-bs-toggle="tab" data-bs-target="#use"
                                type="button" role="tab" aria-controls="use" aria-selected="false">How to use</button>
                        </li>
                        {{-- <li class="nav-item" role="presentation">
                        <button class="nav-link" id="specifications-tab" data-bs-toggle="tab" data-bs-target="#specifications" type="button" role="tab" aria-controls="specifications" aria-selected="false">specifications</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">(4573) reviews</button>
                    </li> --}}
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="description" role="tabpanel" aria-labelledby="description-tab"
                            tabindex="0">{!! $product->description !!}</div>
                        <div class="tab-pane" id="use" role="tabpanel" aria-labelledby="use-tab" tabindex="0">use
                        </div>
                        {{-- <div class="tab-pane" id="specifications" role="tabpanel" aria-labelledby="specifications-tab" tabindex="0">specifications</div>
                    <div class="tab-pane" id="reviews" role="tabpanel" aria-labelledby="reviews-tab" tabindex="0">reviews</div> --}}
                    </div>
                </div>
                <!-- ./Full Descriptions -->
            </div>
            <!-- ./row -->
        </div>
        <!-- ./container -->
    </section>
    <!-- ./Product Page -->
@endsection

@push('scripts')
    @include('themes.theme1.single-product-scripts')
@endpush

