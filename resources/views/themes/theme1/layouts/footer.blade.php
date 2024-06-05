<!-- footer -->
<footer id="footer">
    <!-- container -->
    <div class="pixel-container">
        <!-- row -->
        <div class="wrap">
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

    <p>
        @if (isset($setting->value['website_address']))
            {{ $setting->value['website_address'] }}
        @endif
    </p>
@endforeach


                    <ul class="social-accounts">
                        @foreach ($settings->where('type', 'social_media') as $setting)
                            @php
                                $socialMediaPlatforms = [
                                    'facebook' => 'sicon-facebook',
                                    'snapchat' => 'sicon-snapchat',
                                    'instagram' => 'sicon-instagram',
                                    'snapchat'=>'sicon-snapchat',
                                    'tiktok'=>'sicon-tiktok',
                                    'whatsapp' => 'sicon-whatsapp',
                                    'youtube'=>'sicon-youtube',
                                    'twitter'=>'sicon-twitter',
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
                    <div class="f-item f-my-account">
                        <h3>My Account</h3>
                        <ul>
                            <li>
                                <a href="notification.php">
                                    <i class="fa-solid fa-angles-right"></i>
                                    <span>Notifications</span>
                                </a>
                            </li>
                            <li>
                                <a href="orders.php">
                                    <i class="fa-solid fa-angles-right"></i>
                                    <span>Orders</span>
                                </a>
                            </li>
                            <li>
                                <a href="pending_orders.php">
                                    <i class="fa-solid fa-angles-right"></i>
                                    <span>Pending Payments</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.favorites') }}">
                                    <i class="fa-solid fa-angles-right"></i>
                                    <span>Wishlist</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.profile', auth()->user()->id) }}">
                                    <i class="fa-solid fa-angles-right"></i>
                                    <span>My Account</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <form action="{{ route('user.logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" style="background: none; border: none; cursor: pointer;">
                                            <i class="fa-solid fa-angles-right"></i>
                                            <span>Logout</span>
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
                    <h3>Important Links</h3>
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
                    <h3>Contact us</h3>
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

                        <li>
                            <a href="">
                                <i class="sicon-phone"></i>
                                <span>+966920014688</span>
                            </a>
                        </li>
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
