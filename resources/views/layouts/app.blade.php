<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/css/zabuto_calendar.min.css', 'resources/sass/icons.scss'])

    @vite(['resources/js/app.js', 'resources/js/zabuto_calendar.min.js'])

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Itim">

    <link rel="shortcut icon" href="/favicon.svg" type="image/x-icon">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <div class="navbar-brand">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="/favicon.svg" alt="System Logo" width="30" height="24"
                            class="d-inline-block align-text-top">
                        {{ __('Study Room Booking System') }}
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto d-md-none">
                        @auth
                            @include('components.navBarList')
                        @endauth
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
        <main class="py-4 d-flex">
            @auth
                <div class="d-none flex-column flex-shrink-0 p-3 bg-light d-md-flex" style="width: 280px;">
                    <div class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                        <span class="fs-4">{{ App\Enums\UserRolesEnum::getRoleName(auth()->user()->role_id) }}</span>
                    </div>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto">
                        @include('components.navBarList')
                    </ul>
                    <hr>
                </div>
            @endauth
            @yield('content')
        </main>
    </div>
    @yield('scripts')
</body>

</html>
