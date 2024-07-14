<section class="s-block">
    <div class="pixel-container">
        <div class="wrap">
            <div class="section-categories">

                <div class="section-head">
                    <div class="s-block-title">
                        <h2>Makeups Most sales</h2>
                    </div>

                    <div class="category-nav">
                        <a href="{{route('front.category')}}" class="btn-all">View All</a>
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

                <div class="swiper categories">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            @include("themes.theme3.blocks..items.item-01")
                        </div>
                        <div class="swiper-slide">@include("themes.theme3.blocks..items.item-02")</div>
                        <div class="swiper-slide">@include("themes.theme3.blocks..items.item-03")</div>
                        <div class="swiper-slide">@include("themes.theme3.blocks..items.item-04")</div>
                        <div class="swiper-slide">@include("themes.theme3.blocks..items.item-05")</div>
                        <div class="swiper-slide">@include("themes.theme3.blocks..items.item-06")</div>
                        <div class="swiper-slide">@include("themes.theme3.blocks..items.item-07")</div>
                        <div class="swiper-slide">@include("themes.theme3.blocks..items.item-08")</div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
