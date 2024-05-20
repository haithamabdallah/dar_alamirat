{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Login System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">

</head>
<body> --}}
    <!-- Header -->
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
                            <input class="s-search-input" type="text" placeholder="Search">
                        </div>
                    </div>
                    @guest
                    <ul class="user-control d-flex">
                        <li>
                            <a class="d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#loginEmail">
                                <i class="icon sicon-user"></i>
                                <span class="d-flex flex-column">
                                    <p>My Account</p>
                                    <span>Login</span>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="cart.php" class="d-flex align-items-center">
                                <i class="icon sicon-shopping-bag"></i>
                                <span class="s-cart-summary-count">0</span>
                                <span class="d-flex flex-column">
                                    <p>Cart</p>
                                    <span class="cart-amount">0 SAR</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                    @endguest
                </div>
            </div>
        </div>
    </header>

    <!-- Email Modal -->
    <div class="modal fade" id="loginEmail" tabindex="-1" aria-labelledby="loginEmailLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="login-icon">
                        <i class="icon sicon-user"></i>
                    </div>
                    <h3>Login</h3>
                    <form id="emailForm">
                        @csrf
                        <label class="s-login-modal-label">Email Address</label>
                        <input type="email" placeholder="your@email.com" class="s-login-modal-input" name="email" required>
                        <button class="s-login-modal-enter-button" type="submit">
                            <span class="s-button-text">Enter</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- OTP Modal -->
    <div class="modal fade" id="enterOtp" tabindex="-1" aria-labelledby="enterOtpLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="login-icon">
                        <i class="icon sicon-user"></i>
                    </div>
                    <h3>Login</h3>
                    <p class="s-verify-message">Verification code is required to proceed. A verification code has been sent to you.</p>
                    <div class="s-login-modal-currentEmail" id="writtenEmail"></div>
                    <form id="otpForm" method="POST">
                        @csrf
                        <input type="hidden" name="email" id="otpEmail">
                        <div class="otp-field s-verify-codes">
                            <input type="text" name="otp[]" maxlength="1" class="s-verify-input" required />
                            <input type="text" name="otp[]" maxlength="1" class="s-verify-input" required />
                            <input type="text" name="otp[]" maxlength="1" class="s-verify-input" required />
                            <input type="text" name="otp[]" maxlength="1" class="s-verify-input" required />
                        </div>
                        <button class="s-login-modal-enter-button" type="submit">
                            <span class="s-button-text">Verify</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Include your Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AJAX Script -->
    <script>
        $(document).ready(function() {
            $('#emailForm').on('submit', function(e) {
                e.preventDefault();
                console.log('Email form submitted');

                $.ajax({
                    url: '{{ route("sendOtp") }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        console.log('Send OTP response:', response);
                        if (response.success) {
                            var email = $('input[name="email"]').val();
                            $('#writtenEmail').text(email);
                            $('#otpEmail').val(email);
                            $('#loginEmail').modal('hide');
                            $('#enterOtp').modal('show');
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        console.log('Send OTP error:', xhr);
                        alert('An error occurred. Please try again.');
                    }
                });
            });

            $('#otpForm').on('submit', function(e) {
                e.preventDefault();
                console.log('OTP form submitted');

                $.ajax({
                    url: '{{ route("verifyOtp") }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        console.log('Verify OTP response:', response);
                        if (response.success) {
                            alert('Login successful!');
                            window.location.href = '{{ route("cart-empty") }}'; // Adjust the redirect URL to your needs
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        console.log('Verify OTP error:', xhr);
                        alert('An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>

