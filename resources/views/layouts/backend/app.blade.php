<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('backend/main.css') }}" rel="stylesheet">
    <!--toastr iziToast-->
    <link href="{{ asset('css/iziToast.css') }}" rel="stylesheet">
    {{-- custom css --}}
    <link href="{{ asset('backend/assets/css/custom.css') }}" rel="stylesheet">
    @stack('css')
</head>
<body>
    <div id="app" class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        @include('layouts.backend.partial.header')

        <div class="app-main">
            @include('layouts.backend.partial.sidebar')
            <div class="app-main__outer">
                <div class="app-main__inner">
                    @yield('content')
                </div>
                @include('layouts.backend.partial.footer')
            </div>
            <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('backend/assets/scripts/main.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <!--toastr iziToast-->
    <script src="{{asset('js/iziToast.js') }}"></script>
    @include('vendor.lara-izitoast.toast')
    {{-- Cusotm js --}}
    <script src="{{ asset('backend/assets/js/custom.js') }}"></script>
    @stack('js')
</body>
</html>
