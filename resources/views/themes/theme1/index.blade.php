@extends('themes.theme1.layouts.app')

@section('content')
    {{--    @include('themes.theme1.index-layouts.categoryTabs') --}}
    @if (Session::has('success_message'))
        <div class="alert alert-success">
            {{ Session::get('success_message') }}
        </div>
    @endif

    @php
        $bannerSettings = $settings->where('type', 'general')->first();
    @endphp

    <!-- categories & Banners -->
    @if (   isset($bannerSettings->value['main_banner']) &&   isset($bannerSettings->value['main_banner_status']) && $bannerSettings->value['main_banner_status'] )
        <img class="w-full object-cover mb-2" src="{{ storage_asset($bannerSettings->value['main_banner']) }}"
        alt="baaner image">
    @endif

    @foreach ($priorityables as $priorityable)
        @if ($priorityable->type === 'Banner')
        @php $banner = $priorityable->priorityable; @endphp
            <!-- full banner -->
            <section class="banner-block">
                <!-- container -->

                <div class=" {{ ($loop->index == 0 &&  !$bannerSettings->value['main_banner_status']) ? '' : 'pixel-container'}}">
                    <!-- row -->
                    <div class="wrap">
                        <a href="{{ $banner->type == 'Category'
                        ? route('category.products', $banner->bannerable_id)
                        :  route('brand',  $banner->bannerable_id)
                        }}" class="" aria-label="Banner">
                            <img class="w-full object-cover" src="{{ storage_asset($banner->image) }}"
                                alt="baaner image">
                        </a>
                    </div>
                    <!-- ./row -->
                </div>
                <!-- ./container -->
            </section>
            <!-- ./full banner -->
        @endif

        @if ($priorityable->type === 'Category' && $priorityable->priorityable->products->count() > 0)
        {{-- @if ($priorityable->type === 'Category') --}}
            @php $category = $priorityable->priorityable; @endphp
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
                                        <a href="{{ route('category.products', $category->id) }}" class="btn-all">View
                                            All</a>
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
        @endif
    @endforeach
    <!-- ./categories & Banners -->

    <!-- Brands -->
    <section class="s-block">
        <div class="pixel-container">
            <div class="wrap">
                <div class="section-brands">
                    <div class="s-block-title">
                        <h2>Browse All Brands</h2>
                        <a href="{{ route('brands.index') }}" class="">View All</a>
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
    <!-- ./Brands -->

    @include('themes.theme1.partials.newsletters')

    @include('themes.theme1.partials.cookies')

    {{--  --}}
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
        document.querySelectorAll(".category").forEach(function(s) {
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const newsletterPopup = document.getElementById('newsletterPopup');
            const form = document.getElementById('newsletter-form');
            const subscribeDiv = document.getElementById('subscription');
            const successDiv = document.getElementById('NewsSuccess');
            const closeButtons = document.querySelectorAll('.closeNews');
            const popup = document.getElementById("newsletterPopup");

            // Check if the user has already subscribed
            if (!localStorage.getItem('subscribed')) {
                setTimeout(() => {
                    newsletterPopup.classList.remove('hide');
                }, 2000);
            }

            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                // Simulate form submission
                fetch(form.action, {
                    method: form.method,
                    body: new FormData(form),
                }).then(response => {
                    if (response.ok) {
                        successDiv.classList.remove('hide');
                        subscribeDiv.classList.add('hide');
                        localStorage.setItem('subscribed', 'true'); // Store subscription status
                        setTimeout(() => {
                            popup.classList.add('hide');
                        }, 3000); // Hide popup after 3 seconds
                    } else {
                        alert('Subscription failed. Please try again.');
                    }
                }).catch(error => {
                    console.error('Error:', error);
                });
            });

            closeButtons.forEach(closeButton => {
                closeButton.addEventListener('click', function() {
                    popup.classList.add('hide');
                });
            });
        });
    </script>

    <script>

        const newsletterPopup = document.getElementById('cookiesPopup');

        setTimeout(() => {
            newsletterPopup.classList.remove('hide');
        }, 2000);

        const closeButtons = document.querySelectorAll('.closeNews'); // Select all elements with class "closeNews"
        const popup = document.getElementById("cookiesPopup");

        closeButtons.forEach(closeButton => {
            closeButton.addEventListener('click', function() {
                popup.classList.add('hide'); // Add class "hide" to the popup element
            });
        });

    </script>
@endsection
