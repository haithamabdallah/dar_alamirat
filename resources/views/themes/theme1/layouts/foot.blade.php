<script src="{{asset('theme1-assets/js/jquery-3.6.4.min.js')}}"></script>
<script src="{{asset('theme1-assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('theme1-assets/js/swiper-bundle.min.js')}}"></script>
<script src="{{asset('theme1-assets/js/app.js')}}"></script>
<script src="{{asset('theme1-assets/js/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('theme1-assets/js/jquery.jgrowl.min.js')}}"></script>
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

</script>

@yield('scripts')
