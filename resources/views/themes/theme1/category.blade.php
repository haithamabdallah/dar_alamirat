@php
    // dd( $products );
@endphp

@extends('themes.theme1.layouts.app')

@section('customcss')
    <style>
        /* Hide scrollbar for Chrome, Safari and Opera */
        #accBrands::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        #accBrands {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }
    </style>
@endsection

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
                        <a href="{{ route('index') }}">
                            <span>{{ __('Home') }}</span>
                        </a>
                    </li>
                    @if (isset($category?->parent?->parent))
                        <li>
                            <span>{{ $category?->parent?->parent->name }}</span>
                        </li>
                    @endif
                    @if (isset($category?->parent))
                        <li>
                            <span>{{ $category?->parent->name }}</span>
                        </li>
                    @endif
                    <li>
                        <span>{{ $category->name }}</span>
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
                                        {{ __('Categories') }}
                                    </button>
                                </h2>
                                <div id="colCategory" class="accordion-collapse collapse show"
                                    aria-labelledby="headCategory" data-bs-parent="#accCategories">
                                    <div class="accordion-body">
                                        <div class="s-filters-widget-values">
                                            <div class="filter-form" id="category-filter-form" style="overflow-y: scroll ; height: 600px">
                                                @if (isset($category?->parent))
                                                    @if (isset($category?->parent->parent))
                                                        <div class="my-3">
                                                            <a
                                                                href="{{ route('category.products', $category?->parent?->parent->id) }}">
                                                                <input type="radio" onclick="event.preventDefault()">
                                                                {{ $category?->parent?->parent->name }}
                                                            </a>
                                                        </div>
                                                    @endif
                                                    <div class="my-3">
                                                        <a href="{{ route('category.products', $category?->parent->id) }}">
                                                            <input type="radio" onclick="event.preventDefault()">
                                                            {{ $category?->parent->name }}
                                                        </a>
                                                    </div>
                                                    @foreach ($category?->parent?->childes as $childCategory)
                                                        <div class="my-3">
                                                            <a href="{{ route('category.products', $childCategory->id) }}">
                                                                <input type="radio" {!! $category->id == $childCategory->id ? 'checked' : '' !!}
                                                                    onclick="event.preventDefault()">
                                                                {{ $childCategory->name }}
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    @foreach (defaultCategory() as $parentCategory)
                                                        <div class="my-3">
                                                            <a
                                                                href="{{ route('category.products', $parentCategory->id) }}">
                                                                <input type="radio" {!! $category->id == $parentCategory->id ? 'checked' : '' !!}
                                                                    onclick="event.preventDefault()">
                                                                {{ $parentCategory->name }}
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion" id="accBrands" style="max-height: 300px; overflow-y: scroll">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headBrands">
                                    <button class="accordion-button s-filters-widget-title" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#colBrands" aria-expanded="false"
                                        aria-controls="colBrands">
                                        {{ __('Brands') }}
                                    </button>
                                </h2>
                                <div id="colBrands" class="accordion-collapse collapse show" aria-labelledby="headBrands"
                                    data-bs-parent="#accBrands">
                                    <div class="accordion-body">
                                        <div class="s-filters-widget-values">
                                            <form class="filter-form" id="brand-filter-form" method="GET"
                                                action="{{ route('category.products', $category->id) }}">
                                                <input type="hidden" name="filter[category_id]"
                                                    value="{{ $category->id }}">

                                                {{-- @foreach (filterBrands() as $brand) --}}
                                                @foreach ($categoryBrands as $brand)
                                                    <label class="s-filters-label"
                                                        for="brand_id-option-{{ $brand->id }}">
                                                        <input id="brand_id-option-{{ $brand->id }}" type="radio"
                                                            name="filter[brand_id]" value="{{ $brand->id }}"
                                                            {{ request('filter.brand_id') == $brand->id ? 'checked' : '' }}>
                                                        <span class="s-filters-option-name">{{ $brand->name }}</span>
                                                    </label>
                                                @endforeach
                                            </form>
                                        </div>
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
                                        {{ __('Price') }}
                                    </button>
                                </h2>
                                <div id="colPrice" class="accordion-collapse collapse show" aria-labelledby="headPrice"
                                    data-bs-parent="#accPrice">
                                    <div class="accordion-body">
                                        <div class="s-filters-widget-values">
                                            <form class="filter-form" id="price-filter-form" method="GET"
                                                action="{{ route('category.products', $category->id) }}">
                                                <input type="hidden" name="filter[category_id]"
                                                    value="{{ $category->id }}">
                                                <label class="s-filters-label" for="price-0">
                                                    <input id="price-0" name="filter[price]" type="radio"
                                                        class="s-filters-radio" value="<100"
                                                        {{ request('filter.price') == '<100' ? 'checked' : '' }}>
                                                    {{ __('less than') }}
                                                    100 {{ $currency }}
                                                </label>
                                                <label class="s-filters-label" for="price-1">
                                                    <input id="price-1" name="filter[price]" type="radio"
                                                        class="s-filters-radio" value="100-200"
                                                        {{ request('filter.price') == '100-200' ? 'checked' : '' }}> 100
                                                    {{ $currency }} {{ __('to') }} 200 {{ $currency }}
                                                </label>
                                                <label class="s-filters-label" for="price-2">
                                                    <input id="price-2" name="filter[price]" type="radio"
                                                        class="s-filters-radio" value="200-300"
                                                        {{ request('filter.price') == '200-300' ? 'checked' : '' }}> 200
                                                    {{ $currency }} {{ __('to') }} 300 {{ $currency }}
                                                </label>
                                                <label class="s-filters-label" for="price-3">
                                                    <input id="price-3" name="filter[price]" type="radio"
                                                        class="s-filters-radio" value=">300"
                                                        {{ request('filter.price') == '>300' ? 'checked' : '' }}>
                                                    {{ __('more than') }}
                                                    300 {{ $currency }}
                                                </label>
                                                <div class="flex justify-center items-center">
                                                    <div class="relative max-w-xl w-full">
                                                        <div class="s-price-range-inputs">
                                                            <div class="s-price-range-relative">
                                                                {{-- <div class="s-price-range-currency"> {{ $currency }}
                                                                </div> --}}
                                                                <input type="number" maxlength="5"
                                                                    placeholder="{{ __('from') }}"
                                                                    class="s-price-range-number-input"
                                                                    name="filter[price_min]"
                                                                    value="{{ request('filter.price_min') }}">
                                                            </div>
                                                            <div class="s-price-range-gray-text"> - </div>
                                                            <div class="s-price-range-relative">
                                                                {{-- <div class="s-price-range-currency"> {{ $currency }}
                                                                </div> --}}
                                                                <input type="number" maxlength="5"
                                                                    placeholder="{{ __('to') }}"
                                                                    class="s-price-range-number-input"
                                                                    name="filter[price_max]"
                                                                    value="{{ request('filter.price_max') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary my-2" type="submit"
                                                    style="width: 100% !important; background-color: #5e6fb4">{{ __('Search') }}</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>
                    <main>
                        @if ($products->count() > 0)
                            <div class="main products-container" id="product-container"
                                data-url="{{ route('category.products', $category->id) }}">
                                @foreach ($products as $product)
                                    <!-- product item -->
                                    @include('themes.theme1.partials.item')
                                    <!-- product item -->
                                @endforeach
                            </div>
                            @if ($products->lastPage() > 1)
                                @include('themes.theme1.partials.pagination' , ['items' => $products])
                            @endif
                        @else
                            <!-- no content -->
                            <section id="full-layout">
                                <div class="pixel-container">
                                    <!-- row -->
                                    <div class="wrap">
                                        <!-- content -->
                                        <div class="main-content">
                                            <div class="no-content-placeholder">
                                                {{-- <i class="sicon-shopping-bag icon"></i> --}}
                                                <p class="text-center my-5" style="font-size: 2rem">
                                                    {{ __('No Products') }}</p>
                                                {{-- <a href="{{ route('index') }}"
                                                    class="btn btn--outline-primary">{{ __('Home Page') }}</a> --}}
                                            </div>
                                        </div>
                                        <!-- .content -->
                                    </div>
                                    <!-- ./row -->
                                </div>
                            </section>
                            <!-- no content -->
                        @endif
                    </main>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    @include('themes.theme1.category-scripts')
@endsection
