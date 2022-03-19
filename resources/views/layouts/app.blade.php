<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WETRA') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js" integrity="sha384-BOsAfwzjNJHrJ8cZidOg56tcQWfp6y72vEJ8xQ9w6Quywb24iOsW913URv1IS4GD" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/CardHeader.css') }}" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
</head>
<body>
    <div id="app">


        <nav class="navbar fixed-top navbar-expand-md navbar-dark p-0  shadow-sm" style="background-color:#800b37;">
            <div class="container">
            
                <!-- <a class="navbar-brand" href="{{ url('https://www.wetra.ca/') }}">
                    <h3>{{ config('app.name', 'Home') }}</h3>
                </a> -->
                <a class="navbar-brand" href="#">
                    <img src="/wetra/storage/logo-main-light-80H.png" alt="" width="60" height="45" style="margin-right:80px;">

                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                    @auth
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item {{ (request()->routeIs('messages.*')) ? 'active' : '' }}" >
                            <a class="navbar-brand"  href="{{ url('/messages') }}" style="color:{{ (request()->routeIs('messages.*')) ? 'gray' : '' }};">
                                Messages 
                            </a>
                            <!-- <a class="nav-link" href="{{ url('/messages') }}">Messages <span class="sr-only">(current)</span></a> -->
                        
                        </li>
                        <li class=" {{ (request()->is('schedule')) ? 'active' : '' }}">
                            <a class="navbar-brand" href="{{ url('/') }}">
                                Schedules
                            </a>
                        </li>
                        <li class=" {{ (request()->is('file')) ? 'active' : '' }}">
                            <a class="navbar-brand" href="{{ url('/') }}">
                                Files
                            </a>
                        </li>
                        @if(Auth::user()->is_admin == 1)
                            <li class=" {{ (request()->is('user')) ? 'active' : '' }}">
                                <a class="navbar-brand" href="{{ url('/') }}">
                                    Users
                                </a>
                            </li>
                        @endif
                    </ul>
                @endauth

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
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
                            
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <!-- <img src="storage/avatar_icon.svg" alt="" width="30" height="30" class="Test1" > -->
                                    <svg id="Avatar_Icon" data-name="Avatar Icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="30" height="30">
                                        <circle id="Ellipse_1" data-name="Ellipse 1" cx="25" cy="25" r="25" fill="green"/>
                                        <circle id="Ellipse_2" data-name="Ellipse 2" cx="5" cy="5" r="5" transform="translate(20 13)" fill="#fff"/>
                                        <path id="Path_8" data-name="Path 8" d="M14.99,0c8.188,0,18.333,2.867,14.826,5.5S23.165,10.934,14.99,11,3.421,7.708.164,5.5,6.8,0,14.99,0Z" transform="translate(10 27.678)" fill="#fff"/>
                                    </svg>
                                    {{ Auth::user()->first_name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
            <!-- <div class="p-5">
                {{ request()->routeIs('messages.*') }}
            </div> -->
            @yield('content')
        </main>
    </div>
</body>
</html>
