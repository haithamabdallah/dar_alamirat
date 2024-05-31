@extends('themes.theme1.layouts.app')

@section('content')
    {{--    @include('themes.theme1.index-layouts.categoryTabs') --}}
    @if (Session::has('success_message'))
        <div class="alert alert-success">
            {{ Session::get('success_message') }}
        </div>
    @endif

    @foreach ($categories as $category)
        @if ($category->type === 'default')
            <section class="s-block">
                <div class="pixel-container">
                    <div class="wrap">
                        <div class="section-categories">

                            <div class="section-head">
                                <div class="s-block-title">
                                    <h2>{{ $category->name }}</h2>
                                </div>

                                <div class="category-nav">
                                    <a href="{{ route('category.products', $category->id) }}" class="btn-all">View All</a>
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

                            <div class="swiper categories">
                                <div class="swiper-wrapper">
                                    @foreach ($category->products as $product)
                                        <!-- product item -->
                                        <div class="item">
                                            <!-- tags -->
                                            <div class="item-tags">
                                                <span>most popular</span>
                                            </div>
                                            <!-- ./tags -->
                                            <!-- img -->
                                            <div class="img">
                                                <a href="{{ route('product', $product->id) }}">
                                                    <img class="w-full object-contain" src="{{ $product->thumbnail }}"
                                                        alt="Product Image">
                                                </a>
                                            </div>
                                            <!-- img -->

                                            <!-- data -->
                                            <div class="item-data">
                                                <!-- price -->
                                                <div class="item-price">
                                                    @if ($product->discount_value > 0)
                                                        <h4 class="before-dis">
                                                            <strong>{{ $product->variants->first()->price }}</strong>
                                                            <span>SAR</span>
                                                        </h4>
                                                    @endif
                                                    <h4 class="after-dis">
                                                        <strong>{{ $product->variants->first()->price_with_discount }}</strong>
                                                        <span>SAR</span>
                                                    </h4>
                                                    <div class="add-favourite">
                                                        <button class="icon-fav">
                                                            <i class="sicon-heart"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- ./price -->

                                                <!-- description -->
                                                <div class="item-dec">
                                                    <a href="{{ route('product', $product->id) }}">
                                                        <span>{!! Str::limit($product->title, 100) !!}</span>
                                                    </a>
                                                </div>
                                                <!-- ./description -->

                                                <!-- button cart -->
                                                <button class="tocart add-to-cart button--submit" data-title="Add to Cart">
                                                    <span class="button-title"></span>
                                                    <i class="sicon-shopping button-icon icon-tocart"
                                                        data-icon="tocart"></i>

                                                    <span class="button-icon icon-wait" data-icon="tocart"
                                                        style="display: none;">
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <path
                                                                d="M19,8L15,12H18A6,6 0 0,1 12,18C11,18 10.03,17.75 9.2,17.3L7.74,18.76C8.97,19.54 10.43,20 12,20A8,8 0 0,0 20,12H23M6,12A6,6 0 0,1 12,6C13,6 13.97,6.25 14.8,6.7L16.26,5.24C15.03,4.46 13.57,4 12,4A8,8 0 0,0 4,12H1L5,16L9,12">
                                                            </path>
                                                        </svg>
                                                    </span>

                                                    <span class="button-icon icon-success" style="display: none;"
                                                        data-icon="tocart">
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <path
                                                                d="M21,7L9,19L3.5,13.5L4.91,12.09L9,16.17L19.59,5.59L21,7Z">
                                                            </path>
                                                        </svg>
                                                    </span>

                                                </button>
                                                <!-- ./button cart -->

                                            </div>
                                            <!-- ./data -->
                                        </div>
                                        <!-- product item -->
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @else
            @foreach ($category->banners as $image)
                <!-- full banner -->
                <section class="banner-block">
                    <!-- container -->
                    <div class="pixel-container">
                        <!-- row -->
                        <div class="wrap">
                            <a href="#" class="" aria-label="Banner">
                                <img class="w-full object-cover" src="{{ storage_asset($image->image) }}"
                                    alt="baaner image">
                            </a>
                        </div>
                        <!-- ./row -->
                    </div>
                    <!-- ./container -->
                </section>
                <!-- ./full banner -->
            @endforeach
        @endif
    @endforeach

    <section class="s-block">
        <div class="pixel-container">
            <div class="wrap">
                <div class="section-brands">
                    <div class="s-block-title">
                        <h2>Browse All Brands</h2>
                        <a href="#" class="">View All</a>
                    </div>
                    <div class="s-brands-list">
                        @foreach ($brands as $brand)
                            <a href="{{ route('brand', $brand->id) }}" class="brand-image">
                                <img class="" src="{{ storage_asset($brand->image) }}" alt="{{ $brand->name }}">
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

     {{-- <section id="newsletterPopup" class="hide">
    <div class="newContent">
        <a href="javascript:;" class="closeNews close-btn"><i class="fa-solid fa-xmark"></i></a>
        <div class="newsImage">
            <img src="{{ asset('assets/images/newsletter/newsletter.jpg') }}" alt="">
        </div>
        <div id="subscription">
            <h3>Sign Up For</h3>
            <h1>25% OFF</h1>
            <p>Subscribe to our newsletter for exclusive beauty tips, new product launches, and special offers.</p>
            <form id="newsletter-form" action="{{ route('subscribe') }}" method="POST">
                @csrf
                <input type="email" name="email" placeholder="Enter your email address" required>
                <button type="submit">Subscribe Now</button>
            </form>
            <a class="closeNews" href="javascript:;">No, thanks</a>
            <p>By entering, you aagree to the <a href="#">Terms od Use</a> and <a href="#">Privacy policy</a></p>
        </div>
     </div>
</section> --}}
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('message'))
                showSweetAlert("{{ session('title') }}", "{{ session('message') }}", "{{ session('icon') }}");
            @endif
        });

        function showSweetAlert(title, message, icon) {
            Swal.fire({
                title: title,
                text: message,
                icon: icon,
                timer: 5000, // Set the duration in milliseconds (5 seconds in this example)
                timerProgressBar: true,
                showConfirmButton: false
            });
        }
    </script>
@endsection
@endsection
