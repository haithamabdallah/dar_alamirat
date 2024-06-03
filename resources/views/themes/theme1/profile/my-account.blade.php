@extends('themes.theme1.layouts.app')

@section('customcss')
    <link rel="stylesheet" href="{{ asset('theme1-assets/css/intlTelInput.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme1-assets/css/faltpicker.min.css') }}">
@endsection

@section('content')
<!-- cover -->
<section class="user-cover">
    <div class="pixel-container">
        <div class="wrap">
            <div class="cover-contents">
                <!-- breadcrumbs container-->
                <div class="pixel-container">
                    <!-- row -->
                    <div class="wrap">
                        <!-- content -->

                        <ul class="breadcrumbs">
                            <li>
                                <a href="{{ route('index') }}">
                                    <span>Home</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <span>My Account</span>
                                </a>
                            </li>

                        </ul>
                        <!-- ./content -->
                    </div>
                    <!-- ./row -->
                </div>
                <!-- ./breadcrumbs container-->
            </div>
        </div>
    </div>
</section>
<!-- ./cover -->

<!-- user-layout -->
<section class="user-page-layout">
    <div class="pixel-container">
        <div class="wrap">
            <div class="user-layout">
                @include('themes.theme1.profile.profile_aside')
                <main>
                    <h1>My Account</h1>
                    @if(session('success'))
                        <div id="alert" class="alert" style="display: none;">
                            <div id="progress-bar" class="progress-bar"></div>
                            <div class="alert-message">{{ session('success') }}</div>
                        </div>
                    @endif

                    <form action="{{ route('user.updateProfile', $user) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="account-form">
                            <div class="ac-item">
                                <label for="first-name">First Name</label>
                                <input type="text" name="first_name" id="first-name" placeholder="First Name" required class="form-input" value="{{ old('first_name', $user->first_name) }}">
                                @error('first_name')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="ac-item">
                                <label for="last-name">Last Name</label>
                                <input type="text" name="last_name" id="last-name" placeholder="Last Name" required class="form-input" value="{{ old('last_name', $user->last_name) }}">
                                @error('last_name')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="ac-item">
                                <label for="birthday">Birth Date</label>
                                <input class="flatpickr flatpickr-input s-datetime-picker-input" type="text" name="birthday" placeholder="Select Date.." readonly="readonly" value="{{ old('birthday', $user->birthday) }}">
                                @error('birthday')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="ac-item">
                                <label for="gender">Gender</label>
                                <select class="form-input" name="gender" required>
                                    <option value="" disabled selected>Select Gender</option>
                                    <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('gender')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="ac-item">
                                <label for="email">Email Address</label>
                                <input type="email" name="email" id="email" class="form-input" required placeholder="Email Address" value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="ac-item">
                                <label for="phone">Mobile Number</label>
                                <input id="phone" type="tel" name="phone_number" class="s-tel-input-control" value="{{ old('phone_number', $user->phone_number) }}">
                                @error('phone_number')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="w-full">
                            <button type="submit" loader-position="end" class="w-full mt-6 sm:mt-8 s-button-element s-button-btn s-button-solid s-button-primary s-button-loader-end">
                                <span class="s-button-text">Save</span>
                            </button>
                        </div>
                    </form>


                    {{--<div class="promotion">
                        <a class="s-list-tile-item" target="_self">
                            <div class="s-list-tile-item-icon">
                                <div slot="icon" class="s-user-settings-section-icon">
                                    <span><!-- Generated by IcoMoon.io -->
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                            <title>bullhorn</title>
                                            <path d="M30.129 0.264c-0.339-0.252-0.776-0.328-1.179-0.208l-24.951 7.485v-0.216c0-0.736-0.597-1.333-1.333-1.333s-1.333 0.597-1.333 1.333v14.667c0 0.736 0.597 1.333 1.333 1.333s1.333-0.597 1.333-1.333v-0.112l3.448 1.207-0.595 1.704c-0.321 1.019-0.227 2.103 0.267 3.051s1.327 1.647 2.345 1.968l6.359 2.004c0.399 0.127 0.804 0.187 1.201 0.187 1.699 0 3.277-1.091 3.812-2.785l0.423-1.295 7.633 2.672c0.143 0.049 0.292 0.075 0.44 0.075 0.273 0 0.543-0.084 0.772-0.247 0.352-0.249 0.561-0.655 0.561-1.087v-28c0-0.421-0.199-0.819-0.537-1.069zM18.297 28.4c-0.221 0.701-0.973 1.089-1.673 0.871l-6.357-2.004c-0.34-0.108-0.617-0.34-0.781-0.656s-0.196-0.676-0.101-0.977l0.581-1.665 8.777 3.072zM28 27.453l-24-8.4v-8.728l24-7.2z"></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="s-list-tile-item-content">
                                <div class="s-list-tile-item-title">
                                    <div slot="title" class="s-user-settings-section-title">Promotional messages</div>
                                </div>
                                <div class="s-list-tile-item-subtitle">
                                    <div slot="subtitle" class="s-user-settings-section-subtitle">You can control disabling or activating the promotional messages that appear when you visit the store.</div>
                                </div>
                            </div>
                            <div class="s-list-tile-item-action">
                                <div slot="action" class="s-user-settings-section-action">
                                    <label class="s-toggle">
                                        <input class="s-toggle-input" type="checkbox">
                                        <div class="s-toggle-switcher"></div>
                                    </label>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="promotion">
                        <a class="s-list-tile-item" target="_self">
                            <div class="s-list-tile-item-icon">
                                <div slot="icon" class="s-user-settings-section-icon">
                                    <span>
                                        <!-- Generated by IcoMoon.io -->
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                            <title>user-off</title>
                                            <path d="M10.837 19.309c-4.963 1.284-8.171 4.303-8.171 7.691v3.667c0 0.736 0.597 1.333 1.333 1.333s1.333-0.597 1.333-1.333v-3.667c0-2.101 2.48-4.155 6.172-5.109 0.713-0.184 1.141-0.912 0.957-1.625-0.184-0.711-0.908-1.137-1.625-0.956zM12.859 3.715c0.933-0.685 2.020-1.048 3.141-1.048 2.941 0 5.333 2.392 5.333 5.333 0 1.121-0.363 2.208-1.048 3.141-0.436 0.593-0.308 1.428 0.284 1.864 0.239 0.175 0.515 0.259 0.788 0.259 0.411 0 0.815-0.188 1.076-0.544 1.025-1.393 1.567-3.025 1.567-4.72 0-4.412-3.588-8-8-8-1.695 0-3.327 0.541-4.721 1.567-0.592 0.435-0.72 1.269-0.284 1.864 0.436 0.593 1.269 0.721 1.864 0.284zM31.609 29.724l-29.333-29.333c-0.521-0.521-1.364-0.521-1.885 0s-0.521 1.364 0 1.885l29.333 29.333c0.26 0.26 0.601 0.391 0.943 0.391s0.683-0.131 0.943-0.391c0.521-0.521 0.521-1.364 0-1.885z"></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="s-list-tile-item-content">
                                <div class="s-list-tile-item-title">
                                    <div slot="title" class="s-user-settings-section-title">Deactivate account</div>
                                </div>
                                <div class="s-list-tile-item-subtitle">
                                    <div slot="subtitle" class="s-user-settings-section-subtitle">You can delete your account from the store, which includes your previous orders, favorites.</div>
                                </div>
                            </div>
                            <div class="s-list-tile-item-action">
                                <div slot="action" class="s-user-settings-section-action">
                                    <button type="button" class="undefined s-button-element s-button-btn s-button-outline s-button-danger-outline s-button-loader-after">
                                        <span class="s-button-text">Deactivate account</span>
                                    </button>
                                </div>
                            </div>
                        </a>
                    </div>--}}

                </main>
            </div>
        </div>
    </div>
