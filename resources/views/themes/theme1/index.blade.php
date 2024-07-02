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


    @include('themes.theme1.index-layouts.home.full-banner')

    @include('themes.theme1.index-layouts.home.categories-and-banners')

    @include('themes.theme1.index-layouts.home.brands')

    @include('themes.theme1.partials.newsletters')

    @include('themes.theme1.partials.cookies')


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
