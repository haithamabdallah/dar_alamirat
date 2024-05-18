<!-- header -->
<header id="header">
    <!-- container -->
    <div class="pixel-container">
        <!-- row -->
        <div class="wrap">
            <!-- contents -->
            <div class="header d-flex justify-content-between align-items-center">

                <!-- logo -->
                <div class="logo">
                    <a href="index.php">
                        <img src="{{asset('theme1-assets/images/logo/dar-logo3.svg')}}" alt="">
                    </a>
                </div>
                <!-- ./logo -->

                <!-- search -->
                <div class="d-flex flex-fill align-items-center navigate">
                    <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                        <i class="fa-solid fa-bars"></i>
                    </a>
                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input class="s-search-input" type="text" placeholder="Search">
                    </div>
                </div>
                <!-- ./search -->
                @guest
                <!-- user control -->
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
                            <i slot="icon" class="icon sicon-shopping-bag leading-none"></i>
                            <span class="s-cart-summary-count">0</span>
                            <span class="d-flex flex-column">
                                <p>Cart</p>
                                <span class="cart-amount">0 SAR</span>
                            </span>
                        </a>
                    </li>
                </ul>
                <!-- ./user control -->
                @endguest
            </div>
            <!-- ./contents -->
        </div>
        <!-- ./row -->
    </div>
    <!-- ./container -->
</header>
<!-- ./header -->


<!-- Modal -->
<div class="modal fade" id="loginEmail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="login-icon">
                    <i class="icon sicon-user"></i>
                </div>
                <h3>Login</h3>
                <form id="emailForm" action="{{ route('sendOtp') }}" method="POST">
                    @csrf
                    <label class="s-login-modal-label">Email Address</label>
                    <input type="email" name="email" placeholder="your@email.com" enterkeyhint="next" class="s-login-modal-input" required>
                    <button class="s-login-modal-enter-button" type="submit">
                        <span class="s-button-text">Enter</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="enterOtp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="login-icon">
                    <i class="icon sicon-user"></i>
                </div>
                <h3>Login</h3>
                <p class="s-verify-message">Verification code is required to proceed. A verification code has been sent to you</p>
                <div class="s-login-modal-currentEmail" id="writtenEmail">haitham@asd.com</div>
                <form id="otpForm" action="{{ route('verifyOtp') }}" method="POST">
                    @csrf
                    <div class="otp-field s-verify-codes">
                        <input type="text" id="otp1" name="otp[]" maxlength="1" class="s-verify-input" required />
                        <input type="text" id="otp2" name="otp[]" maxlength="1" class="s-verify-input" required />
                        <input type="text" id="otp3" name="otp[]" maxlength="1" class="s-verify-input" required />
                        <input type="text" id="otp4" name="otp[]" maxlength="1" class="s-verify-input" required />
                    </div>
                    <input type="hidden" name="email" id="otpEmail">
                    <button class="s-login-modal-enter-button" type="submit">
                        <span class="s-button-text">Verify</span>
                    </button>
                    <a href="#" class="s-verify-resend" id="resendOtp">Send</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#emailForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        var email = $('input[name="email"]').val();
                        $('#writtenEmail').text(email);
                        $('#otpEmail').val(email);
                        $('#enterOtp').modal('show');
                    }
                },
                error: function(xhr) {
                    alert('An error occurred. Please try again.');
                }
            });
        });

        $('#otpForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        alert('Verification successful!');
                        // Handle successful verification, e.g., redirect to dashboard
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    alert('An error occurred. Please try again.');
                }
            });
        });

        $('#resendOtp').on('click', function(e) {
            e.preventDefault();
            var email = $('#otpEmail').val();

            $.ajax({
                url: '{{ route("resendOtp") }}',
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: JSON.stringify({ email: email }),
                success: function(response) {
                    alert(response.message);
                },
                error: function(xhr) {
                    alert('An error occurred. Please try again.');
                }
            });
        });
    });
</script>
