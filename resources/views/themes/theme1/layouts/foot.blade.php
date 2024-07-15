<script src="{{asset('theme1-assets/js/jquery-3.6.4.min.js')}}"></script>
<script src="{{asset('theme1-assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('theme1-assets/js/swiper-bundle.min.js')}}"></script>
<script src="{{asset('theme1-assets/js/app.js')}}"></script>
<script src="{{asset('theme1-assets/js/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('theme1-assets/js/jquery.jgrowl.min.js')}}"></script>
<script src="{{asset('theme1-assets/js/jquery.magnific-popup.min.js')}}"></script>
{{-- <script src="{{asset('assets/js/app.js')}}"></script> // import jquery and axios --}}
<script src="{{asset('assets/js/axios.js')}}"></script>

<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://kit.fontawesome.com/24eabd5129.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@20.2.0/build/js/intlTelInput.min.js"></script>
<script src="https://kit.fontawesome.com/24eabd5129.js" crossorigin="anonymous"></script>




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
                    alert('{{ __("An error occurred. Please try again.") }}'  );
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
                    $('#otpError').text('{{ __("An error occurred. Please try again.") }}' ).show();
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
                $('#otpError').text(response.message || '{{ __("Invalid OTP. Please try again.") }}').show();
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
                    title: error.response.data.message == 'Unauthenticated.' ? ' {{ __("Unauthenticated") }}.  ' : '{{ __("Error") }}!',
                    text: error.response.data.message == 'Unauthenticated.' ? ' {{ __("you need to login first") }}  ' : error.response.data.message ,
                    icon: error.response.data.message == 'Unauthenticated.' ? ' "warning"  ' : ' "error"  ',
                    confirmButtonText: 'OK'
                });
            });
    }
</script>

{{--Add to cart --}}

<script>
    function addToCart(button , variantId) {
        const url = button.getAttribute('data-cart-url');

        // Set up the Axios request headers, including the CSRF token
        const data =
        {
            variantId : $('#variant-select').val() ?? $('input[type=radio][name="variant"]:checked').val() ?? variantId
            , quantity : $('#quantity').val() ?? 1
            , _token : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        };

        axios.post(url, data)
            .then(function (response) {
                console.log(response)
                const icon = response.data.status === 'danger' || response.data.status === 'error' ? 'warning' : 'success';
                // console.log(response)
                if (response.data.status === 'success') {
                    $('#cart-summary-count').text(response.data.cartCount);
                    $('#cart-summary-total').text(response.data.cartTotal + ' {!! $currency !!}');
                    $('#cart-summary-count-mob').text(response.data.cartCount);
                    $('#cart-summary-total-mob').text(response.data.cartTotal + ' {!! $currency !!}');

                    $.jGrowl(
                        response.data.message,
                        {
                            header: response.data.status === 'danger' || response.data.status === 'error' ? 'Oops...' : 'Success!',
                            theme:  'success',
                        });
                } else {
                    $.jGrowl(
                        response.data.message,
                        {
                            header: response.data.status === 'danger' || response.data.status === 'error' ? 'Oops...' : 'Success!',
                            theme:  'danger',
                        });
                }
            })
            .catch(function (error) {
                console.log(error.response)
                if (error.response ) {
                Swal.fire({
                        title:  "Error",
                        text:  error.response.data.message ,
                        icon: "error" ,
                        confirmButtonText: 'OK'
                    });
                }
            });
    }
</script>

{{-- Login --}}

<script>
    const data = [
        "Apple",
        "Banana",
        "Cherry",
        "Date",
        "Elderberry",
        "Fig",
        "Grape",
        "Honeydew"
    ];

    const searchBar = document.getElementById('product-search-input');
    const resultsList = document.getElementById('resultsList');
    const loadingIndicator = document.getElementById('loading');

    const performSearch = (query) => {
        resultsList.innerHTML = '';
        loadingIndicator.classList.remove('hidden');

        setTimeout(() => {
            if (query.length > 0) {
                const filteredResults = data.filter(item => {
                    const words = query.split(' ');
                    return words.every(word => item.toLowerCase().includes(word));
                });
                filteredResults.forEach(item => {
                    const listItem = document.createElement('li');
                    listItem.textContent = item;
                    resultsList.appendChild(listItem);
                });
            }
            loadingIndicator.classList.add('hidden');
        }, 500);  // Simulate a delay
    };

    searchBar.addEventListener('input', function() {
        const query = this.value.toLowerCase().trim();
        if (query.length === 0) {
            resultsList.innerHTML = '';
            loadingIndicator.classList.add('hidden');
        }
    });

    searchBar.addEventListener('keydown', function(event) {
        if (event.key === ' ') {
            const query = this.value.toLowerCase().trim();
            performSearch(query);
        }
    });
</script>


@yield('scripts')

@stack('scripts')
