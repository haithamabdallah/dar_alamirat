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
    $(document).ready(function() {
        const $searchBar = $('.s-search-input');
        const $resultsList = $('#resultsList');
        const $loadingIndicator = $('#loading');
        const $closeBtn = $('.close-btn').addClass('hidden');
        const debounceTime = 500;
        let typingTimer;

        const getProducts = (query, language) => {
            $loadingIndicator.removeClass('hidden');
            axios.post('{{ route('products.searching') }}', { search: query, lang: language })
                .then(response => {
                    //console.log('API response:', response.data);
                    displayResults(response.data.products, language);
                    $loadingIndicator.addClass('hidden');
                    if (response.data.products.length > 0) {
                        $closeBtn.removeClass('hidden');
                    } else {
                        $closeBtn.addClass('hidden');
                    }
                })
                .catch(error => {
                    console.error('API error:', error);
                    $resultsList.empty().append('<li>Error loading results</li>');
                    $loadingIndicator.addClass('hidden');
                    $closeBtn.addClass('hidden');
                });
        };

        const displayResults = (products, language) => {
            $resultsList.empty();
            if (products.length > 0) {
                products.forEach(product => {
                    const listItem = $('<li></li>');
                    const itemDiv = $('<div class="item"></div>');

                    const imgDiv = $('<div class="img"></div>');
                    const img = $('<img>').attr('src', product.thumbnail).attr('alt', product.title[language]); // Adjust with actual data fields
                    imgDiv.append(img);

                    const dataDiv = $('<div class="data"></div>');
                    const titleLink = $('<a></a>').attr('href', `{{ route('product', '') }}/${product.id}`).text(product.title[language]);
                    const title = $('<h4></h4>').append(titleLink);
                    const price = $('<p></p>').text(product.price);
                    dataDiv.append(title, price);

                    itemDiv.append(imgDiv, dataDiv);
                    listItem.append(itemDiv);

                    $resultsList.append(listItem);
                });
                $closeBtn.removeClass('hidden');
            } else {
                $resultsList.append('<li>No results found</li>');
                $closeBtn.addClass('hidden');
            }
        };

        const isArabic = (text) => {
            const arabicRegex = /[\u0600-\u06FF]/;
            return arabicRegex.test(text);
        };

        $searchBar.on('input', function() {
            const query = $(this).val().trim();
            const language = isArabic(query) ? 'ar' : 'en';
            clearTimeout(typingTimer);
            if (query.length > 0) {
                typingTimer = setTimeout(() => {
                    getProducts(query, language);
                }, debounceTime);
            } else {
                $resultsList.empty();
                $loadingIndicator.addClass('hidden');
                $closeBtn.addClass('hidden'); // Hide the close button when input is empty
            }
        });

        $closeBtn.on('click', function() {
            $searchBar.val(''); // Clear the input field
            $resultsList.empty(); // Clear the results list
            $loadingIndicator.addClass('hidden'); // Hide the loading indicator
            $closeBtn.addClass('hidden'); // Hide the close button again
        });
    });

</script>

@yield('scripts')

@stack('scripts')
