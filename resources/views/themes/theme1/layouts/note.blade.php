<section id="note">
    <div class="pixel-container">
        <div class="wrap">
            <div class="alert alert-dismissible fade show" role="alert">
                <div class="message">
                    <i class="sicon-banknote-dollar"></i>


                    @foreach($settings->where('type', 'announcement') as $setting)
                    <p>
                        {{ $setting->value['announcement_message'] }}

                    </p>
                    @endforeach
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
</section>
