<!DOCTYPE html>

@if (App::getLocale() == 'en')
    <html dir="ltr" lang="en">
@else
    <html dir="rtl" lang="ar">
@endif

<head>

    @section('meta')
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <title>Dar Alamirat</title>
    @endsection

    @include('themes.theme1.layouts.head')
</head>
<body class="ltr">
@include('themes.theme1.layouts.note')

@include('themes.theme1.layouts.topbar')

@include('themes.theme1.layouts.header')

@include('themes.theme1.layouts.sidemenu')

@yield('crumbs')

@yield('content')


@include('themes.theme1.layouts.footer')

@include('themes.theme1.layouts.foot')

</body>
</html>
