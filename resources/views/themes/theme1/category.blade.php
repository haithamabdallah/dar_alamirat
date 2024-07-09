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
                                            <div class="filter-form" id="category-filter-form">
                                                @if (isset($category?->parent))
                                                    @if (isset($category?->parent->parent))
                                                        <div class="my-3">
                                                            <a href="{{ route('category.products', $category?->parent?->parent->id) }}">
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
                                                                <input type="radio" {!! $category->id == $childCategory->id ? 'checked' : '' !!} onclick="event.preventDefault()">
                                                                {{ $childCategory->name }}
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    @foreach (defaultCategory() as $parentCategory)
                                                        <div class="my-3">
                                                            <a href="{{ route('category.products', $parentCategory->id) }}">
                                                                <input type="radio" {!! $category->id == $parentCategory->id ? 'checked' : '' !!} onclick="event.preventDefault()">
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
                                                                <input type="number" maxlength="5" placeholder="{{ __('from') }}"
                                                                    class="s-price-range-number-input"
                                                                    name="filter[price_min]"
                                                                    value="{{ request('filter.price_min') }}">
                                                            </div>
                                                            <div class="s-price-range-gray-text"> - </div>
                                                            <div class="s-price-range-relative">
                                                                {{-- <div class="s-price-range-currency"> {{ $currency }}
                                                                </div> --}}
                                                                <input type="number" maxlength="5" placeholder="{{ __('to') }}"
                                                                    class="s-price-range-number-input"
                                                                    name="filter[price_max]"
                                                                    value="{{ request('filter.price_max') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary my-2" type="submit" style="width: 100% !important; background-color: #5e6fb4">{{ __("Search") }}</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>
                    <main>
                        <div class="main products-container" id="product-container"
                            data-url="{{ route('category.products', $category->id) }}">
                            @foreach ($products as $product)
                                <!-- product item -->
                                @include('themes.theme1.partials.item')
                                <!-- product item -->
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-center">
                            <nav>
                                <ul class="pagination">
                                    <li class="page-item disabled" aria-disabled="true" aria-label="« السابق"><span class="page-link" aria-hidden="true">‹</span></li>
                                    <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                    <li class="page-item"><a class="page-link" href="#" rel="next" aria-label="التالي »">›</a></li>
                                </ul>
                            </nav>
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
        document.addEventListener('DOMContentLoaded', function() {
            let loadMoreButton = document.getElementById('load-more');
            let nextPageUrl = "{{ $products->nextPageUrl() }}"; // Initialize with the next page URL

            loadMoreButton.addEventListener('click', function() {
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
                                <a href="">
                                    <img class="w-full object-contain" src="${product.thumbnail}" alt="Product Image">
                                </a>
                            </div>
                            <!-- img -->

                            <!-- data -->
                            <div class="item-data">
                                <!-- price -->
                                <div class="item-price">
                                    ${product.discount_value > 0 ? `<h4 class="before-dis"><strong>${product.variants[0].price}</strong><span>{{ $currency }}</span></h4>` : ''}
                                    <h4 class="after-dis"><strong>${product.variants[0].price_with_discount}</strong><span>{{ $currency }}</span></h4>
                                    <div class="add-favourite">
                                        <button class="icon-fav">
                                            <i class="sicon-heart"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- ./price -->

                                <!-- description -->
                                <div class="item-dec">
                                    <a href="">
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
                                loadMoreButton.style.display =
                                    'none'; // Hide the button if no more pages
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
            });
        });
    </script>

    {{-- <script>
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
    </script> --}}

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

                // numberInputs.forEach(input => {
                //     input.addEventListener('change', function() {
                //         preserveFilters(form);
                //         form.submit();
                //     });
                // });
            });
        });
    </script>
@endsection
