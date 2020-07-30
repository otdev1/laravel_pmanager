<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <base href="{{URL::asset('/')}}" target="_top">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,700,900|Roboto+Mono:300,400,500"> 
        <link rel="stylesheet" href="fonts/icomoon/style.css">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/magnific-popup.css">
        <link rel="stylesheet" href="css/jquery-ui.css">
        <link rel="stylesheet" href="css/owl.carousel.min.css">
        <link rel="stylesheet" href="css/owl.theme.default.min.css">
        <link rel="stylesheet" href="css/bootstrap-datepicker.css">
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
        <link rel="stylesheet" href="css/fl-bigmug-line.css">
        <link rel="stylesheet" href="css/aos.css">
        <link rel="stylesheet" href="css/style.css">

    </head>
    <body>
        <div id="app">
            <div class="site-wrap">
                <div class="site-mobile-menu">
                    <div class="site-mobile-menu-header">
                        <div class="site-mobile-menu-close mt-3">
                        <span class="icon-close2 js-menu-toggle"></span>
                        </div>
                    </div>
                    <div class="site-mobile-menu-body"></div>
                </div> 
                <header class="site-navbar py-1" role="banner">
                    <div class="container">
                        <div class="row align-items-center">
                        
                            <div class="col-6 col-xl-2">
                                <h1 class="mb-0"><a href="{{ url('/') }}" class="text-black h2 mb-0">P<strong>manager</strong></a></h1>
                            </div>

                            <div class="col-10 col-xl-10 d-none d-xl-block">
                                <nav class="site-navigation text-right" role="navigation">
                                    <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block">
                                        <li class="{{ (request()->is('/')) ? 'active' : '' }}"><a href="{{ url('/') }}">Home</a></li>
                                        <li class="has-children {{ (request()->is('companies*')) ? 'active' : '' }}">
                                        <a href="{{ route('companies.index') }}">Companies</a>
                                        <ul class="dropdown">
                                            <li><a href="/companies/mycompanies">My Companies</a></li>   
                                        </ul>
                                        </li>
                                        <li class="{{ (request()->is('roles*')) ? 'active' : '' }}">
                                            <a href="{{ route('roles.index') }}">Roles</a>
                                        </li>
                                        <li class="{{ (request()->is('users*')) ? 'active' : '' }}">
                                            <a href="{{ route('users.index') }}">Users</a>
                                        </li>
                                        @guest    
                                            <li class="{{ (request()->is('logIn')) ? 'active' : '' }}">
                                                <a href="/logIn">{{ __('Login') }}</a>
                                            </li>
                                            @if (Route::has('register'))
                                            <li class="{{ (request()->is('register')) ? 'active' : '' }}">
                                                <a  href="{{ route('register') }}">{{ __('Register') }}</a>
                                            </li>
                                            @endif
                                        @else   
                                        <li class="has-children">
                                            <a class="authuser-formatter">
                                                {{ Auth::user()->name }}
                                            </a>
                                            <ul class="dropdown user-submenu">
                                                <li>
                                                    <a href="{{ route('users.show', Auth::user()->id ) }}">
                                                    {{ __('View Profile') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('users.edit', Auth::user()->id ) }}">
                                                    {{ __('Edit Profile') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                                    document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                    </a>

                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                                </li>
                                            </ul>    
                                        </li>
                                        @endguest
                                    </ul>
                                </nav>
                            </div>
                            <div class="col-6 col-xl-2 text-right d-block">
                                <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="container"> 
                @include('partials.errors') 
                @include('partials.success') 
                </div>
                @yield('content')            
                <footer class="site-footer">
                    <div class="container">
                        <div class="row pt-5 mt-5 text-center">
                            <div class="col-md-12">
                                <p>
                                Copyright &copy; <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>document.write(new Date().getFullYear());</script> All Rights Reserved | This demo website is powered by Laravel | This template is made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>
        <script src="{{ asset('js/jquery-ui.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
        <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
        <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('js/aos.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
    </body>
</html>
