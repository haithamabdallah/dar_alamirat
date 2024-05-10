@extends('themes.theme1.layouts.app')

@section('crumbs')
    <!-- breadcrumbs -->
    <section class="category-crumb">
        <!-- container-->
        <div class="pixel-container">
            <!-- row -->
            <div class="wrap">
                <!-- content -->
                <ul class="breadcrumbs">
                    <li>
                        <a href="{{route('index')}}">
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <span>Make-up</span>
                    </li>
                </ul>
                <!-- ./content -->
            </div>
            <!-- ./row -->
        </div>
        <!-- ./container-->
    </section>
    <!-- breadcrumbs -->
@endsection

@section('content')
    <section class="category-page">
        <div class="pixel-container">
            <div class="wrap">
                <div class="content-page">
                    <aside>
                        <div class="accordion" id="accCategories">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headCategory">
                                    <button class="accordion-button s-filters-widget-title" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#colCategory" aria-expanded="true"
                                            aria-controls="colCategory">
                                        Categories
                                    </button>
                                </h2>
                                <div id="colCategory" class="accordion-collapse collapse show"
                                     aria-labelledby="headCategory" data-bs-parent="#accCategories">
                                    <div class="accordion-body">
                                        <div class="s-filters-widget-values"><label class="s-filters-label"
                                                                                    for="brand_id-option-0"><input
                                                    id="brand_id-option-0" name="brand_id" type="radio"
                                                    class="s-filters-radio"><span
                                                    class="s-filters-option-name">Essence</span></label><label
                                                class="s-filters-label" for="brand_id-option-1"><input
                                                    id="brand_id-option-1" name="brand_id" type="radio"
                                                    class="s-filters-radio"><span class="s-filters-option-name">Rimmel London</span></label><label
                                                class="s-filters-label" for="brand_id-option-2"><input
                                                    id="brand_id-option-2" name="brand_id" type="radio"
                                                    class="s-filters-radio"><span class="s-filters-option-name">Real Techniques</span></label><label
                                                class="s-filters-label" for="brand_id-option-3"><input
                                                    id="brand_id-option-3" name="brand_id" type="radio"
                                                    class="s-filters-radio"><span class="s-filters-option-name">Maybelline</span></label><label
                                                class="s-filters-label" for="brand_id-option-4"><input
                                                    id="brand_id-option-4" name="brand_id" type="radio"
                                                    class="s-filters-radio"><span
                                                    class="s-filters-option-name">MAC</span></label><label
                                                class="s-filters-label" for="brand_id-option-5"><input
                                                    id="brand_id-option-5" name="brand_id" type="radio"
                                                    class="s-filters-radio"><span class="s-filters-option-name">MAKE UP FOR EVER</span></label><label
                                                class="s-filters-label" for="brand_id-option-6"><input
                                                    id="brand_id-option-6" name="brand_id" type="radio"
                                                    class="s-filters-radio"><span
                                                    class="s-filters-option-name">Vaseline</span></label><label
                                                class="s-filters-label" for="brand_id-option-7"><input
                                                    id="brand_id-option-7" name="brand_id" type="radio"
                                                    class="s-filters-radio"><span class="s-filters-option-name">cotton plus</span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="accordion" id="accBrands">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headBrands">
                                    <button class="accordion-button s-filters-widget-title" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#colBrands" aria-expanded="false"
                                            aria-controls="colBrands">
                                        brands
                                    </button>
                                </h2>
                                <div id="colBrands" class="accordion-collapse collapse show"
                                     aria-labelledby="headBrands" data-bs-parent="#accBrands">
                                    <div class="accordion-body">
                                        <div class="s-filters-widget-values"><label class="s-filters-label"
                                                                                    for="brand_id-option-0"><input
                                                    id="brand_id-option-0" name="brand_id" type="radio"
                                                    class="s-filters-radio"><span
                                                    class="s-filters-option-name">Essence</span></label><label
                                                class="s-filters-label" for="brand_id-option-1"><input
                                                    id="brand_id-option-1" name="brand_id" type="radio"
                                                    class="s-filters-radio"><span class="s-filters-option-name">Revolution</span></label><label
                                                class="s-filters-label" for="brand_id-option-2"><input
                                                    id="brand_id-option-2" name="brand_id" type="radio"
                                                    class="s-filters-radio"><span class="s-filters-option-name">Golden Rose</span></label><label
                                                class="s-filters-label" for="brand_id-option-3"><input
                                                    id="brand_id-option-3" name="brand_id" type="radio"
                                                    class="s-filters-radio"><span class="s-filters-option-name">Red Cherry</span></label><label
                                                class="s-filters-label" for="brand_id-option-4"><input
                                                    id="brand_id-option-4" name="brand_id" type="radio"
                                                    class="s-filters-radio"><span class="s-filters-option-name">Forever52</span></label><label
                                                class="s-filters-label" for="brand_id-option-5"><input
                                                    id="brand_id-option-5" name="brand_id" type="radio"
                                                    class="s-filters-radio"><span class="s-filters-option-name">Christine</span></label><label
                                                class="s-filters-label" for="brand_id-option-6"><input
                                                    id="brand_id-option-6" name="brand_id" type="radio"
                                                    class="s-filters-radio"><span class="s-filters-option-name">Maybelline</span></label><label
                                                class="s-filters-label" for="brand_id-option-7"><input
                                                    id="brand_id-option-7" name="brand_id" type="radio"
                                                    class="s-filters-radio"><span
                                                    class="s-filters-option-name">Flormar</span></label><label
                                                class="s-filters-label" for="brand_id-option-8"><input
                                                    id="brand_id-option-8" name="brand_id" type="radio"
                                                    class="s-filters-radio"><span class="s-filters-option-name">NYX PROFESSIONAL MAKEUP</span></label><label
                                                class="s-filters-label" for="brand_id-option-9"><input
                                                    id="brand_id-option-9" name="brand_id" type="radio"
                                                    class="s-filters-radio"><span class="s-filters-option-name">Beauty Belle</span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion" id="accRating">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headRating">
                                    <button class="accordion-button s-filters-widget-title" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#colRating" aria-expanded="false"
                                            aria-controls="collapseThree">
                                        Rating
                                    </button>
                                </h2>
                                <div id="colRating" class="accordion-collapse collapse show"
                                     aria-labelledby="headRating" data-bs-parent="#accRating">
                                    <div class="accordion-body">
                                        <div class="s-filters-widget-values"><label class="s-filters-label"
                                                                                    for="rating-option-0"><input
                                                    id="rating-option-0" name="rating" type="radio"
                                                    class="s-filters-radio">
                                                <salla-rating-stars class="hydrated">
                                                    <div class="s-rating-stars-wrapper"> <span
                                                            class="s-rating-stars-btn-star s-rating-stars-small s-rating-stars-selected"><!-- Generated by IcoMoon.io -->
