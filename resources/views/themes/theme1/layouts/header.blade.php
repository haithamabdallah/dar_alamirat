<!-- resources/views/layouts/header.blade.php -->
<header id="header">
    <div class="pixel-container">
        <div class="wrap">
            <div class="header d-flex justify-content-between align-items-center">
                <div class="logo">
                    @foreach ($settings->where('type', 'general') as $setting)
                        <a href="index.php">
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
                            <span class="s-cart-summary-count">{{auth()->user()->carts->count()}}</span>
                            <span class="d-flex flex-column">
                                <p>Cart</p>
                                <span class="cart-amount">{{cartTotalPrice()}} SAR</span>
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

@section('scripts')

<script>
    $(document).ready(function() {
        // Handle email form submission
        $('#emailForm').on('submit', function(e) {
            e.preventDefault();
            sendOtp();
        });

        // Handle OTP input fields
        $('.s-verify-input').on('input', function() {
            if (isOtpComplete()) {
                verifyOtp();
            }
        });

        // Function to send OTP
        function sendOtp() {
            $.ajax({
                url: '{{ route("sendOtp") }}',
                method: 'POST',
                data: $('#emailForm').serialize(),
                success: function(response) {
                    handleOtpSent(response);
                },
                error: function() {
                    alert('An error occurred. Please try again.');
                }
            });
        }

        // Function to handle OTP sent response
        function handleOtpSent(response) {
            if (response.success) {
                var email = $('input[name="email"]').val();
                $('#writtenEmail').text(email);
                $('#otpEmail').val(email);
                $('#loginEmail').modal('hide');
                $('#enterOtp').modal('show');
            } else {
                alert(response.message);
            }
        }

        // Function to check if OTP is complete
        function isOtpComplete() {
            var otp = '';
            $('.s-verify-input').each(function() {
                otp += $(this).val();
            });
            return otp.length === 4;
        }

        // Function to verify OTP
        function verifyOtp() {
            var formData = $('#otpForm').serialize();
            $.ajax({
                url: '{{ route("verifyOtp") }}',
                method: 'POST',
                data: formData,
                success: function(response) {
                    handleOtpVerification(response);
                },
                error: function() {
                    $('#otpError').text('An error occurred. Please try again.').show();
                }
            });
        }

        // Function to handle OTP verification response
        function handleOtpVerification(response) {
            if (response.success) {
                $('#enterOtp').modal('hide');
                // Redirect to the same page to refresh after successful login
                window.location.reload();
            } else {
                $('#otpError').text(response.message || 'Invalid OTP. Please try again.').show();
            }
        }
    });
</script>


@endsection
