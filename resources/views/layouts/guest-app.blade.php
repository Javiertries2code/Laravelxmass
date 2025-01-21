<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
@include('partials.logo')
<body>
    <div id="app" class="w-100">
        {{-- Menu lateral --}}
        <div class="d-flex flex-column flex-md-row">

            <main class="order-md-last col-12 col-md-10 py-4">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