<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="30" height="32" viewBox="0 0 30 32">
<title>star2</title>
<path
    d="M29.714 11.839c0 0.321-0.232 0.625-0.464 0.857l-6.482 6.321 1.536 8.929c0.018 0.125 0.018 0.232 0.018 0.357 0 0.464-0.214 0.893-0.732 0.893-0.25 0-0.5-0.089-0.714-0.214l-8.018-4.214-8.018 4.214c-0.232 0.125-0.464 0.214-0.714 0.214-0.518 0-0.75-0.429-0.75-0.893 0-0.125 0.018-0.232 0.036-0.357l1.536-8.929-6.5-6.321c-0.214-0.232-0.446-0.536-0.446-0.857 0-0.536 0.554-0.75 1-0.821l8.964-1.304 4.018-8.125c0.161-0.339 0.464-0.732 0.875-0.732s0.714 0.393 0.875 0.732l4.018 8.125 8.964 1.304c0.429 0.071 1 0.286 1 0.821z"></path>
</svg>
</span><span class="s-rating-stars-btn-star s-rating-stars-small s-rating-stars-selected"><!-- Generated by IcoMoon.io -->
<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="30" height="32" viewBox="0 0 30 32">
<title>star2</title>
<path
    d="M29.714 11.839c0 0.321-0.232 0.625-0.464 0.857l-6.482 6.321 1.536 8.929c0.018 0.125 0.018 0.232 0.018 0.357 0 0.464-0.214 0.893-0.732 0.893-0.25 0-0.5-0.089-0.714-0.214l-8.018-4.214-8.018 4.214c-0.232 0.125-0.464 0.214-0.714 0.214-0.518 0-0.75-0.429-0.75-0.893 0-0.125 0.018-0.232 0.036-0.357l1.536-8.929-6.5-6.321c-0.214-0.232-0.446-0.536-0.446-0.857 0-0.536 0.554-0.75 1-0.821l8.964-1.304 4.018-8.125c0.161-0.339 0.464-0.732 0.875-0.732s0.714 0.393 0.875 0.732l4.018 8.125 8.964 1.304c0.429 0.071 1 0.286 1 0.821z"></path>
</svg>
</span><span class="s-rating-stars-btn-star s-rating-stars-small s-rating-stars-selected"><!-- Generated by IcoMoon.io -->
<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="30" height="32" viewBox="0 0 30 32">
<title>star2</title>
<path
    d="M29.714 11.839c0 0.321-0.232 0.625-0.464 0.857l-6.482 6.321 1.536 8.929c0.018 0.125 0.018 0.232 0.018 0.357 0 0.464-0.214 0.893-0.732 0.893-0.25 0-0.5-0.089-0.714-0.214l-8.018-4.214-8.018 4.214c-0.232 0.125-0.464 0.214-0.714 0.214-0.518 0-0.75-0.429-0.75-0.893 0-0.125 0.018-0.232 0.036-0.357l1.536-8.929-6.5-6.321c-0.214-0.232-0.446-0.536-0.446-0.857 0-0.536 0.554-0.75 1-0.821l8.964-1.304 4.018-8.125c0.161-0.339 0.464-0.732 0.875-0.732s0.714 0.393 0.875 0.732l4.018 8.125 8.964 1.304c0.429 0.071 1 0.286 1 0.821z"></path>
