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
    <div id="app">
        {{-- HEADER --}}
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">

                @include('partials.logo')


                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- centro Side Of Navbar -->
                    <ul class="navbar-nav me-auto ms-auto d-none d-md-flex">

                        @if (Auth::user()->getRoleNames()->first() == 'student')
                            <li class="nav-item">
                                <a class="nav-link  {{ request()->routeIs('studentHome') ? 'active' : '' }}" href="{{ route('studentHome') }}">
                                    {{ __('Home') }}
                                </a>
                            </li>
                        @endif

                        @if (Auth::user()->getRoleNames()->first() == 'student')
                            <li class="nav-item">
                                <a class="nav-link  {{ request()->routeIs('meeting.mymeetings') ? 'active' : '' }}" href="{{ route('meeting.mymeetings') }}">
                                    {{ __('Mis reuniones') }}
                                </a>
                            </li>
                        @endif

                        @if (Auth::user()->can('student'))
                            <li class="nav-item">
                                <a class="nav-link  {{ request()->routeIs('teacher.listsTeachers') ? 'active' : '' }}" href="{{ route('teacher.listsTeachers') }}">
                                    {{ __('Mis profesores') }}
                                </a>
                            </li>
                        @endif

                        @if (Auth::user()->can('teacher'))
                            <li class="nav-item">
                                <a class="nav-link  {{ request()->routeIs('student.studentslist') ? 'active' : '' }}" href="{{ route('student.studentslist') }}">
                                    {{ __('Mis Alumnos') }}
                                </a>
                            </li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">


                                    @if (Auth::user()->getRoleNames()->first() == 'student')
                                        <a class="dropdown-item" href="{{ route('meeting.mymeetings') }}">
                                            {{ __('Mis reuniones') }}
                                        </a>
                                    @endif

                                    @if (Auth::user()->can('student'))
                                        <a class="dropdown-item" href="{{ route('teacher.listsTeachers') }}">
                                            {{ __('Mis profesores') }}
                                        </a>
                                    @endif

                                    @if (Auth::user()->can('teacher'))
                                        <a class="dropdown-item" href="{{ route('student.studentslist') }}">
                                            {{ __('Mis Alumnos') }}
                                        </a>
                                    @endif


                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>



    </div>
</body>

</html>
