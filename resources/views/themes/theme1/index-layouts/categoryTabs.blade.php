<section id="category-tabs" class="s-block">
    <div class="pixel-container">
        <div class="wrap">
            <div class="tabs-contents">
                <ul class="nav nav-pills">
                    @if(isset($categories))
                    @foreach($categories as $category)
                        <li class="nav-item">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home-tab-{{$category->id}}" type="button" role="tab" aria-controls="home-tab-{{$category->id}}"
                                    aria-selected="true"> {{$category->name}}
                            </button>
                        </li>
                    @endforeach
                    @endif
{{--                    <li class="nav-item">--}}
{{--                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab"--}}
{{--                                data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane"--}}
{{--                                aria-selected="true">Latest Products--}}
{{--                        </button>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab"--}}
{{--                                data-bs-target="#profile-tab-pane" type="button" role="tab"--}}
{{--                                aria-controls="profile-tab-pane" aria-selected="false">Most Sales--}}
{{--                        </button>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab"--}}
{{--                                data-bs-target="#contact-tab-pane" type="button" role="tab"--}}
{{--                                aria-controls="contact-tab-pane" aria-selected="false">Editor Choice--}}
{{--                        </button>--}}
{{--                    </li>--}}
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home-tab-" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        <div class="swiper latestProducts">
                            <div class="swiper-wrapper">
                                @if(isset($products))

                                @foreach($products as $product)

                                    <!-- product item -->
                                    <div class="item">
                                        <!-- tags -->
                                        <div class="item-tags">
                                            <span>most popular</span>
                                        </div>
                                        <!-- ./tags -->
                                        <!-- img -->
                                        <div class="img">
                                            <a href="{{route('cart-empty')}}">
                                                <img class="w-full object-contain" src="{{$product->thumbnail}}" alt="{{$product->title}}">
                                            </a>
                                        </div>
                                        <!-- img -->

                                        <!-- data -->
                                        <div class="item-data">
                                            <!-- price -->
                                            <div class="item-price">
                                                <h4 class="before-dis">
                                                    <strong>{{$product->variants()->latest()->first()->price}}</strong>
                                                    <span>SAR</span>
                                                </h4>
                                                <h4 class="after-dis">
                                                    <strong>{{$product->variants()->latest()->first()->price_with_discount}}</strong>
                                                    <span>SAR</span>
                                                </h4>
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
                                                    <span>{{$product->description}}</span>
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

{{--                                    <div class="swiper-slide">@include("themes.theme1.blocks.items.item-01")</div>--}}
                                @endforeach
                            @endif

                            </div>
                        </div>
                        <div class="tab-latest-prev"><i class="fa-solid fa-chevron-left"></i></div>
                        <div class="tab-latest-next"><i class="fa-solid fa-chevron-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