</svg>
</span><span class="s-rating-stars-btn-star s-rating-stars-small s-rating-stars-selected"><!-- Generated by IcoMoon.io -->
<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="30" height="32" viewBox="0 0 30 32">
<title>star2</title>
<path
    d="M29.714 11.839c0 0.321-0.232 0.625-0.464 0.857l-6.482 6.321 1.536 8.929c0.018 0.125 0.018 0.232 0.018 0.357 0 0.464-0.214 0.893-0.732 0.893-0.25 0-0.5-0.089-0.714-0.214l-8.018-4.214-8.018 4.214c-0.232 0.125-0.464 0.214-0.714 0.214-0.518 0-0.75-0.429-0.75-0.893 0-0.125 0.018-0.232 0.036-0.357l1.536-8.929-6.5-6.321c-0.214-0.232-0.446-0.536-0.446-0.857 0-0.536 0.554-0.75 1-0.821l8.964-1.304 4.018-8.125c0.161-0.339 0.464-0.732 0.875-0.732s0.714 0.393 0.875 0.732l4.018 8.125 8.964 1.304c0.429 0.071 1 0.286 1 0.821z"></path>
</svg>
</span><span class="s-rating-stars-btn-star s-rating-stars-small s-rating-stars-selected"><!-- Generated by IcoMoon.io -->
<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="30" height="32" viewBox="0 0 30 32">
<title>star2</title>
<path
    d="M29.714 11.839c0 0.321-0.232 0.625-0.464 0.857l-6.482 6.321 1.536 8.929c0.018 0.125 0.018 0.232 0.018 0.357 0 0.464-0.214 0.893-0.732 0.893-0.25 0-0.5-0.089-0.714-0.214l-8.018-4.214-8.018 4.214c-0.232 0.125-0.464 0.214-0.714 0.214-0.518 0-0.75-0.429-0.75-0.893 0-0.125 0.018-0.232 0.036-0.357l1.536-8.929-6.5-6.321c-0.214-0.232-0.446-0.536-0.446-0.857 0-0.536 0.554-0.75 1-0.821l8.964-1.304 4.018-8.125c0.161-0.339 0.464-0.732 0.875-0.732s0.714 0.393 0.875 0.732l4.018 8.125 8.964 1.304c0.429 0.071 1 0.286 1 0.821z"></path>
</svg>
</span></div>
                                                </salla-rating-stars>
                                            </label><label class="s-filters-label" for="rating-option-1"><input
                                                    id="rating-option-1" name="rating" type="radio"
                                                    class="s-filters-radio">
                                                <salla-rating-stars class="hydrated">
                                                    <div class="s-rating-stars-wrapper"> <span
                                                            class="s-rating-stars-btn-star s-rating-stars-small s-rating-stars-selected"><!-- Generated by IcoMoon.io -->
<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="30" height="32" viewBox="0 0 30 32">
<title>star2</title>
<path
    d="M29.714 11.839c0 0.321-0.232 0.625-0.464 0.857l-6.482 6.321 1.536 8.929c0.018 0.125 0.018 0.232 0.018 0.357 0 0.464-0.214 0.893-0.732 0.893-0.25 0-0.5-0.089-0.714-0.214l-8.018-4.214-8.018 4.214c-0.232 0.125-0.464 0.214-0.714 0.214-0.518 0-0.75-0.429-0.75-0.893 0-0.125 0.018-0.232 0.036-0.357l1.536-8.929-6.5-6.321c-0.214-0.232-0.446-0.536-0.446-0.857 0-0.536 0.554-0.75 1-0.821l8.964-1.304 4.018-8.125c0.161-0.339 0.464-0.732 0.875-0.732s0.714 0.393 0.875 0.732l4.018 8.125 8.964 1.304c0.429 0.071 1 0.286 1 0.821z"></path>
</svg>
</span><span class="s-rating-stars-btn-star s-rating-stars-small s-rating-stars-selected"><!-- Generated by IcoMoon.io -->
<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="30" height="32" viewBox="0 0 30 32">
<title>star2</title>
<path
    d="M29.714 11.839c0 0.321-0.232 0.625-0.464 0.857l-6.482 6.321 1.536 8.929c0.018 0.125 0.018 0.232 0.018 0.357 0 0.464-0.214 0.893-0.732 0.893-0.25 0-0.5-0.089-0.714-0.214l-8.018-4.214-8.018 4.214c-0.232 0.125-0.464 0.214-0.714 0.214-0.518 0-0.75-0.429-0.75-0.893 0-0.125 0.018-0.232 0.036-0.357l1.536-8.929-6.5-6.321c-0.214-0.232-0.446-0.536-0.446-0.857 0-0.536 0.554-0.75 1-0.821l8.964-1.304 4.018-8.125c0.161-0.339 0.464-0.732 0.875-0.732s0.714 0.393 0.875 0.732l4.018 8.125 8.964 1.304c0.429 0.071 1 0.286 1 0.821z"></path>
