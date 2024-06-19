@extends('themes.theme1.layouts.app')

@section('customcss')
    <link rel="stylesheet" href="{{asset('theme1-assets/css/magnific-popup.css')}}">
    <style>
        .price {
            font-size: 24px;
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
                            <h4 class="before-dis">
                                <strong><span>{{ $currency }}</span>
                                    {{ number_format($product->variants->first()->price, 2) }}</strong>
                            </h4>
                            @if ($product->variants->first()->price_with_discount)
                                <h4 class="after-dis">
                                    <strong><span>{{ $currency }}</span>
                                        {{ number_format($product->variants->first()->price_with_discount, 2) }}</strong>
                                    {{-- <span class="discount">50%</span> --}}
                                </h4>
                            @endif
                        </div>
                        <!-- ./price -->

                        <!-- vat -->
                        {{-- <p class="vat">VAT included</p> --}}
                        <!-- ./vat -->

                    <!-- price -->
                    <div class="item-price">
                        <h4 class="before-dis">
                            <strong><span>{{ $currency }}</span> {{ number_format($product->variants->first()->price, 2) }}</strong>
                        </h4>
                        @if($product->variants->first()->price_with_discount)
                        <h4 class="after-dis">
                            <strong><span>{{ $currency }}</span> {{ number_format($product->variants->first()->price_with_discount, 2) }}</strong>
                             <span class="discount">50%</span>
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
                            <option value="10" selected>Variant 1 ($10 extra)</option>
                            <option value="20">Variant 2 ($20 extra)</option>
                        </select>
                    </div>


                    <!-- vat -->
                     <p class="vat">VAT included</p>
                    <!-- ./vat -->

                    <!-- item -->
                    <div class="price">Price: $<span id="base-price">100</span></div>


                    <div>
                        <h3>Total Price: $<span id="total-price">110</span></h3>
                    </div>
                    <!-- ./item -->

                    <!-- alert -->
                    <div class="alert alert-danger" role="alert">This item cannot be returned or replaced</div>
                    <!-- ./alert -->
                        <!-- button cart -->
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

@section('scripts')
    <script src="{{ asset('theme1-assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.zoom-gallery').magnificPopup({
                delegate: 'a',
                type: 'image',
                closeOnContentClick: false,
                closeBtnInside: false,
                tLoading: 'Loading image #%curr%...',
                mainClass: 'mfp-with-zoom mfp-img-mobil',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
                },
                image: {
                    tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                    titleSrc: function(item) {
                        return item.el.attr('title') + '<small>by Dar Alamirat</small>';
                    }
                },
                zoom: {
                    enabled: true,
                    duration: 300, // don't foget to change the duration also in CSS
                    opener: function(element) {
                        return element.find('img');
                    }
                }
            });
        });
    </script>
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            const basePrice = 100;
            const basePriceElement = document.getElementById('base-price');
            const totalPriceElement = document.getElementById('total-price');
            const quantityInput = document.getElementById('quantity');
            const increaseQuantityButton = document.getElementById('increase-quantity');
            const decreaseQuantityButton = document.getElementById('decrease-quantity');
            const variantSelect = document.getElementById('variant-select');

            function calculateTotalPrice() {
                const quantity = parseInt(quantityInput.value);
                const variantPrice = parseInt(variantSelect.value);
                const totalPrice = (basePrice * quantity) + variantPrice;
                totalPriceElement.innerText = totalPrice.toFixed(2);
            }

            increaseQuantityButton.addEventListener('click', function() {
                let quantity = parseInt(quantityInput.value);
                quantityInput.value = quantity + 1;
                calculateTotalPrice();
            });

            decreaseQuantityButton.addEventListener('click', function() {
                let quantity = parseInt(quantityInput.value);
                if (quantity > 1) {
                    quantityInput.value = quantity - 1;
                    calculateTotalPrice();
                }
            });

            variantSelect.addEventListener('change', calculateTotalPrice);

            calculateTotalPrice();
        });


    </script>
@endsection
