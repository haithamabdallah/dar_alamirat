<script src="{{asset('theme1-assets/js/jquery-3.6.4.min.js')}}"></script>
<script src="{{asset('theme1-assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('theme1-assets/js/swiper-bundle.min.js')}}"></script>
<script src="{{asset('theme1-assets/js/app.js')}}"></script>
<script src="{{asset('theme1-assets/js/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('theme1-assets/js/jquery.jgrowl.min.js')}}"></script>
<script src="{{asset('theme1-assets/cdnjs.cloudflare.com/ajax/libs/jquery-jgrowl/1.4.8/jquery.jgrowl.min.js')}}"></script>
<script src="{{asset('theme1-assets/js/jquery.magnific-popup.min.js')}}"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://kit.fontawesome.com/24eabd5129.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@20.2.0/build/js/intlTelInput.min.js"></script>
<script src="https://kit.fontawesome.com/24eabd5129.js" crossorigin="anonymous"></script>










{{-- <script>
   const newsletterPopup = document.getElementById('newsletterPopup');
    const form = document.getElementById('newsletter-form');
    const subscribeDiv = document.getElementById('subscription');
    const successDiv = document.getElementById('NewsSuccess');

    setTimeout(() => {
        newsletterPopup.classList.remove('hide');
    }, 2000);

    form.addEventListener('submit', function(event) {

        successDiv.classList.remove('hide');
        subscribeDiv.classList.add('hide');
    });

    const closeButtons = document.querySelectorAll('.closeNews'); // Select all elements with class "closeNews"
    const popup = document.getElementById("newsletterPopup");

    closeButtons.forEach(closeButton => {
        closeButton.addEventListener('click', function() {
            popup.classList.add('hide'); // Add class "hide" to the popup element
        });
    });

</script> --}}


{{-- login --}}
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


{{--Favorits --}}
<script>
    function addToFavorites(url) {
        axios.post(url)
            .then(response => {
                location.reload()
            })
            .catch(error => {
                Swal.fire({
                    title: error.response.data.message == 'Unauthenticated.' ? 'Unauthenticated.' : 'Error!',
                    text: error.response.data.message == 'Unauthenticated.' ? 'you need to login first' : error.response.data.message ,
                    icon: error.response.data.message == 'Unauthenticated.' ? 'warning' : 'error',
                    confirmButtonText: 'OK'
                });
            });
    }
</script>

{{--Add to cart --}}

<script>
    function addToCart(button) {
        const url = button.getAttribute('data-cart-url');

        // Set up the Axios request headers, including the CSRF token
        const config = {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        };

        axios.post(url, config)
            .then(function (response) {
                const icon = response.data.status === 'danger' ? 'warning' : 'success';
                console.log(response)
                Swal.fire({
                    title: response.data.status === 'danger' ? 'Oops...' : 'Success!',
                    text: response.data.message,
                    icon: icon,
                    confirmButtonText: 'OK'
                });
            })
            .catch(function (error) {
                console.log(error.response.data)
                Swal.fire({
                    title: error.response.data.message == 'Unauthenticated.' ? 'Unauthenticated.' : 'Error!',
                    text: error.response.data.message == 'Unauthenticated.' ? 'you need to login first' : error.response.data.message ,
                    icon: error.response.data.message == 'Unauthenticated.' ? 'warning' : 'error',
                    confirmButtonText: 'OK'
                });
            });
    }
</script>

{{-- Login --}}


@yield('scripts')