</svg>
</span><span class="s-rating-stars-btn-star s-rating-stars-small s-rating-stars-selected"><!-- Generated by IcoMoon.io -->
<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="30" height="32" viewBox="0 0 30 32">
<title>star2</title>
<path
    d="M29.714 11.839c0 0.321-0.232 0.625-0.464 0.857l-6.482 6.321 1.536 8.929c0.018 0.125 0.018 0.232 0.018 0.357 0 0.464-0.214 0.893-0.732 0.893-0.25 0-0.5-0.089-0.714-0.214l-8.018-4.214-8.018 4.214c-0.232 0.125-0.464 0.214-0.714 0.214-0.518 0-0.75-0.429-0.75-0.893 0-0.125 0.018-0.232 0.036-0.357l1.536-8.929-6.5-6.321c-0.214-0.232-0.446-0.536-0.446-0.857 0-0.536 0.554-0.75 1-0.821l8.964-1.304 4.018-8.125c0.161-0.339 0.464-0.732 0.875-0.732s0.714 0.393 0.875 0.732l4.018 8.125 8.964 1.304c0.429 0.071 1 0.286 1 0.821z"></path>
</svg>
</span><span class="s-rating-stars-btn-star s-rating-stars-small s-rating-stars-selected"><!-- Generated by IcoMoon.io -->
<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="30" height="32" viewBox="0 0 30 32">
<title>star2</title>
<path
    d="M29.714 11.839c0 0.321-0.232 0.625-0.464 0.857l-6.482 6.321 1.536 8.929c0.018 0.125 0.018 0.232 0.018 0.357 0 0.464-0.214 0.893-0.732 0.893-0.25 0-0.5-0.089-0.714-0.214l-8.018-4.214-8.018 4.214c-0.232 0.125-0.464 0.214-0.714 0.214-0.518 0-0.75-0.429-0.75-0.893 0-0.125 0.018-0.232 0.036-0.357l1.536-8.929-6.5-6.321c-0.214-0.232-0.446-0.536-0.446-0.857 0-0.536 0.554-0.75 1-0.821l8.964-1.304 4.018-8.125c0.161-0.339 0.464-0.732 0.875-0.732s0.714 0.393 0.875 0.732l4.018 8.125 8.964 1.304c0.429 0.071 1 0.286 1 0.821z"></path>
</svg>
</span><span class="s-rating-stars-btn-star s-rating-stars-small"><!-- Generated by IcoMoon.io -->
<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="30" height="32" viewBox="0 0 30 32">
<title>star2</title>
<path
    d="M29.714 11.839c0 0.321-0.232 0.625-0.464 0.857l-6.482 6.321 1.536 8.929c0.018 0.125 0.018 0.232 0.018 0.357 0 0.464-0.214 0.893-0.732 0.893-0.25 0-0.5-0.089-0.714-0.214l-8.018-4.214-8.018 4.214c-0.232 0.125-0.464 0.214-0.714 0.214-0.518 0-0.75-0.429-0.75-0.893 0-0.125 0.018-0.232 0.036-0.357l1.536-8.929-6.5-6.321c-0.214-0.232-0.446-0.536-0.446-0.857 0-0.536 0.554-0.75 1-0.821l8.964-1.304 4.018-8.125c0.161-0.339 0.464-0.732 0.875-0.732s0.714 0.393 0.875 0.732l4.018 8.125 8.964 1.304c0.429 0.071 1 0.286 1 0.821z"></path>
</svg>
</span></div>
                                                </salla-rating-stars>
                                            </label><label class="s-filters-label" for="rating-option-2"><input
                                                    id="rating-option-2" name="rating" type="radio"
                                                    class="s-filters-radio">
                                                <salla-rating-stars class="hydrated">
                                                    <div class="s-rating-stars-wrapper"> <span
                                                            class="s-rating-stars-btn-star s-rating-stars-small s-rating-stars-selected"><!-- Generated by IcoMoon.io -->
<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="30" height="32" viewBox="0 0 30 32">
<title>star2</title>
<path
    d="M29.714 11.839c0 0.321-0.232 0.625-0.464 0.857l-6.482 6.321 1.536 8.929c0.018 0.125 0.018 0.232 0.018 0.357 0 0.464-0.214 0.893-0.732 0.893-0.25 0-0.5-0.089-0.714-0.214l-8.018-4.214-8.018 4.214c-0.232 0.125-0.464 0.214-0.714 0.214-0.518 0-0.75-0.429-0.75-0.893 0-0.125 0.018-0.232 0.036-0.357l1.536-8.929-6.5-6.321c-0.214-0.232-0.446-0.536-0.446-0.857 0-0.536 0.554-0.75 1-0.821l8.964-1.304 4.018-8.125c0.161-0.339 0.464-0.732 0.875-0.732s0.714 0.393 0.875 0.732l4.018 8.125 8.964 1.304c0.429 0.071 1 0.286 1 0.821z"></path>
