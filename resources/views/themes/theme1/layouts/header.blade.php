<!-- resources/views/layouts/header.blade.php -->
<header id="header">
    <div class="pixel-container">
        <div class="wrap">
            <div class="header d-flex justify-content-between align-items-center">
                <div class="logo">
                    @foreach ($settings->where('type', 'general') as $setting)
                        <a href="/">
                            @php
                                $IconPath = $setting->value['icon_path'];
                                $IconUrl = Storage::url($IconPath);
                            @endphp
                            <img src="{{ $IconUrl }}" alt="Icon">
                        </a>
                    @endforeach
                </div>
                <div class="d-flex flex-fill align-items-center navigate">
                    <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                        <i class="fa-solid fa-bars"></i>
                    </a>
                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <form id="search-form" action="{{ route('products.search') }}" method="GET">
                            <input class="s-search-input" type="text" placeholder="Search" name="query" id="product-search-input" onkeydown="if(event.key === 'Enter'){ this.form.submit(); return false; }">
                        </form>
                    </div>
                </div>

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
                            <a href="{{ route('user.profile',auth()->user()->id) }}" class="d-flex align-items-center">
                                <i class="icon sicon-user"></i>
                                <span class="d-flex flex-column">
                                <p>My Account</p>
                                <span>{{ auth()->user()->FullName }}</span>
                            </span>
                            </a>
                        </li>
                    @endauth

                    <li>
                        <a href="{{ route('cart.index') }}" class="d-flex align-items-center">
                            <i class="icon sicon-shopping-bag"></i>

                            <span class="s-cart-summary-count">{{auth()->check() ? auth()->user()->carts->count() : 0}}</span>
                            <span class="d-flex flex-column">
                                <p>Cart</p>
                                <span class="cart-amount">{{auth()->check() ? cartTotalPrice() : 0}} SAR</span>
                            </span>
                        </a>
                    </li>

                </ul>

            </div>
        </div>
    </div>
    @include('themes.theme1.partials.modals.email')
    @include('themes.theme1.partials.modals.otp')
</header>
