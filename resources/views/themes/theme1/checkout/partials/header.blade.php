  <!-- header -->
  <header class="header">
      <!-- logo -->
      <div class="logo">
            @foreach ($settings->where('type', 'general') as $setting)
                <a href="{{route('index')}}">
                    @php
                        $IconPath = $setting->value['icon_path'] ?? null;
                        $IconUrl = $IconPath ? Storage::url($IconPath) : null;
                    @endphp
                    @if($IconUrl)
                        <img src="{{ $IconUrl }}" alt="Icon">
                    @else
                        <h3>{{ $setting->value['website_name'] ?? '' }}</h3> <!-- Provide a default icon path if needed -->
                    @endif
                </a>
            @endforeach
      </div>
      <!-- ./logo -->

      <!-- heading -->
      <div class="heading">
          <!-- user -->
          <div class="user">
              {{ __("Hello") }}, <span>{{ auth()->user()->FullName }}</span>
          </div>
          <!-- ./user -->
          <!-- nav -->
          <ul class="breadcrumb">
              <li><a href="{{ route('index') }}">{{ __("Home") }}</a></li>
              <li><a href="{{ route('cart.index') }}">{{ __("My Cart") }}</a></li>
              <li>{{ __("Checkout") }}</li>
          </ul>
          <!-- ./nav -->
      </div>
      <!-- ./heading -->
  </header>
  <!--,./header -->