</svg>
</span><span class="s-rating-stars-btn-star s-rating-stars-small s-rating-stars-selected"><!-- Generated by IcoMoon.io -->
<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="30" height="32" viewBox="0 0 30 32">
<title>star2</title>
<path
    d="M29.714 11.839c0 0.321-0.232 0.625-0.464 0.857l-6.482 6.321 1.536 8.929c0.018 0.125 0.018 0.232 0.018 0.357 0 0.464-0.214 0.893-0.732 0.893-0.25 0-0.5-0.089-0.714-0.214l-8.018-4.214-8.018 4.214c-0.232 0.125-0.464 0.214-0.714 0.214-0.518 0-0.75-0.429-0.75-0.893 0-0.125 0.018-0.232 0.036-0.357l1.536-8.929-6.5-6.321c-0.214-0.232-0.446-0.536-0.446-0.857 0-0.536 0.554-0.75 1-0.821l8.964-1.304 4.018-8.125c0.161-0.339 0.464-0.732 0.875-0.732s0.714 0.393 0.875 0.732l4.018 8.125 8.964 1.304c0.429 0.071 1 0.286 1 0.821z"></path>
</svg>
</span><span class="s-rating-stars-btn-star s-rating-stars-small s-rating-stars-selected"><!-- Generated by IcoMoon.io -->
<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="30" height="32" viewBox="0 0 30 32">
<title>star2</title>
<path
    d="M29.714 11.839c0 0.321-0.232 0.625-0.464 0.857l-6.482 6.321 1.536 8.929c0.018 0.125 0.018 0.232 0.018 0.357 0 0.464-0.214 0.893-0.732 0.893-0.25 0-0.5-0.089-0.714-0.214l-8.018-4.214-8.018 4.214c-0.232 0.125-0.464 0.214-0.714 0.214-0.518 0-0.75-0.429-0.75-0.893 0-0.125 0.018-0.232 0.036-0.357l1.536-8.929-6.5-6.321c-0.214-0.232-0.446-0.536-0.446-0.857 0-0.536 0.554-0.75 1-0.821l8.964-1.304 4.018-8.125c0.161-0.339 0.464-0.732 0.875-0.732s0.714 0.393 0.875 0.732l4.018 8.125 8.964 1.304c0.429 0.071 1 0.286 1 0.821z"></path>
</svg>
</span><span class="s-rating-stars-btn-star s-rating-stars-small"><!-- Generated by IcoMoon.io -->
<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="30" height="32" viewBox="0 0 30 32">
<title>star2</title>
<path
    d="M29.714 11.839c0 0.321-0.232 0.625-0.464 0.857l-6.482 6.321 1.536 8.929c0.018 0.125 0.018 0.232 0.018 0.357 0 0.464-0.214 0.893-0.732 0.893-0.25 0-0.5-0.089-0.714-0.214l-8.018-4.214-8.018 4.214c-0.232 0.125-0.464 0.214-0.714 0.214-0.518 0-0.75-0.429-0.75-0.893 0-0.125 0.018-0.232 0.036-0.357l1.536-8.929-6.5-6.321c-0.214-0.232-0.446-0.536-0.446-0.857 0-0.536 0.554-0.75 1-0.821l8.964-1.304 4.018-8.125c0.161-0.339 0.464-0.732 0.875-0.732s0.714 0.393 0.875 0.732l4.018 8.125 8.964 1.304c0.429 0.071 1 0.286 1 0.821z"></path>
</svg>
</span><span class="s-rating-stars-btn-star s-rating-stars-small"><!-- Generated by IcoMoon.io -->
<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="30" height="32" viewBox="0 0 30 32">
<title>star2</title>
<path
    d="M29.714 11.839c0 0.321-0.232 0.625-0.464 0.857l-6.482 6.321 1.536 8.929c0.018 0.125 0.018 0.232 0.018 0.357 0 0.464-0.214 0.893-0.732 0.893-0.25 0-0.5-0.089-0.714-0.214l-8.018-4.214-8.018 4.214c-0.232 0.125-0.464 0.214-0.714 0.214-0.518 0-0.75-0.429-0.75-0.893 0-0.125 0.018-0.232 0.036-0.357l1.536-8.929-6.5-6.321c-0.214-0.232-0.446-0.536-0.446-0.857 0-0.536 0.554-0.75 1-0.821l8.964-1.304 4.018-8.125c0.161-0.339 0.464-0.732 0.875-0.732s0.714 0.393 0.875 0.732l4.018 8.125 8.964 1.304c0.429 0.071 1 0.286 1 0.821z"></path>
</svg>
</span></div>
                                                </salla-rating-stars>
                                            </label><label class="s-filters-label" for="rating-option-3"><input
                                                    id="rating-option-3" name="rating" type="radio"
                                                    class="s-filters-radio">
                                                <salla-rating-stars class="hydrated">
                                                    <div class="s-rating-stars-wrapper"> <span
                                                            class="s-rating-stars-btn-star s-rating-stars-small s-rating-stars-selected"><!-- Generated by IcoMoon.io -->
