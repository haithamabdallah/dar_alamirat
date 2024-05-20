<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Main Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="nav">
            {{--
                        <li class="nav__item">
                            <a class="nav__link" href="category.php">Makeups <i class="fas fa-chevron-right"></i></a>
                            <ul class="nav__sub">
                                <li class="nav__item">
                                    <a class="nav__link" href="category.php">Nail Polish<i class="fas fa-chevron-right"></i></a>
                                    <ul class="nav__sub">
                                        <li class="nav__item">
                                            <a class="nav__link" href="category.php">Lotion Cream</a>
                                        </li>
                                        <li class="nav__item">
                                            <a class="nav__link" href="category.php">Skin Lotion</a>
                                        </li>
                                        <li class="nav__item">
                                            <a class="nav__link" href="category.php">Skin exfoliators</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav__item">
                                    <a class="nav__link" href="category.php">Eye SHadows</a>
                                </li>
                                <li class="nav__item">
                                    <a class="nav__link" href="category.php">Bolver</a>
                                </li>
                                <li class="nav__item">
                                    <a class="nav__link" href="category.php">Makeup Brushes <i class="fas fa-chevron-right"></i></a>
                                    <ul class="nav__sub">
                                        <li class="nav__item">
                                            <a class="nav__link" href="category.php">Face Makeup Brushes</a>
                                        </li>
                                        <li class="nav__item">
                                            <a class="nav__link" href="category.php">Eye Makeup Brushes</a>
                                        </li>
                                        <li class="nav__item">
                                            <a class="nav__link" href="category.php">Eyebrow Makeup Brushes</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
            --}}
            @foreach(defaultCategory() as $category)
                <li class="nav__item">
                    <a class="nav__link" href="{{route('front.category')}}">{{$category->name}}</a>
                </li>
            @endforeach
            {{--            <li class="nav__item">
                            <a class="nav__link" href="category.php">Care Groups<i class="fas fa-chevron-right"></i></a>
                            <ul class="nav__sub">
                                <li class="nav__item">
                                    <a class="nav__link" href="category.php">View All</a>
                                </li>
                                <li class="nav__item">
                                    <a class="nav__link" href="category.php">Some By me Collection</i></a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav__item">
                            <a class="nav__link" href="category.php">Care <i class="fas fa-chevron-right"></i></a>
                            <ul class="nav__sub">
                                <li class="nav__item">
                                    <a class="nav__link" href="category.php">Skin Care <i class="fas fa-chevron-right"></i></a>
                                    <ul class="nav__sub">
                                        <li class="nav__item">
                                            <a class="nav__link" href="category.php">Lotion Cream</a>
                                        </li>
                                        <li class="nav__item">
                                            <a class="nav__link" href="category.php">Skin Lotion</a>
                                        </li>
                                        <li class="nav__item">
                                            <a class="nav__link" href="category.php">Skin exfoliators</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav__item">
                                    <a class="nav__link" href="category.php">Facial Care</a>
                                </li>
                                <li class="nav__item">
                                    <a class="nav__link" href="category.php">Hand Care</a>
                                </li>
                                <li class="nav__item">
                                    <a class="nav__link" href="category.php">Body Care <i class="fas fa-chevron-right"></i></a>
                                    <ul class="nav__sub">
                                        <li class="nav__item">
                                            <a class="nav__link" href="category.php">Body Lotion</a>
                                        </li>
                                        <li class="nav__item">
                                            <a class="nav__link" href="category.php">Body Oils</a>
                                        </li>
                                        <li class="nav__item">
                                            <a class="nav__link" href="category.php">Body Scrubs</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>--}}

        </ul>
    </div>
</div>
