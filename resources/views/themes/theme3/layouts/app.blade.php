<!DOCTYPE html>

@if (App::getLocale() == 'en')
    <html dir="ltr" lang="en">
@else
    <html dir="rtl" lang="ar">
@endif


    @section('meta')
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

        <title> {{ __("Dar Alamirat") }}</title>
    @endsection

    @include('themes.theme3.layouts.head')

    
<body>
@include('themes.theme3.layouts.note')

@include('themes.theme3.layouts.topbar')

@include('themes.theme3.layouts.header')

@include('themes.theme3.layouts.sidemenu')

@yield('crumbs')

@yield('content')


@include('themes.theme3.layouts.footer')

@include('themes.theme3.layouts.foot')

</body>
</html>