<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="30" height="32" viewBox="0 0 30 32">
<title>star2</title>
<path
    d="M29.714 11.839c0 0.321-0.232 0.625-0.464 0.857l-6.482 6.321 1.536 8.929c0.018 0.125 0.018 0.232 0.018 0.357 0 0.464-0.214 0.893-0.732 0.893-0.25 0-0.5-0.089-0.714-0.214l-8.018-4.214-8.018 4.214c-0.232 0.125-0.464 0.214-0.714 0.214-0.518 0-0.75-0.429-0.75-0.893 0-0.125 0.018-0.232 0.036-0.357l1.536-8.929-6.5-6.321c-0.214-0.232-0.446-0.536-0.446-0.857 0-0.536 0.554-0.75 1-0.821l8.964-1.304 4.018-8.125c0.161-0.339 0.464-0.732 0.875-0.732s0.714 0.393 0.875 0.732l4.018 8.125 8.964 1.304c0.429 0.071 1 0.286 1 0.821z"></path>
</svg>
</span><span class="s-rating-stars-btn-star s-rating-stars-small s-rating-stars-selected"><!-- Generated by IcoMoon.io -->
<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="30" height="32" viewBox="0 0 30 32">
<title>star2</title>
<path
    d="M29.714 11.839c0 0.321-0.232 0.625-0.464 0.857l-6.482 6.321 1.536 8.929c0.018 0.125 0.018 0.232 0.018 0.357 0 0.464-0.214 0.893-0.732 0.893-0.25 0-0.5-0.089-0.714-0.214l-8.018-4.214-8.018 4.214c-0.232 0.125-0.464 0.214-0.714 0.214-0.518 0-0.75-0.429-0.75-0.893 0-0.125 0.018-0.232 0.036-0.357l1.536-8.929-6.5-6.321c-0.214-0.232-0.446-0.536-0.446-0.857 0-0.536 0.554-0.75 1-0.821l8.964-1.304 4.018-8.125c0.161-0.339 0.464-0.732 0.875-0.732s0.714 0.393 0.875 0.732l4.018 8.125 8.964 1.304c0.429 0.071 1 0.286 1 0.821z"></path>
</svg>
</span><span class="s-rating-stars-btn-star s-rating-stars-small"><!-- Generated by IcoMoon.io -->
<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="30" height="32" viewBox="0 0 30 32">
<title>star2</title>
<path
    d="M29.714 11.839c0 0.321-0.232 0.625-0.464 0.857l-6.482 6.321 1.536 8.929c0.018 0.125 0.018 0.232 0.018 0.357 0 0.464-0.214 0.893-0.732 0.893-0.25 0-0.5-0.089-0.714-0.214l-8.018-4.214-8.018 4.214c-0.232 0.125-0.464 0.214-0.714 0.214-0.518 0-0.75-0.429-0.75-0.893 0-0.125 0.018-0.232 0.036-0.357l1.536-8.929-6.5-6.321c-0.214-0.232-0.446-0.536-0.446-0.857 0-0.536 0.554-0.75 1-0.821l8.964-1.304 4.018-8.125c0.161-0.339 0.464-0.732 0.875-0.732s0.714 0.393 0.875 0.732l4.018 8.125 8.964 1.304c0.429 0.071 1 0.286 1 0.821z"></path>
</svg>
</span><span class="s-rating-stars-btn-star s-rating-stars-small"><!-- Generated by IcoMoon.io -->
<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="30" height="32" viewBox="0 0 30 32">
<title>star2</title>
<path
    d="M29.714 11.839c0 0.321-0.232 0.625-0.464 0.857l-6.482 6.321 1.536 8.929c0.018 0.125 0.018 0.232 0.018 0.357 0 0.464-0.214 0.893-0.732 0.893-0.25 0-0.5-0.089-0.714-0.214l-8.018-4.214-8.018 4.214c-0.232 0.125-0.464 0.214-0.714 0.214-0.518 0-0.75-0.429-0.75-0.893 0-0.125 0.018-0.232 0.036-0.357l1.536-8.929-6.5-6.321c-0.214-0.232-0.446-0.536-0.446-0.857 0-0.536 0.554-0.75 1-0.821l8.964-1.304 4.018-8.125c0.161-0.339 0.464-0.732 0.875-0.732s0.714 0.393 0.875 0.732l4.018 8.125 8.964 1.304c0.429 0.071 1 0.286 1 0.821z"></path>
</svg>
</span><span class="s-rating-stars-btn-star s-rating-stars-small"><!-- Generated by IcoMoon.io -->
<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="30" height="32" viewBox="0 0 30 32">
<title>star2</title>
<path
    d="M29.714 11.839c0 0.321-0.232 0.625-0.464 0.857l-6.482 6.321 1.536 8.929c0.018 0.125 0.018 0.232 0.018 0.357 0 0.464-0.214 0.893-0.732 0.893-0.25 0-0.5-0.089-0.714-0.214l-8.018-4.214-8.018 4.214c-0.232 0.125-0.464 0.214-0.714 0.214-0.518 0-0.75-0.429-0.75-0.893 0-0.125 0.018-0.232 0.036-0.357l1.536-8.929-6.5-6.321c-0.214-0.232-0.446-0.536-0.446-0.857 0-0.536 0.554-0.75 1-0.821l8.964-1.304 4.018-8.125c0.161-0.339 0.464-0.732 0.875-0.732s0.714 0.393 0.875 0.732l4.018 8.125 8.964 1.304c0.429 0.071 1 0.286 1 0.821z"></path>
