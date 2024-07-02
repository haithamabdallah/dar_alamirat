
<section id="newsletterPopup" class="hide">
    <div class="newContent">
        <a href="javascript:;" class="closeNews close-btn"><i class="fa-solid fa-xmark"></i></a>
        <div class="newsImage">
            <img src="{{ asset('assets/images/newsletter/newsletter.jpg') }}" alt="">
        </div>
        <div id="subscription">
            <h3>{{ __("Sign Up For") }}</h3>
            <h1>25% {{ __("OFF") }}</h1>
            <p>{{ __("Subscribe to our newsletter for exclusive beauty tips, new product launches, and special offers.") }}</p>
            <form id="newsletter-form" action="{{ route('subscribe') }}" method="POST">
                @csrf
                <input type="email" name="email" placeholder="Enter your email address" required>
                <button type="submit">{{ __("Subscribe Now") }}</button>
            </form>
            <a class="closeNews" href="javascript:;">{{ __("No, thanks") }}</a>
            <p>{{ __("By entering, you agree to the") }} <a href="#">{{ __("Terms of Use") }}</a> {{ __("and") }} <a href="#">{{ __("Privacy Policy") }}</a></p>
        </div>
     </div>
 </section>
