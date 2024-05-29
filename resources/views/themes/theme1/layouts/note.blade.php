<section id="note">
    <div class="pixel-container">
        <div class="wrap">
            @php
                $announcements = $settings->where('type', 'announcement');
            @endphp

            @forelse($announcements as $setting)
                <div class="alert alert-dismissible fade show" role="alert">
                    <div class="message">
                        <i class="sicon-banknote-dollar"></i>
                        <p>{{ $setting->value['announcement_message'] }}</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @empty
                <!-- No announcements, so nothing is displayed here -->
            @endforelse
        </div>
    </div>
</section>
