<!-- top bar -->
<section id="topbar">
    <div class="pixel-container">
        <div class="wrap">
            <div class="topbar">
                <div class="left">
                    <div class="lang">
                        <div class="dropdown">
                            <button class="select-lang" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="language">
                                    <!-- Display current language flag and name -->
                                    <img src="{{ asset('theme1-assets/images/flags/' . current_language() . '.png') }}" alt="">
                                    <span>{{ current_language() == 'en' ? 'English' : 'العربية' }}</span>
                                </span>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    @foreach (config('language') as $key => $lang)
                                        @if ($key != current_language())
                                            <a class="dropdown-item" href="{{ route('changeLang', ['lang' => $key]) }}">
                                            <span class="language">
                                                <img src="{{ asset('theme1-assets/images/flags/' . $key . '.png') }}" alt="">
                                                <span>{{ $lang }}</span>
                                            </span>
                                            </a>
                                        @endif
                                    @endforeach
                                </li>
                            </ul>
                        </div>
                    </div>
                    @foreach ($settings->where('type', 'general') as $setting)
                    @if (isset($setting->value['tel']))

                        <a href="{{  $setting->value['tel'] }}" class="topnav-link-item">
                            <i class="sicon-phone"></i>
                            <span class="">{{ $setting->value['tel'] }}</span>
                        </a>
                        @endif
                    @endforeach
                </div>
                <div class="right">
                    <ul>
                        @foreach ($pages as $page)
                            <li><a target="_self" href="{{ route('page.show', $page->id) }}" class="topnav-link-item">{{ $page->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ./top bar -->
