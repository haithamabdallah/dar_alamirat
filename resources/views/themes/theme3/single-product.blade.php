{{-- @php
    // dd($productsYouMayLike); // 10 products randomly that user may like
    dd($productVariantPrices); 
@endphp --}}

@extends('themes.theme3.layouts.app')

@section('customcss')
    <link rel="stylesheet" href="{{asset('theme1-assets/css/magnific-popup.css')}}">
    <style>
        .hidden {
            display: none;
        }

        #variant-form {
            display: flex;
            grid-gap: 10px;
            margin-bottom: 40px;
        }

        .variant-option input {
            display: none;
        }
        .variant-option label {
            display: flex;
            flex-direction: column;
            grid-gap: 5px;
            align-items: center;
            justify-content: center;
            padding: 10px 20px;
            border: 1px solid #eee;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .variant-option label:hover {
            border-color: #5E6FB4;
        }

        .variant-option input:checked + label {
            border: 1px solid #5E6FB4;
            color: #5E6FB4;
        }

        .variant-option label img {
            max-width: 50px; /* Adjust image size as needed */
            max-height: 50px; /* Adjust image size as needed */
            vertical-align: middle;
            margin-right: 10px; /* Adjust spacing between image and text */
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
                                <a href="{{ route('brand', $product->brand->id) }}">{{ __("Click here fo more of") }}
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

                        <!-- alert -->
                        @if (!$product->is_returnable)
                            <div class="alert alert-danger" role="alert">{{ __("This item cannot be returned or replaced") }}</div>
                        @endif
                        <!-- ./alert -->

                        <!-- TABS -->
                        <div class="wrap">
                            <!-- Full Descriptions -->
                            <div class="product_tabs">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs " id="myTab" role="tablist">
                                    <li class="nav-item flex-fill" role="specifications" @if ( $product->variants->count() == 1 ) style="display: none" @endif>
                                        <a class="nav-link {{  $product->variants->count() > 1 ? 'active' : '' }}" id="specifications-tab" data-bs-toggle="tab" data-bs-target="#specifications" type="button" role="tab" aria-controls="specifications" aria-selected="false">{{ __('Product Options') }}</a>
                                    </li>
                                    <li class="nav-item flex-fill" role="presentation">
                                        <a class="nav-link {{  $product->variants->count() == 1 ? 'active' : '' }}" id="description-tab" data-bs-toggle="tab"
                                                data-bs-target="#description" type="button" role="tab" aria-controls="description"
                                                aria-selected="true">{{ __("Description") }}</a>
                                    </li>
                                    <li class="nav-item flex-fill" role="presentation">
                                        <a class="nav-link" id="use-tab" data-bs-toggle="tab" data-bs-target="#use"
                                                type="button" role="tab" aria-controls="use" aria-selected="false">{{ __("How to use") }}</a>
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
                                    <div class="tab-pane {{  $product->variants->count() > 1 ? 'active' : '' }}" id="specifications" role="tabpanel" aria-labelledby="specifications-tab" tabindex="0"
                                        @if ( $product->variants->count() == 1 ) style="display: none" @endif >
                                        <form id="variant-form">
                                            @foreach ($product->variants as $index => $variant)
                                                <div class="variant-option">
                                                    <input type="radio" id="variant-{{ $variant->id }}" name="variant" value="{{ $variant->id }}" @if ($index === 0) checked @endif>
                                                    <label for="variant-{{ $variant->id }}">
                                                        @if ($variant->images->count() > 0)
                                                            <img src="{{ $variant->images[0]->image }}" alt=""> <!-- Replace with your actual image URL -->
                                                        @endif
                                                        <span>{{ $variant->variantName }}</span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </form>
                                    </div>
                                    <div class="tab-pane {{  $product->variants->count() == 1 ? 'active' : '' }}" id="description" role="tabpanel" aria-labelledby="description-tab" tabindex="0">{!! $product->description !!}</div>
                                    <div class="tab-pane" id="use" role="tabpanel" aria-labelledby="use-tab" tabindex="0"> {!! $product->instructions !!}</div>
                                    {{--
                                <div class="tab-pane" id="reviews" role="tabpanel" aria-labelledby="reviews-tab" tabindex="0">reviews</div> --}}
                                </div>
                            </div>
                            <!-- ./Full Descriptions -->
                        </div>
                        <!-- ./TABS -->

                        <!-- price -->
                        <div class="product-price in-mobile">
                            @if($product->discount_value > 0)
                                <div class="before-dis">
                                    <span class="base-price">{{ number_format($product->variants->first()->price, 2) }} {{ $currency }}</span>
                                </div>
                                <span class="no-dis total-price" id=""> {{ $product->variants->first()->price_with_discount }} {{ $currency }}</span>
                                <div class="after-dis" style="display: none">
                                    <span class="with-dis total-price" id="">{{ $product->variants->first()->price_with_discount }} {{ $currency }}</span>
                                </div>
                            @else
                                <div class="before-dis" style="display: none">
                                    <span class="base-price">{{ number_format($product->variants->first()->price, 2) }} {{ $currency }}</span>
                                </div>
                                <span class="no-dis total-price" id="" style="display: none"> {{ $product->variants->first()->price_with_discount }} {{ $currency }}</span>
                                <div class="after-dis">
                                    <span class="with-dis total-price" id="">{{ $product->variants->first()->price_with_discount }} {{ $currency }}</span>
                                </div>
                            @endif
                        </div>
                        <!-- ./price -->



                        <!-- SKU -->
                        <div class="wrap">
                            <div class="sku_number">
                                <div class="title">
                                    {{-- <i class="sicon-barcode text-primary text-base"></i> --}}
                                    <p>{{ __("SKU") }}</p>
                                </div>
                                @foreach ($product->variants as $variant)
                                    <p class="code_number hidden" data-variant-id="{{ $variant->id }}">{{ $variant->sku }}</p>
                                @endforeach
                            </div>
                        </div>
                        <!-- SKU -->

                        <!-- Sticky Card -->
                        <div class="sticky_card">
                            <div class="product_Properties">
                                <!-- quantity -->
                                <div class="quantity-controls">
                                    <button id="decrease-quantity">-</button>
                                    <input type="number" id="quantity" class="quantity" value="1" min="1" readonly>
                                    <button id="increase-quantity">+</button>
                                </div>
                                <!-- ./quantity -->

                                <!-- price -->
                                <div class="product-price">
                                    @if($product->discount_value > 0 && $product->variants->first()->price_with_discount)
                                        <div class="before-dis">
                                            <span class="base-price">{{ number_format($product->variants->first()->price, 2) }} {{ $currency }}</span>
                                        </div>
                                        <span class="no-dis total-price" id=""> {{ $product->variants->first()->price_with_discount }} {{ $currency }}</span>
                                        <div class="after-dis" style="display: none">
                                            <span class="with-dis total-price" id="">{{ $product->variants->first()->price_with_discount }} {{ $currency }}</span>
                                        </div>
                                    @else
                                        <div class="before-dis" style="display: none">
                                            <span class="base-price">{{ number_format($product->variants->first()->price, 2) }} {{ $currency }}</span>
                                        </div>
                                        <span class="no-dis total-price" id="" style="display: none"> {{ $product->variants->first()->price_with_discount }} {{ $currency }}</span>
                                        <div class="after-dis">
                                            <span class="with-dis total-price" id="">{{ $product->variants->first()->price_with_discount }} {{ $currency }}</span>
                                        </div>
                                    @endif
                                </div>
                                <!-- ./price -->

                                <!-- add to cart button -->
                                <button class="tocart add-to-cart button--submit" data-title="Add to Cart" data-variant-id="{{ $product->variants->first()->id }}" data-cart-url="{{ auth()->check() ?  route('cart.add', $product->id) : route('guest.cart.add', $product->id) }}" onclick="addToCart(this , {{ $product->variants->first()->id }})">
                                    <span class="button-title">{{ __("Add to Cart") }}</span>
                                    <i class="sicon-shopping button-icon icon-tocart" data-icon="tocart"></i>
                                </button>
                                <!-- ./add to cart button -->
                            </div>

                            <div class="small_product">
                                <div class="p-img">
                                    <img class="object-cover" src="{{ $product->thumbnail }}" alt="{{ $product->slug }}">
                                </div>
                                <div class="p-info">
                                    <a href="#" class="category">{{ $product->category->name  }}</a>
                                    <h3>{{ $product->title }}</h3>
                                </div>
                            </div>
                        </div>
                        <!-- Sticky Card -->



                    </main>
                    <!-- ./product Details -->

                    <!-- product Images -->
                    <aside>
                        <div class="sticky-top">

                            @if( $product->discount_type == 'flat'  && $product->discount_value > 0)
                                <span class="has-discount">- {{ $product->discount_value }} {{ $currency }}</span>
                            @elseif($product->discount_type == 'percent' && $product->discount_value > 0)
                                <span class="has-discount">- {{ $product->discount_value }}%</span>
                            @else
                                <span class="has-discount" style="display: none">- {{ $product->discount_value }}%</span>
                            @endif

                            <div class="p-slider">
                                <div class="swiper p-full-image zoom-gallery">
                                    <div class="swiper-wrapper">
                                        @foreach ($product->variants as $variant)
                                            @if (count($variant->images) > 0)
                                                @foreach ($variant->images as $index => $image)
                                                    <li class="swiper-slide" {{-- {!! $index != 0  ? 'style="display:none;"' :  '' !!} --}} data-variant-id="{{ $variant->id }}" >
                                                        <a href="{{ $image->image }}"
                                                            title="{{ $product->slug . $image->id }}">
                                                            <img src="{{ $image->image }}"
                                                                alt="{{ $product->slug . $image->id }}">
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @endif
                                        @endforeach
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

                                    </div>
                                    <div class="p-prev"><i class="fa-solid fa-chevron-left"></i></div>
                                    <div class="p-next"><i class="fa-solid fa-chevron-right"></i></div>
                                </div>
                                <div thumbsSlider="" class="swiper p-thumb">
                                    <div class="swiper-wrapper">
                                        @foreach ($product->variants as $variant)
                                            @if (count($variant->images) > 0)
                                                @foreach ($variant->images as $index => $image)
                                                    <li class="swiper-slide" {!! $index != 0  ? 'style="display:none;"' :  '' !!} data-variant-id="{{ $variant->id }}" >
                                                        <img src="{{ $image->image }}" />
                                                    </li>
                                                @endforeach
                                            @endif
                                        @endforeach
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

        </div>
        <!-- ./container -->
    </section>
    <!-- ./Product Page -->

    <section class="s-block">
        <div class="pixel-container">
            <div class="wrap">
                <!-- swiper #01 -->
                <div class="section-categories">
                    <div class="swiper mySwiper">

                        <div class="section-head">
                            <div class="s-block-title">
                                <h2>{{ __("You May Also Like") }}</h2>
                            </div>

                            <div class="category-nav">

                                <div class="navigation">
                                    <button class="cat-prev">
                                        <i class="fa-solid fa-chevron-left"></i>
                                    </button>
                                    <button class="cat-next">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-wrapper">

                            <!-- product item -->
                            @foreach ($productsYouMayLike as $product)
                                <div class="swiper-slide">
                                    @include('themes.theme3.partials.item' , ['product' => $product])
                                </div>
                            @endforeach
                            <!-- product item -->
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    @include('themes.theme3.single-product-scripts')

    <script>
        document.querySelectorAll(".mySwiper").forEach(function(s) {
            let next = s.querySelector(".cat-next");
            let prev = s.querySelector(".cat-prev");

            new Swiper(s, {
                navigation: {
                    nextEl: next,
                    prevEl: prev
                },
                slidesPerView: 4,
                spaceBetween: 20,
                slidesPerGroup: 1,
                autoplay: true , 
                breakpoints: {
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 20,
                    },
                    425: {
                        slidesPerView: 1,
                        spaceBetween: 20,
                    },
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 40,
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 50,
                    },
                    1200: {
                        slidesPerView: 4,
                        spaceBetween: 50,
                    },
                },
            });
        });
    </script>
@endpush

