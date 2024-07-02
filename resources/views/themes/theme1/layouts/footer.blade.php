<!-- footer -->
<footer id="footer">
    <!-- container -->
    <div class="pixel-container">
        <!-- row -->
        <div class="wrap ">
            <section class="newsletter">
                <div class="content">
                    <form action="{{ route('subscribe') }}" method="POST">
                        @csrf
                        <h2> {{ __("Subscribe to Our Newsletter") }}</h2>
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Enter your email" name="email">
                            <span class="input-group-btn">
                                <button class="btn" type="submit"> {{ __("Subscribe Now") }}</button>
                            </span>
                        </div>
                        @error('email')
                        <p class="text-danger h5 py-5">{{ $message }}</p>
                    @enderror
                </div>
            </section>
            <!-- content -->
            <div class="footer">
                <!-- item -->
                <div class="f-item">
                    @foreach ($settings->where('type', 'general') as $setting)
                        <div class="logo">
                            @if (isset($setting->value['logo_path']))
                                @php
                                    $logoPath = $setting->value['logo_path'];
                                    $logoUrl = Storage::url($logoPath);
                                @endphp
                                <img src="{{ $logoUrl }}" alt="Logo">
                            @endif
                        </div>

                        @if (isset($setting->value['website_address']))
                            <p style="padding: 0 !important">{{ $setting->value['website_address'] }}</p>
                        @endif
                    @endforeach

                    <ul class="social-accounts">
                        @foreach ($settings->where('type', 'social_media') as $setting)
                            @php
                                $socialMediaPlatforms = [
                                    'facebook' => 'sicon-facebook',
                                    'snapchat' => 'sicon-snapchat',
                                    'instagram' => 'sicon-instagram',
                                    'snapchat' => 'sicon-snapchat',
                                    'tiktok' => 'sicon-tiktok',
                                    'whatsapp' => 'sicon-whatsapp',
                                    'youtube' => 'sicon-youtube',
                                    'twitter' => 'sicon-twitter',
                                ];
                            @endphp
                            @foreach ($setting->value as $platform => $url)
                                @if (array_key_exists($platform, $socialMediaPlatforms) && !empty($url))
                                    <li>
                                        <a href="{{ $url }}">
                                            <i class="{{ $socialMediaPlatforms[$platform] }}"></i>

                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @endforeach

                        {{-- <li><a href=""><i class="sicon-snapchat"></i></a></li> --}}
                        {{-- <li><a href=""><i class="sicon-tiktok"></i></a></li> --}}
                    </ul>

                </div>
                <!-- ./item -->
                <!-- item -->
                @auth
                    <div class="f-item">
                        <h3>{{ __("My Account") }}</h3>
                        <ul>
                            <li>
                                <a href="notification.php">
                                    <i class="fa-solid fa-angles-right"></i>
                                    <span>{{ __("Notifications") }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('order.my') }}">
                                    <i class="fa-solid fa-angles-right"></i>
                                    <span>{{ __("Orders") }}</span>
                                </a>
                            </li>
                            {{-- <li>
                                <a href="pending_orders.php">
                                    <i class="fa-solid fa-angles-right"></i>
                                    <span>{{ __("Pending Payments") }}</span>
                                </a>
                            </li> --}}
                            <li>
                                <a href="{{ route('user.favorites') }}">
                                    <i class="fa-solid fa-angles-right"></i>
                                    <span>{{ __("Wishlist") }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.profile', auth()->user()->id) }}">
                                    <i class="fa-solid fa-angles-right"></i>
                                    <span>{{ __("My Account") }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <form action="{{ route('user.logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" style="background: none; border: none; cursor: pointer;">
                                            <i class="fa-solid fa-angles-right"></i>
                                            <span>{{ __("Logout") }}</span>
                                        </button>
                                    </form>
                                </a>
                            </li>
                        </ul>
                    </div>
            @endauth
            <!-- ./item -->
                <!-- item -->
                <div class="f-item">
                    <h3> {{ __("Important Links") }} </h3>
                    @foreach ($pages as $page)
                        <ul>
                            <li>
                                <a href="{{ route('page.show', $page->id) }}">
                                    <i class="fa-solid fa-angles-right"></i>
                                    <span>{{ $page->name }}</span>
                                </a>
                            </li>
                        </ul>
                    @endforeach
                </div>
                <!-- ./item -->
                <!-- item -->
                <div class="f-item">
                    <h3> {{ __("Contact Us") }} </h3>
                    <ul class="social-icons">
                        @foreach ($settings->where('type', 'general') as $setting)
                            @if (isset($setting->value['whats_app']))
                                <li>
                                    <a href="">
                                        <i class="sicon-whatsapp2"></i>
                                        <span>{{ $setting->value['whats_app'] }}</span>
                                    </a>
                                </li>
                            @endif

                            @if (isset($setting->value['tel']))
                                <li>
                                    <a href="">
                                        <i class="sicon-iphone"></i>
                                        <span>{{ $setting->value['tel'] }}</span>
                                    </a>
                                </li>
                            @endif

                            {{-- <li>
                                <a href="tel:+966920014688">
                                    <i class="sicon-phone"></i>
                                    <span>+966920014688</span>
                                </a>
                            </li> --}}
                        @endforeach

                    </ul>
                </div>
                <!-- ./item -->
            </div>
            <!-- ./content -->
        </div>
        <!-- ./row -->
    </div>
    <!-- ./container -->
</footer>
<!-- ./footer -->
