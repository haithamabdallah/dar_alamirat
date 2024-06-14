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
                        <span>{{$category->name}}</span>
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
                                        <div class="s-filters-widget-values">
                                            <form class="filter-form" id="category-filter-form" method="GET" action="{{ route('category.products', $category->id) }}">
                                                @foreach(defaultCategory() as $oneCategory)
                                                    <label class="s-filters-label" for="category_id-option-{{ $oneCategory->id }}">
                                                        <input id="category_id-option-{{ $oneCategory->id }}" type="radio" name="filter[category_id]" value="{{$oneCategory->id}}" {{ request('filter.category_id') == $oneCategory->id ? 'checked' : '' }}>
                                                        <span class="s-filters-option-name">{{ $oneCategory->name }}</span>
                                                    </label>
                                                @endforeach
                                            </form>
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
                                        Brands
                                    </button>
                                </h2>
                                <div id="colBrands" class="accordion-collapse collapse show"
                                     aria-labelledby="headBrands" data-bs-parent="#accBrands">
                                    <div class="accordion-body">
                                        <div class="s-filters-widget-values">
                                            <form class="filter-form" id="brand-filter-form" method="GET" action="{{ route('category.products', $category->id) }}">
                                                @foreach(filterBrands() as $brand)
                                                    <label class="s-filters-label" for="brand_id-option-{{ $brand->id }}">
                                                        <input id="brand_id-option-{{ $brand->id }}" type="radio" name="filter[brand_id]" value="{{$brand->id}}" {{ request('filter.brand_id') == $brand->id ? 'checked' : '' }}>
                                                        <span class="s-filters-option-name">{{ $brand->name }}</span>
                                                    </label>
                                                @endforeach
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion" style="display: none" id="accRating">
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
                                            <form class="filter-form" id="price-filter-form" method="GET" action="{{ route('category.products', $category->id) }}">
                                                <label class="s-filters-label" for="price-0">
                                                    <input id="price-0" name="filter[price]" type="radio" class="s-filters-radio" value="<100" {{ request('filter.price') == '<100' ? 'checked' : '' }}> less than 100 LYD
                                                </label>
                                                <label class="s-filters-label" for="price-1">
                                                    <input id="price-1" name="filter[price]" type="radio" class="s-filters-radio" value="100-200" {{ request('filter.price') == '100-200' ? 'checked' : '' }}> 100 LYD to 200 LYD
                                                </label>
                                                <label class="s-filters-label" for="price-2">
                                                    <input id="price-2" name="filter[price]" type="radio" class="s-filters-radio" value="200-300" {{ request('filter.price') == '200-300' ? 'checked' : '' }}> 200 LYD to 300 LYD
                                                </label>
                                                <label class="s-filters-label" for="price-3">
                                                    <input id="price-3" name="filter[price]" type="radio" class="s-filters-radio" value=">300" {{ request('filter.price') == '>300' ? 'checked' : '' }}> more than 300 LYD
                                                </label>
                                                <div class="flex justify-center items-center">
                                                    <div class="relative max-w-xl w-full">
                                                        <div class="s-price-range-inputs">
                                                            <div class="s-price-range-relative">
                                                                <div class="s-price-range-currency"> LYD</div>
                                                                <input type="number" maxlength="5" placeholder="from" class="s-price-range-number-input" name="filter[price_min]" value="{{ request('filter.price_min') }}">
                                                            </div>
                                                            <div class="s-price-range-gray-text"> - </div>
                                                            <div class="s-price-range-relative">
                                                                <div class="s-price-range-currency"> LYD</div>
                                                                <input type="number" maxlength="5" placeholder="to" class="s-price-range-number-input" name="filter[price_max]" value="{{ request('filter.price_max') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>
                    <main>
                        <div class="main products-container" id="product-container" data-url="{{ route('category.products', $category->id) }}">
                            @foreach($products as $product)
                                <!-- product item -->
                                @include('themes.theme1.partials.item')
                                <!-- product item -->
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-center">
                            <button id="load-more" class="s-infinite-scroll-btn s-button-btn s-button-primary">
                                Load More
                            </button>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let loadMoreButton = document.getElementById('load-more');
            let nextPageUrl = "{{ $products->nextPageUrl() }}"; // Initialize with the next page URL

            loadMoreButton.addEventListener('click', function () {
                if (nextPageUrl) {
                    fetch(nextPageUrl, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                    })
                        .then(response => response.json())
                        .then(data => {
                            let productsContainer = document.querySelector('.products-container');
                            data.products.forEach(product => {
                                console.log(product.variants[0].price_with_discount)
                                let productHtml = `
                        <div class="item">
                            <!-- tags -->
                            <div class="item-tags">
                                <span>most popular</span>
                            </div>
                            <!-- ./tags -->
                            <!-- img -->
                            <div class="img">
                                <a href="{{route('cart-empty')}}">
                                    <img class="w-full object-contain" src="${product.thumbnail}" alt="Product Image">
                                </a>
                            </div>
                            <!-- img -->

                            <!-- data -->
                            <div class="item-data">
                                <!-- price -->
                                <div class="item-price">
                                    ${product.discount_value > 0 ? `<h4 class="before-dis"><strong>${product.variants[0].price}</strong><span>LYD</span></h4>` : ''}
                                    <h4 class="after-dis"><strong>${product.variants[0].price_with_discount}</strong><span>LYD</span></h4>
                                    <div class="add-favourite">
                                        <button class="icon-fav">
                                            <i class="sicon-heart"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- ./price -->

                                <!-- description -->
                                <div class="item-dec">
                                    <a href="{{route('cart-empty')}}">
                                        <span>${product.title['en']}</span>
                                    </a>
                                </div>
                                <!-- ./description -->

                                <!-- button cart -->
                                <button class="tocart add-to-cart button--submit" data-title="Add to Cart">
                                    <span class="button-title"></span>
                                    <i class="sicon-shopping button-icon icon-tocart" data-icon="tocart"></i>
                                    <span class="button-icon icon-wait" data-icon="tocart" style="display: none;">
                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                            <path d="M19,8L15,12H18A6,6 0 0,1 12,18C11,18 10.03,17.75 9.2,17.3L7.74,18.76C8.97,19.54 10.43,20 12,20A8,8 0 0,0 20,12H23M6,12A6,6 0 0,1 12,6C13,6 13.97,6.25 14.8,6.7L16.26,5.24C15.03,4.46 13.57,4 12,4A8,8 0 0,0 4,12H1L5,16L9,12"></path>
                                        </svg>
                                    </span>
                                    <span class="button-icon icon-success" style="display: none;" data-icon="tocart">
                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                            <path d="M21,7L9,19L3.5,13.5L4.91,12.09L9,16.17L19.59,5.59L21,7Z"></path>
                                        </svg>
                                    </span>
                                </button>
                                <!-- ./button cart -->
                            </div>
                            <!-- ./data -->
                        </div>
                        <!-- product item -->
                    `;
                                productsContainer.insertAdjacentHTML('beforeend', productHtml);
                            });
                            nextPageUrl = data.nextPage; // Update the next page URL
                            if (!nextPageUrl) {
                                loadMoreButton.style.display = 'none'; // Hide the button if no more pages
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
            });
        });
    </script>

    {{--<script>
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('.filter-form');

            forms.forEach(form => {
                const radios = form.querySelectorAll('input[type="radio"]');

                radios.forEach(radio => {
                    radio.addEventListener('change', function() {
                        form.submit();
                    });
                });
            });
        });
    </script>--}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('.filter-form');

            forms.forEach(form => {
                const radios = form.querySelectorAll('input[type="radio"]');
                const numberInputs = form.querySelectorAll('input[type="number"]');

                function preserveFilters(form) {
                    const urlParams = new URLSearchParams(window.location.search);

                    // Preserve all existing filters
                    urlParams.forEach((value, key) => {
                        if (!form.querySelector(`[name="${key}"]`)) {
                            const hiddenInput = document.createElement('input');
                            hiddenInput.type = 'hidden';
                            hiddenInput.name = key;
                            hiddenInput.value = value;
                            form.appendChild(hiddenInput);
                        }
                    });
                }

                radios.forEach(radio => {
                    radio.addEventListener('change', function() {
                        preserveFilters(form);
                        form.submit();
                    });
                });

                numberInputs.forEach(input => {
                    input.addEventListener('change', function() {
                        preserveFilters(form);
                        form.submit();
                    });
                });
            });
        });
    </script>

@endsection
