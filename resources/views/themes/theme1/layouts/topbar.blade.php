<!-- top bar -->
<section id="topbar">
    <div class="pixel-container">
        <div class="wrap">
            <div class="topbar">
                <div class="left">
                    <div class="lang">
                        <div class="dropdown">
                            <button class="select-lang" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="language">
                                    <!-- Display current language flag and name -->
                                    <img src="{{ asset('theme1-assets/images/flags/' . current_language() . '.png') }}" alt="">
                                    <span>{{ current_language() == 'en' ? 'English' : 'العربية' }}</span>
                                </span>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    @foreach (config('language') as $key => $lang)
                                        @if ($key != current_language())
                                        <a class="dropdown-item" href="{{ route('changeLang', ['lang' => $key]) }}">
                                            <span class="language">
                                                <img src="{{ asset('theme1-assets/images/flags/' . $key . '.png') }}" alt="">
                                                <span>{{ $lang }}</span>
                                            </span>
                                        </a>
                                        @endif
                                    @endforeach
                                </li>
                            </ul>
                        </div>
                    </div>
                    <a href="tel:+966920014688" class="topnav-link-item">
                        <i class="sicon-phone"></i>
                        <span class="">+966920014688 </span>
                    </a>
                </div>
                <div class="right">
                    <ul>
                        <li><a target="_self" href="terms.php" class="topnav-link-item">Terms of use and privacy policy</a></li>
                        <li><a target="_self" href="return-policy.php" class="topnav-link-item">Return Policy</a></li>
                        <li><a target="_self" href="shipping.php" class="topnav-link-item">Shipping and delivery</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ./top bar -->
