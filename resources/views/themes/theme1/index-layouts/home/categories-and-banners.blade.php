<!-- ./categories & Banners -->
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
                        <img class="w-full object-cover" loading="lazy" src="{{ storage_asset($banner->image) }}"
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
                                    <a href="{{ route('category.products', $category->id) }}" class="btn-all">{{ __('View All') }}</a>
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

