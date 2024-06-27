<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Main Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="user-control d-flex">
            @guest
                <li>
                    <a class="d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#loginEmail">
                        <i class="icon sicon-user"></i>
                        <span class="d-flex flex-column">
                            <p>My Account</p>
                            <span>Login</span>
                        </span>
                    </a>
                </li>
            @endguest
            @auth
                <li>
                    <a href="{{ route('user.profile', auth()->user()->id) }}" class="d-flex align-items-center">
                        <i class="icon sicon-user"></i>
                        <span class="d-flex flex-column">
                            <p>My Account</p>
                            <span>{{ auth()->user()->FullName }}</span>
                        </span>
                    </a>
                </li>
            @endauth
        </ul>

        <ul class="nav">
            @foreach (defaultCategory() as $category)
                @if ($category->childes->isNotEmpty())
                    <li class="nav__item">
                        <a class="nav__link"
                            href="{{ route('category.products', $category->id) }}">{{ $category->name }}<i
                                class="fas fa-chevron-right"></i></a>
                        <ul class="nav__sub">
                            @foreach ($category->childes as $child)
                                @if ($child->childes->isNotEmpty())
                                    <li class="nav__item">
                                        <a class="nav__link"
                                            href="{{ route('category.products', $child->id) }}">{{ $child->name }}<i
                                                class="fas fa-chevron-right"></i></a>
                                        <ul class="nav__sub">
                                            @foreach ($child->childes as $child2)
                                                @if ($child2->childes->isNotEmpty())
                                                    <li class="nav__item">
                                                        <a class="nav__link"
                                                            href="{{ route('category.products', $child2->id) }}">{{ $child2->name }}<i
                                                                class="fas fa-chevron-right"></i></a>
                                                        <ul class="nav__sub">
                                                            @foreach ($child2->childes as $child3)
                                                                <li class="nav__item">
                                                                    <a class="nav__link"
                                                                        href="{{ route('category.products', $child3->id) }}">{{ $child3->name }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @else
                                                    <li class="nav__item">
                                                        <a class="nav__link"
                                                            href="{{ route('category.products', $child2->id) }}">{{ $child2->name }}</a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li class="nav__item">
                                        <a class="nav__link"
                                            href="{{ route('category.products', $child->id) }}">{{ $child->name }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li class="nav__item">
                        <a class="nav__link"
                            href="{{ route('category.products', $category->id) }}">{{ $category->name }}</a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</div>
