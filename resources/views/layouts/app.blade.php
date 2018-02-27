<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Elections') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar is-transparent has-shadow">
            <div class="navbar-brand">
                <a class="navbar-item" href="/">
                    <span>ELECTIONS {{ date('Y') }}</span>
                </a>
                <div class="navbar-burger burger">
                <span></span>
                <span></span>
                <span></span>
                </div>
            </div>
            
            <div class="navbar-menu">
                <div class="navbar-start">
                    @if (Auth::guest())
                        <a class="navbar-item" href="{{ url('/') }}">
                            Home
                        </a>
                    @else
                        <div class="navbar-item has-dropdown is-hoverable">
                            <a class="navbar-link" href="#">
                            Users
                            </a>
                            <div class="navbar-dropdown is-boxed">
                                <a class="navbar-item" href="#">
                                    Manage
                                </a>
                                <a class="navbar-item" href="#">
                                    Modifiers
                                </a>
                                <hr class="navbar-divider">
                                <a class="navbar-item" href="#">
                                    Elements
                                </a>
                                <a class="navbar-item" href="#">
                                    Components
                                </a>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="navbar-end">
                    <div class="navbar-item">
                        <div class="field is-grouped">
                            @if (Auth::guest())
                                <p class="control">
                                    <a class="button is-primary" href="{{ route('login')}}">
                                    <span class="icon">
                                        <i class="fa fa-sign-in"></i>
                                    </span>
                                    <span>Sign in</span>
                                    </a>
                                </p>
                            @else
                                <div class="navbar-item has-dropdown is-hoverable">
                                    <a class="navbar-link" href="#">
                                    Hello User
                                    </a>
                                    <div class="navbar-dropdown is-right">
                                        <a class="navbar-item" href="#">
                                            <span class="icon">
                                                <i class="fa fa-user-circle"></i>
                                            </span>
                                            <span>Profile</span>
                                        </a>
                                        <a class="navbar-item" href="{{ route('home') }}">
                                            <span class="icon">
                                                <i class="fa fa-bars"></i>
                                            </span>
                                            <span>Dashboard</span>
                                        </a>
                                        <hr class="navbar-divider">
                                        <a class="navbar-item" href="{{ route('logout')}}">
                                            <span class="icon">
                                                <i class="fa fa-sign-out"></i>
                                            </span>
                                            <span>Logout</span>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <section class="section">
            <div class="container">
                @yield('content')
            </div>
        </section>
        
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
