@extends('themes.theme3.layouts.app')

@section('crumbs')
    <!-- breadcrumbs container-->
    <div class="pixel-container">
        <!-- row -->
        <div class="wrap">
            <!-- content -->
            <ul class="breadcrumbs">
                <li>
                    <a href="{{route('index')}}">
                        <span>{{ __("Home") }}</span>
                    </a>
                </li>
                <li>
                    <span>{{ __("Brands") }}</span>
                </li>
            </ul>
            <!-- ./content -->
        </div>
        <!-- ./row -->
    </div>
    <!-- ./breadcrumbs container-->
@endsection

@section('content')

    <!-- brands Nav -->
    <nav id="brands-nav" style="overflow-y: scroll ; max-height: 300px">
        @for ($letter = 'A'; $letter <= 'Z'; $letter++)
            <a href="#section-{{$letter}}" class="" data-id="{{$letter}}">{{$letter}}</a>
            @if($letter == 'Z')
                    <?php break ?>
            @endif
        @endfor
    </nav>
    <!-- ./Brands Nav -->

    <h1 class="pixel-container text-center" style="margin-top :10rem"> {{ __("Brands") }} </h1>

    <!-- brands items -->
    <div class="pixel-container">
        <div class="wrap">
            <section class="s-block" id="section">
                @php
                    $groupedBrands = [];
                    foreach ($brands as $brand) {
                        $firstLetter = Str::upper($brand->name[0]);
                        $groupedBrands[$firstLetter][] = $brand;
                    }
                @endphp

                @foreach ($groupedBrands as $letter => $brandsByLetter)
                    <h2 id="section-{{$letter}}">{{$letter}}</h2>
                    <div class="section-brands">
                        <div class="s-brands-list">
                            @foreach ($brandsByLetter as $brand)
                                <a href="{{ route('brand', $brand->id) }}" class="brand-item">
                                    <img class="" src="{{ storage_asset($brand->image) }}" alt="{{ $brand->name }}">
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
                <!-- ./item -->
            </section>
        </div>
    </div>
    <!-- Brands items -->


@endsection
