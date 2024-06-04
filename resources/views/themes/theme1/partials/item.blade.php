<div class="item">
    <!-- tags -->
    <div class="item-tags">
        <span>most popular</span>
    </div>
    <!-- ./tags -->
    <!-- img -->
    <div class="img">
        <a href="{{ route('product', $product->id) }}">
            <img class="w-full object-contain" src="{{ $product->thumbnail }}"
                 alt="Product Image">
        </a>
    </div>
    <!-- img -->

    <!-- data -->
    <div class="item-data">
        <!-- price -->
        <div class="item-price">
            @if ($product->discount_value > 0)
                <h4 class="before-dis">
                    <strong>{{ $product->variants->first()->price }}</strong>
                    <span>SAR</span>
                </h4>
            @endif
            <h4 class="after-dis">
                <strong>{{ $product->variants->first()->price_with_discount }}</strong>
                <span>SAR</span>
            </h4>
            @auth()
                <div class="add-favourite">
                    <button class="icon-fav @if(in_array($product->id , auth()->user()->favoriteProducts->pluck('id')->toArray())) added @endif"
                            onclick="addToFavorites('{{route('toggle.favorites' ,$product->id)}}')">
                        <i class="sicon-heart"></i>
                    </button>
                </div>
            @endauth
        </div>
        <!-- ./price -->

        <!-- description -->
        <div class="item-dec">
            <a href="{{ route('product', $product->id) }}">
                <span>{!! Str::limit($product->title, 100) !!}</span>
            </a>
        </div>
        <!-- ./description -->

        <!-- button cart -->
        <button class="tocart add-to-cart" data-title="Add to Cart" data-cart-url="{{route('cart.add', $product->id)}}" onclick="addToCart(this)">
            <span class="button-title">Add to Cart</span>
            <i class="sicon-shopping button-icon icon-tocart" data-icon="tocart"></i>
        </button>
        <!-- ./button cart -->

    </div>
    <!-- ./data -->
</div>

