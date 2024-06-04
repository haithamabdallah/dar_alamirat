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
@yield('scripts')