</svg>
</span></div>
                                                </salla-rating-stars>
                                            </label><label class="s-filters-label" for="rating-option-4"><input
                                                    id="rating-option-4" name="rating" type="radio"
                                                    class="s-filters-radio">
                                                <salla-rating-stars class="hydrated">
                                                    <div class="s-rating-stars-wrapper"> <span
                                                            class="s-rating-stars-btn-star s-rating-stars-small s-rating-stars-selected"><!-- Generated by IcoMoon.io -->
<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="30" height="32" viewBox="0 0 30 32">
<title>star2</title>
<path
    d="M29.714 11.839c0 0.321-0.232 0.625-0.464 0.857l-6.482 6.321 1.536 8.929c0.018 0.125 0.018 0.232 0.018 0.357 0 0.464-0.214 0.893-0.732 0.893-0.25 0-0.5-0.089-0.714-0.214l-8.018-4.214-8.018 4.214c-0.232 0.125-0.464 0.214-0.714 0.214-0.518 0-0.75-0.429-0.75-0.893 0-0.125 0.018-0.232 0.036-0.357l1.536-8.929-6.5-6.321c-0.214-0.232-0.446-0.536-0.446-0.857 0-0.536 0.554-0.75 1-0.821l8.964-1.304 4.018-8.125c0.161-0.339 0.464-0.732 0.875-0.732s0.714 0.393 0.875 0.732l4.018 8.125 8.964 1.304c0.429 0.071 1 0.286 1 0.821z"></path>
</svg>
</span><span class="s-rating-stars-btn-star s-rating-stars-small"><!-- Generated by IcoMoon.io -->
<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="30" height="32" viewBox="0 0 30 32">
<title>star2</title>
<path
    d="M29.714 11.839c0 0.321-0.232 0.625-0.464 0.857l-6.482 6.321 1.536 8.929c0.018 0.125 0.018 0.232 0.018 0.357 0 0.464-0.214 0.893-0.732 0.893-0.25 0-0.5-0.089-0.714-0.214l-8.018-4.214-8.018 4.214c-0.232 0.125-0.464 0.214-0.714 0.214-0.518 0-0.75-0.429-0.75-0.893 0-0.125 0.018-0.232 0.036-0.357l1.536-8.929-6.5-6.321c-0.214-0.232-0.446-0.536-0.446-0.857 0-0.536 0.554-0.75 1-0.821l8.964-1.304 4.018-8.125c0.161-0.339 0.464-0.732 0.875-0.732s0.714 0.393 0.875 0.732l4.018 8.125 8.964 1.304c0.429 0.071 1 0.286 1 0.821z"></path>
</svg>
</span><span class="s-rating-stars-btn-star s-rating-stars-small"><!-- Generated by IcoMoon.io -->
<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="30" height="32" viewBox="0 0 30 32">
<title>star2</title>
<path
    d="M29.714 11.839c0 0.321-0.232 0.625-0.464 0.857l-6.482 6.321 1.536 8.929c0.018 0.125 0.018 0.232 0.018 0.357 0 0.464-0.214 0.893-0.732 0.893-0.25 0-0.5-0.089-0.714-0.214l-8.018-4.214-8.018 4.214c-0.232 0.125-0.464 0.214-0.714 0.214-0.518 0-0.75-0.429-0.75-0.893 0-0.125 0.018-0.232 0.036-0.357l1.536-8.929-6.5-6.321c-0.214-0.232-0.446-0.536-0.446-0.857 0-0.536 0.554-0.75 1-0.821l8.964-1.304 4.018-8.125c0.161-0.339 0.464-0.732 0.875-0.732s0.714 0.393 0.875 0.732l4.018 8.125 8.964 1.304c0.429 0.071 1 0.286 1 0.821z"></path>
</svg>
</span><span class="s-rating-stars-btn-star s-rating-stars-small"><!-- Generated by IcoMoon.io -->
<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="30" height="32" viewBox="0 0 30 32">
<title>star2</title>
<path
    d="M29.714 11.839c0 0.321-0.232 0.625-0.464 0.857l-6.482 6.321 1.536 8.929c0.018 0.125 0.018 0.232 0.018 0.357 0 0.464-0.214 0.893-0.732 0.893-0.25 0-0.5-0.089-0.714-0.214l-8.018-4.214-8.018 4.214c-0.232 0.125-0.464 0.214-0.714 0.214-0.518 0-0.75-0.429-0.75-0.893 0-0.125 0.018-0.232 0.036-0.357l1.536-8.929-6.5-6.321c-0.214-0.232-0.446-0.536-0.446-0.857 0-0.536 0.554-0.75 1-0.821l8.964-1.304 4.018-8.125c0.161-0.339 0.464-0.732 0.875-0.732s0.714 0.393 0.875 0.732l4.018 8.125 8.964 1.304c0.429 0.071 1 0.286 1 0.821z"></path>
