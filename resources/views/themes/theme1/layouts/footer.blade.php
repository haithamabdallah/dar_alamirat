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
                    <div class="logo">
                        <img src="{{asset('theme1-assets/images/logo/dar-logo3.svg')}}" alt="">
                    </div>
                    <p>The largest gathering in the Kingdom of beauty, care and salon products</p>
                    <ul class="social-accounts">
                        
                        @isset($socialMedia)


                        @foreach ( $socialMedia as $media)
                        <li><a href="{{ $media->value }}"><i class="{{ $media->icon }}"></i>{{ $media->name }} </a></li>
                        @endforeach
                        @endisset
                        {{-- <li><a href=""><i class="sicon-snapchat"></i></a></li> --}}
                        {{-- <li><a href=""><i class="sicon-tiktok"></i></a></li> --}}
                    </ul>
                </div>
                <!-- ./item -->
                <!-- item -->
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
                <!-- ./item -->
                <!-- item -->
                <div class="f-item">
                    <h3>Important Links</h3>
                    <ul>
                        <li>
                            <a href="terms.php">
                                <i class="fa-solid fa-angles-right"></i>
                                <span>Terms of use and privacy policy</span>
                            </a>
                        </li>
                        <li>
                            <a href="return-policy.php">
                                <i class="fa-solid fa-angles-right"></i>
                                <span>Return Policy</span>
                            </a>
                        </li>
                        <li>
                            <a href="shipping.php">
                                <i class="fa-solid fa-angles-right"></i>
                                <span>Shipping and delivery</span>
                            </a>
                        </li>
                        <li>
                            <a href="cashback.php">
                                <i class="fa-solid fa-angles-right"></i>
                                <span>Cashback,Princesses House</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- ./item -->
                <!-- item -->
                <div class="f-item">
                    <h3>Contact us</h3>
                    <ul class="social-icons">
                        <li>
                            <a href="">
                                <i class="sicon-whatsapp2"></i>
                                <span>920014688</span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="sicon-iphone"></i>
                                <span>920014688</span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="sicon-phone"></i>
                                <span>+966920014688</span>
                            </a>
                        </li>
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
