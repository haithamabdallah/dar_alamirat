<!-- resources/views/layouts/header.blade.php -->
<header id="header">

    @if (Session::has('success'))
    <div class="bg-success text-white p-2" id="flashSuccess" 
    style="position: fixed; top: 10vh; left: 5vw; width: fit-content; z-index: 9999; opacity: 0.8">{{ Session::get('success') }} <button class="text-white p-1" style="border: white solid 1px" onclick="document.getElementById('flashSuccess').style.display = 'none'">X</button></div>
    @endif
    @if (Session::has('error'))
    <div class="bg-danger text-white p-2" id="flashError" 
    style="position: fixed; top: 10vh; left: 5vw; width: fit-content; z-index: 9999; opacity: 0.8">{{ Session::get('error') }} <button class="text-white p-1" style="border: white solid 1px" onclick="document.getElementById('flashError').style.display = 'none'">X</button></div>
    @endif
    <div class="pixel-container">
        <div class="wrap">
            <div class="header d-flex justify-content-between align-items-center">
                <div class="logo">
                    @foreach ($settings->where('type', 'general') as $setting)
                        <a href="{{route('index')}}">
                            @php
                                $LogoPath = $setting->value['logo_path'] ?? null;
                                $LogoUrl = $LogoPath ? Storage::url($LogoPath) : null;
                            @endphp
                            @if($LogoUrl)
                                <img src="{{ $LogoUrl }}" alt="Logo">
                            @else
                                <h3>{{ $setting->value['website_name'] ?? '' }}</h3> <!-- Provide a default icon path if needed -->
                            @endif
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
                            <input class="s-search-input" type="text" placeholder="{{ __('Search') }}" name="query" id="product-search-input" onkeydown="if(event.key === 'Enter'){ this.form.submit(); return false; }">
                        </form>
                    </div>
                </div>

                <ul class="user-control d-flex">
                    @guest
                        <li>
                            <a class="d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#loginEmail">
                                <i class="icon sicon-user"></i>
                                <span class="d-flex flex-column">
                                <p> {{ __("My Account") }} </p>
                                <span> {{ __("Login") }} </span>
                            </span>
                            </a>
                        </li>
                    @endguest
                    @auth
                        <li>
                            <a href="{{ route('user.profile',auth()->user()->id) }}" class="d-flex align-items-center">
                                <i class="icon sicon-user"></i>
                                <span class="d-flex flex-column">
                                <p>{{ __("My Account") }}</p>
                                <span>{{ auth()->user()->FullName }}</span>
                            </span>
                            </a>
                        </li>
                    @endauth

                    <li>
                        <a href="{{ auth()->check() ?  route('cart.index') : route('guest.cart.index') }}" class="d-flex align-items-center">
                            <i class="icon sicon-shopping-bag"></i>

                            <span class="s-cart-summary-count" id="cart-summary-count" >{{ auth()->check() ? auth()->user()->carts->count() : (session('cartsCount') ?? 0) }}</span>
                            <span class="d-flex flex-column">
                                <p>{{ __("Cart") }}</p>
                                <span class="cart-amount" id="cart-summary-total" >{{ session('cartTotal') ? session('cartTotal') : 0}} {{ $currency }}</span>
                            </span>
                        </a>
                    </li>

                </ul>

            </div>
        </div>
    </div>
</header>

    @include('themes.theme1.partials.modals.email')
    @include('themes.theme1.partials.modals.otp')


<header id="mobileHeader">
    <div class="pixel-container">
        <div class="wrap">
            <div class="header d-flex justify-content-between align-items-center">
                <div class="navigate">
                    <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                        <i class="fa-solid fa-bars"></i>
                    </a>
                </div>

                <div class="logo">
                    @foreach ($settings->where('type', 'general') as $setting)
                        <a href="{{route('index')}}">
                            @php
                                $IconPath = $setting->value['icon_path'] ?? null;
                                $IconUrl = $IconPath ? Storage::url($IconPath) : null;
                            @endphp
                            @if($IconUrl)
                                <img src="{{ $IconUrl }}" alt="Icon">
                            @else
                                <h3>{{ $setting->value['website_name'] ?? '' }}</h3> <!-- Provide a default icon path if needed -->
                            @endif
                        </a>
                    @endforeach

                </div>


                <ul class="user-control d-flex">
                    <li>
                        <a href="{{ auth()->check() ?  route('cart.index') : route('guest.cart.index') }}" class="d-flex align-items-center">
                            <i class="icon sicon-shopping-bag"></i>

                            <span class="s-cart-summary-count" id="cart-summary-count-mob">{{ auth()->check() ? auth()->user()->carts->count() : (session('cartsCount') ?? 0) }}</span>
                            <span class="d-flex flex-column">
                                <p>{{ __("Cart") }}</p>
                                <span class="cart-amount" id="cart-summary-total-mob" >{{ session('cartTotal') ? session('cartTotal') : 0}} {{ $currency }}</span>
                            </span>
                        </a>
                    </li>

                </ul>

            </div>
        </div>
    </div>
</header>