</section>
<!-- ./user-layout -->

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var alertBox = document.getElementById('alert');
        var progressBar = document.getElementById('progress-bar');
        var message = document.querySelector('.alert-message');

        // Show the alert
        alertBox.style.display = 'block';

        // Set background color for the alert
        alertBox.style.backgroundColor = '#28a745'; // Green color for success

        // Set background color for the progress bar
        progressBar.style.backgroundColor = '#ffc107'; // Yellow color for progress

        // Set text color for the message
        message.style.color = '#fff'; // White text color for visibility

        // Set progress bar width to 0 initially
        progressBar.style.width = '0%';

        // Animate progress bar
        var width = 0;
        var animationInterval = setInterval(function () {
            if (width >= 100) {
                clearInterval(animationInterval);
                // Hide the alert after animation completes
                setTimeout(function () {
                    alertBox.style.display = 'none';
                }, 1000);
            } else {
                width += 1;
                progressBar.style.width = width + '%';
            }
        }, 30);
    });
</script>

<script src="{{ asset('theme1-assets/js/intlTelInput.min.js') }}"></script>

<script>
    const input = document.querySelector("#phone");
    window.intlTelInput(input, {
        showSelectedDialCode: true,
        initialCountry: "auto",
        geoIpLookup: function(callback) {
            fetch("https://ipapi.co/json")
                .then(function(res) { return res.json(); })
                .then(function(data) { callback(data.country_code); })
                .catch(function() { callback(); });
        },
        utilsScript: "{{ asset('theme1-assets/js/utils.js') }}",
    });
</script>

@endsection

<script src="{{ asset('theme1-assets/js/intlTelInput.min.js') }}"></script>
<script>
    const phone = document.querySelector("#phone");
    window.intlTelInput(phone, {
        showSelectedDialCode: true,
        initialCountry: "auto",
        geoIpLookup: function(callback) {
            fetch("https://ipapi.co/json")
                .then(function(res) { return res.json(); })
                .then(function(data) { callback(data.country_code); })
                .catch(function() { callback(); });
        },
        utilsScript: "{{ asset('theme1-assets/js/utils.js') }}",
    });
</script>

<script>
    const whatsapp = document.querySelector("#whatsapp");
    window.intlTelInput(whatsapp, {
        showSelectedDialCode: true,
        initialCountry: "auto",
        geoIpLookup: function(callback) {
            fetch("https://ipapi.co/json")
                .then(function(res) { return res.json(); })
                .then(function(data) { callback(data.country_code); })
                .catch(function() { callback(); });
        },
        utilsScript: "{{ asset('theme1-assets/js/utils.js') }}",
    });
</script>
