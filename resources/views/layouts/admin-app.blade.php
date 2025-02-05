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

<body>
    <div id="app" class="w-100">
        {{-- Menu lateral --}}
        <div class="d-flex flex-column flex-md-row">
            <aside class="order-md-first col-12 col-md-2">
                @include('partials.admin-menu')
            </aside>
            <main class="order-md-last col-12 col-md-10 py-4">
                @yield('content')
            </main>
        </div>
    </div>

    <footer class="py-4 text-center text-sm text-black dark:text-white/70">
        Javier Bravo Gutierrez -> ElorAdmin
    </footer>
</body>
</html>
