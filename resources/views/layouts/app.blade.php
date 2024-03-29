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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        html, body {
            background-color: black;
            color: white;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }
        nav {
            background-color: black;
            color: white;
        }
        .navbar-brand, .navbar-nav, .nav-item {
            color: white;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('img/logo.png') }}" alt="Paperwork Rite Kennels" width="50" height="50">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (\Illuminate\Support\Facades\Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('about') }}">{{ __('About Us') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('pitbulls') }}">{{ __('Our Kennels') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('services') }}">{{ __('Our Services') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('contact') }}">{{ __('Contact Us') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    @hasrole('Admin')
                                        <a class="dropdown-item" href="{{ route('create-pitbull') }}">
                                            {{ __('Create Dog') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('create-service') }}">
                                            {{ __('Create Service') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('create-message') }}">
                                            {{ __('Send Text Message') }}
                                        </a>
                                    @endhasrole
                                    <a class="dropdown-item" href="{{ route('about') }}">
                                        {{ __('About Us') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('pitbulls') }}">
                                        {{ __('Our Kennels') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('services') }}">
                                        {{ __('Our Services') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('contact') }}">
                                        {{ __('Contact Us') }}
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

        <main class="p-2">
            @yield('content')
        </main>
    </div>
</body>
</html>