</svg>
</span><span class="s-rating-stars-btn-star s-rating-stars-small"><!-- Generated by IcoMoon.io -->
<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="30" height="32" viewBox="0 0 30 32">
<title>star2</title>
<path
    d="M29.714 11.839c0 0.321-0.232 0.625-0.464 0.857l-6.482 6.321 1.536 8.929c0.018 0.125 0.018 0.232 0.018 0.357 0 0.464-0.214 0.893-0.732 0.893-0.25 0-0.5-0.089-0.714-0.214l-8.018-4.214-8.018 4.214c-0.232 0.125-0.464 0.214-0.714 0.214-0.518 0-0.75-0.429-0.75-0.893 0-0.125 0.018-0.232 0.036-0.357l1.536-8.929-6.5-6.321c-0.214-0.232-0.446-0.536-0.446-0.857 0-0.536 0.554-0.75 1-0.821l8.964-1.304 4.018-8.125c0.161-0.339 0.464-0.732 0.875-0.732s0.714 0.393 0.875 0.732l4.018 8.125 8.964 1.304c0.429 0.071 1 0.286 1 0.821z"></path>
</svg>
</span></div>
                                                </salla-rating-stars>
                                            </label></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion" id="accPrice">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headPrice">
                                    <button class="accordion-button s-filters-widget-title" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#colPrice" aria-expanded="false"
                                            aria-controls="colPrice">
                                        Price
                                    </button>
                                </h2>
                                <div id="colPrice" class="accordion-collapse collapse show" aria-labelledby="headPrice"
                                     data-bs-parent="#accPrice">
                                    <div class="accordion-body">
                                        <div class="s-filters-widget-values">
                                            <salla-price-range class="hydrated"><label class="s-filters-label"
                                                                                       for="price-0"><input id="price-0"
                                                                                                            name="price"
                                                                                                            type="radio"
                                                                                                            class="s-filters-radio">less
                                                    than 100 SAR</label><label class="s-filters-label"
                                                                               for="price-1"><input id="price-1"
                                                                                                    name="price"
                                                                                                    type="radio"
                                                                                                    class="s-filters-radio">100
                                                    SAR to 200 SAR</label><label class="s-filters-label"
                                                                                 for="price-2"><input id="price-2"
                                                                                                      name="price"
                                                                                                      type="radio"
                                                                                                      class="s-filters-radio">200
                                                    SAR to 300 SAR</label><label class="s-filters-label"
                                                                                 for="price-3"><input id="price-3"
                                                                                                      name="price"
                                                                                                      type="radio"
                                                                                                      class="s-filters-radio">more
                                                    than 300 SAR</label>
                                                <div class="flex justify-center items-center">
                                                    <div class="relative max-w-xl w-full">
                                                        <div class="s-price-range-inputs">
                                                            <div class="s-price-range-relative">
                                                                <div class="s-price-range-currency"> SAR</div>
                                                                <input type="number" maxlength="5" placeholder="from"
                                                                       class="s-price-range-number-input"></div>
                                                            <div class="s-price-range-gray-text"> -</div>
                                                            <div class="s-price-range-relative">
                                                                <div class="s-price-range-currency"> SAR</div>
                                                                <input type="number" maxlength="5" placeholder="to"
                                                                       class="s-price-range-number-input"
                                                                       aria-describedby="price-currency"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </salla-price-range>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>
                    <main>
                        <div class="main">
                            @include('themes.theme1.blocks.items.item-01')
                            @include('themes.theme1.blocks.items.item-01')
                            @include('themes.theme1.blocks.items.item-01')
                            @include('themes.theme1.blocks.items.item-01')
                            @include('themes.theme1.blocks.items.item-01')
                            @include('themes.theme1.blocks.items.item-01')
                            @include('themes.theme1.blocks.items.item-01')
                            @include('themes.theme1.blocks.items.item-01')
                            @include('themes.theme1.blocks.items.item-01')

                            @include('themes.theme1.blocks.items.item-01')
                            @include('themes.theme1.blocks.items.item-01')
                            @include('themes.theme1.blocks.items.item-01')
                            @include('themes.theme1.blocks.items.item-01')
                            @include('themes.theme1.blocks.items.item-01')
                            @include('themes.theme1.blocks.items.item-01')
                            @include('themes.theme1.blocks.items.item-01')
                            @include('themes.theme1.blocks.items.item-01')
                            @include('themes.theme1.blocks.items.item-01')


                            @include('themes.theme1.blocks.items.item-01')
                            @include('themes.theme1.blocks.items.item-01')
                            @include('themes.theme1.blocks.items.item-01')
                            @include('themes.theme1.blocks.items.item-01')
                            @include('themes.theme1.blocks.items.item-01')
                            @include('themes.theme1.blocks.items.item-01')
                            @include('themes.theme1.blocks.items.item-01')
                            @include('themes.theme1.blocks.items.item-01')
                            @include('themes.theme1.blocks.items.item-01')
                        </div>
                        <div class="d-flex justify-content-center">
                            <button id="load-more" class="s-infinite-scroll-btn s-button-btn s-button-primary">Load
                                More
                            </button>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </section>
@endsection

