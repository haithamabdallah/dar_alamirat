<!-- Brands -->
<section class="s-block">
    <div class="pixel-container">
        <div class="wrap">
            <div class="section-brands">
                <div class="s-block-title">
                    <h2>{{ __("Browse All Brands") }}  </h2>
                    <a href="{{ route('brands.index') }}" class=""> {{ __("View All") }}  </a>
                </div>
                <div class="s-brands-list">
                    @foreach ($brands as $brand)
                        <a href="{{ route('brand', $brand->id) }}" class="brand-item">
                            <img class="" loading="lazy" src="{{ storage_asset($brand->image) }}" alt="{{ $brand->name }}">
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ./Brands -->
