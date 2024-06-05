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
                        <!-- swiper #01 -->
                        <div class="section-categories">

                            <div class="swiper category">
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
                                <div class="swiper-wrapper">

                                    @foreach ($category->products as $product)
                                        <!-- product item -->
                                        <div class="swiper-slide">
                                            @include('themes.theme1.partials.item')
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
                        <a href="{{route('brands.index')}}" class="">View All</a>
                    </div>
                    <div class="s-brands-list">
                        @foreach ($brands as $brand)
                            <a href="{{ route('brand', $brand->id) }}" class="brand-item">
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
    {{-- @section('scripts')
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
    @endsection --}}
@endsection

@section('scripts')
    <script>
        document.querySelectorAll(".category").forEach(function (s) {
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
@endsection
