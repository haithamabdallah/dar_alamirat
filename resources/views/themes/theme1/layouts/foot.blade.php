<script src="{{asset('theme1-assets/js/jquery-3.6.4.min.js')}}"></script>
<script src="{{asset('theme1-assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('theme1-assets/js/swiper-bundle.min.js')}}"></script>
<script src="{{asset('theme1-assets/js/app.js')}}"></script>
<script src="{{asset('theme1-assets/js/sweetalert2.all.min.js')}}"></script>
<script src="cdnjs.cloudflare.com/ajax/libs/jquery-jgrowl/1.4.8/jquery.jgrowl.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@20.2.0/build/js/intlTelInput.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://kit.fontawesome.com/24eabd5129.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Check if the popup has been shown before
        const hasPopupShown = localStorage.getItem('hasPopupShown');

        if (!hasPopupShown) {
            const newsletterPopup = document.getElementById('newsletterPopup');
            setTimeout(() => {
                newsletterPopup.classList.remove('hide');
            }, 2000);

            // Set the flag in local storage to prevent the popup from showing again
            localStorage.setItem('hasPopupShown', 'true');
        }

        const form = document.getElementById('newsletter-form');
        const subscribeDiv = document.getElementById('subscription');
        const successDiv = document.getElementById('NewsSuccess');

        form.addEventListener('submit', function(event) {
            // Handle form submission
            successDiv.classList.remove('hide');
            subscribeDiv.classList.add('hide');
        });

        const closeButtons = document.querySelectorAll('.closeNews');
        closeButtons.forEach(closeButton => {
            closeButton.addEventListener('click', function() {
                const popup = document.getElementById("newsletterPopup");
                popup.classList.add('hide');
            });
        });
    });
</script>

@yield('scripts')
