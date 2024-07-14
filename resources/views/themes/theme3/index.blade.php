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

    {{-- {!! $sliders !!} --}}
    @include('themes.theme1.index-layouts.home.full-banner')

    @include('themes.theme1.index-layouts.home.categories-and-banners')

    @include('themes.theme1.index-layouts.home.brands')

    @include('themes.theme1.index-layouts.home.features')

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
            // Newsletter Popup Logic
            const newsletterPopup = document.getElementById('newsletterPopup');
            const newsletterForm = document.getElementById('newsletter-form');
            const subscriptionDiv = document.getElementById('subscription');
            const newsSuccessDiv = document.getElementById('NewsSuccess');
            const newsletterCloseButtons = newsletterPopup.querySelectorAll('.closeNews');

            // Check if the user has already subscribed
            if (!localStorage.getItem('subscribed')) {
                setTimeout(() => {
                    newsletterPopup.classList.remove('hide');
                }, 2000);
            }

            newsletterForm.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                // Simulate form submission
                fetch(newsletterForm.action, {
                    method: newsletterForm.method,
                    body: new FormData(newsletterForm),
                }).then(response => {
                    if (response.ok) {
                        newsSuccessDiv.classList.remove('hide');
                        subscriptionDiv.classList.add('hide');
                        localStorage.setItem('subscribed', 'true'); // Store subscription status
                        setTimeout(() => {
                            newsletterPopup.classList.add('hide');
                        }, 3000); // Hide popup after 3 seconds
                    } else {
                        alert('Subscription failed. Please try again.');
                    }
                }).catch(error => {
                    console.error('Error:', error);
                });
            });

            newsletterCloseButtons.forEach(closeButton => {
                closeButton.addEventListener('click', function() {
                    newsletterPopup.classList.add('hide');
                });
            });

            // Cookies Popup Logic
            const cookiesPopup = document.getElementById('cookiesPopup');
            const cookiesCloseButtons = cookiesPopup.querySelectorAll('.closeNews');

            // Check if the user has already made a cookies choice
            if (!localStorage.getItem('cookiesChoice')) {
                setTimeout(() => {
                    cookiesPopup.classList.remove('hide');
                }, 4000);
            }

            cookiesCloseButtons.forEach(closeButton => {
                closeButton.addEventListener('click', function() {
                    const isAccept = this.classList.contains('accept-btn');
                    const isReject = this.classList.contains('reject-btn');

                    if (isAccept) {
                        localStorage.setItem('cookiesChoice', 'accepted');
                        // Implement further logic for accepting cookies
                    } else if (isReject) {
                        localStorage.setItem('cookiesChoice', 'rejected');
                        // Implement further logic for rejecting cookies
                    }

                    cookiesPopup.classList.add('hide'); // Add class "hide" to the popup element
                });
            });
        });
    </script>
@endsection
