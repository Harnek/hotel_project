<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css?version=5') }}" />

    @yield('header_extras')
</head>
<body>
    @include('layouts.header')
    @yield('content')
    @include('layouts.footer')
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    @yield('footer_extras')
</body>
</html>
