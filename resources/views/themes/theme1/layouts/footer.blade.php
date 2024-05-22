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

                            @php
                                $logoPath = $setting->value['logo_path'];
                                $logoUrl = Storage::url($logoPath);
                            @endphp

                            <img src="{{ $logoUrl }}" alt="Logo">

                        </div>

                        <p>
                            {{ $setting->value['website_address'] }}
                        </p>
                    @endforeach

                    <ul class="social-accounts">




                        @foreach ($settings->where('type', 'social_media') as $setting)
                            <li><a href="{{ $setting->value['facebook'] }}"><i class="sicon-facebook"></i> Facebook</a></li>
                            <li><a href="{{ $setting->value['snapchat'] }}"><i class="sicon-snapchat"></i> Snapchat</a></li>
                            <li><a href="{{ $setting->value['instagram'] }}"><i class="sicon-instagram"></i> Instagram</a></li>
                            {{-- <li><a href="{{ $setting->value['facebook'] }}"><i class=""></i> Facebook</a></li> --}}
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
                                <a href="wishlist.php">
                                    <i class="fa-solid fa-angles-right"></i>
                                    <span>Wishlist</span>
                                </a>
                            </li>
                            <li>
                                <a href="my-account.php">
                                    <i class="fa-solid fa-angles-right"></i>
                                    <span>My Account</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="fa-solid fa-angles-right"></i>
                                    <span>Logout</span>
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
                                <a href="{{ route('page.show',  $page->id) }}">
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
                        <li>
                            <a href="">
                                <i class="sicon-whatsapp2"></i>
                                <span>{{ $setting->value['tel'] }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="sicon-iphone"></i>
                                <span>{{ $setting->value['whats_app'] }}</span>
                            </a>
                        </li>
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
