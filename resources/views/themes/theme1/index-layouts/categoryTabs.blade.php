<section id="category-tabs" class="s-block">
    <div class="pixel-container">
        <div class="wrap">
            <div class="tabs-contents">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane"
                                aria-selected="true">Latest Products
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                data-bs-target="#profile-tab-pane" type="button" role="tab"
                                aria-controls="profile-tab-pane" aria-selected="false">Most Sales
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                data-bs-target="#contact-tab-pane" type="button" role="tab"
                                aria-controls="contact-tab-pane" aria-selected="false">Editor Choice
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                         tabindex="0">
                        <div class="swiper latestProducts">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    @include("themes.theme1.blocks.items.item-01")
                                </div>
                                <div class="swiper-slide">@include ("themes.theme1.blocks.items.item-02")</div>
                                <div class="swiper-slide">@include ("themes.theme1.blocks.items.item-03")</div>
                                <div class="swiper-slide">@include ("themes.theme1.blocks.items.item-04")</div>
                                <div class="swiper-slide">@include ("themes.theme1.blocks.items.item-05")</div>
                                <div class="swiper-slide">@include ("themes.theme1.blocks.items.item-06")</div>
                                <div class="swiper-slide">@include ("themes.theme1.blocks.items.item-07")</div>
                                <div class="swiper-slide">@include ("themes.theme1.blocks.items.item-08")</div>
                            </div>
                        </div>
                        <div class="tab-latest-prev"><i class="fa-solid fa-chevron-left"></i></div>
                        <div class="tab-latest-next"><i class="fa-solid fa-chevron-right"></i></div>
                    </div>
                    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                         tabindex="0">
                        <div class="swiper mostSales">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    @include ("themes.theme1.blocks.items.item")
                                </div>
                                <div class="swiper-slide">Slide 2</div>
                                <div class="swiper-slide">Slide 3</div>
                                <div class="swiper-slide">Slide 4</div>
                                <div class="swiper-slide">Slide 5</div>
                                <div class="swiper-slide">Slide 6</div>
                                <div class="swiper-slide">Slide 7</div>
                                <div class="swiper-slide">Slide 8</div>
                            </div>

                        </div>
                        <div class="tab-most-prev"><i class="fa-solid fa-chevron-left"></i></div>
                        <div class="tab-most-next"><i class="fa-solid fa-chevron-right"></i></div>
                    </div>
                    <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab"
                         tabindex="0">
                        <div class="swiper editorChoice">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">Slide 1</div>
                                <div class="swiper-slide">Slide 2</div>
                                <div class="swiper-slide">Slide 3</div>
                                <div class="swiper-slide">Slide 4</div>
                                <div class="swiper-slide">Slide 5</div>
                                <div class="swiper-slide">Slide 6</div>
                                <div class="swiper-slide">Slide 7</div>
                                <div class="swiper-slide">Slide 8</div>
                            </div>

                        </div>
                        <div class="tab-editor-prev"><i class="fa-solid fa-chevron-left"></i></div>
                        <div class="tab-editor-next"><i class="fa-solid fa-chevron-right"></i></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
