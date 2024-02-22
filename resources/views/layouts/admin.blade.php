<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- modificato -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="/favicon.ico" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'BDoctors - Dashboard') }}</title> --}}
    <title>BDoctors - Dashboard</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- BrainTree Drop-in --}}
    <script src="https://js.braintreegateway.com/web/dropin/1.42.0/js/dropin.min.js"></script>


    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])


</head>

<body>
    <div id="app">
        @include('partials.topbar')
        @include('partials.sidebar')

        <main>
            @yield('content')
        </main>
        @include('partials.footer')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>
