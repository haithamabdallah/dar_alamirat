
<head>
    @yield('meta')

    <!-- icons -->
    <script src="https://kit.fontawesome.com/24eabd5129.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('theme1-assets/css/icons.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- bootstrap -->
    <link rel="stylesheet" href="{{asset('theme1-assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('theme1-assets/css/bootstrap.rtl.min.css')}}">
    <!-- libs -->
    <link rel="stylesheet" href="{{asset('theme1-assets/css/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{asset('theme1-assets/css/jquery.jgrowl.min.css')}}">
    <link rel="stylesheet" href="{{asset('theme1-assets/css/sweetalert2.min.css')}}">
    <!-- custom style -->
    <link rel="stylesheet" href="{{asset('theme1-assets/css/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('theme1-assets/cdnjs.cloudflare.com/ajax/libs/jquery-jgrowl/1.4.8/jquery.jgrowl.min.css')}}" />
    <link rel="stylesheet" href="{{asset('theme1-assets/css/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('theme1-assets/css/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{asset('theme1-assets/css/icons.css')}}">
    <!-- libs -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@20.2.0/build/css/intlTelInput.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- custom style -->

    @stack('head')

    @yield('customcss')
</head>
