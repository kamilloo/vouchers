<!DOCTYPE html>
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
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="/open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">
</head>
<body>
    <div id="app" class="min-vh-100 pb-5">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarServices" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('Services') }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('service-categories.index') }}">{{ __('Service Categories') }}</a>
                                <a class="dropdown-item" href="{{ route('service-packages.index') }}">{{ __('Service Packages') }}</a>
                                <a class="dropdown-item" href="{{ route('services.index') }}">{{ __('Service') }}</a>
                            </div>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('vouchers.index') }}">{{ __('My Vouchers') }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('shop.index') }}">{{ __('Shop') }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('payments.index') }}">{{ __('Payments') }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('orders.index') }}">{{ __('Orders') }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('wizard') }}">{{ __('Wizard') }}</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile.index') }}">
                                        {{ __('Profile') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4" class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    @include('layouts.flash-message')

                </div>
            </div>
            @yield('content')
        </main>
    </div>
    <footer class="pt-2 border-top bg-light mt-n5">
        <div class="container-fluid">
            <div class="col-sm text-center mb-3">
                <img class="img-fluid" src="{{ config('app.name', 'Voucher') }}" alt="Voucher" width="24" height="24">
                <span class="text-muted">© {{ \Carbon\Carbon::today()->year }}</span>
            </div>
            <div class="row mx-5">
                <div class="col-md">
                    <h5>{{ __('Features') }}</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="{{ route('vouchers.index') }}">{{ __('My Vouchers') }}</a></li>
                        <li><a class="text-muted" href="{{ route('shop.index') }}">{{ __('Shop') }}</a></li>
                        <li><a class="text-muted" href="{{ route('payments.index') }}">{{ __('Payments') }}</a></li>
                        <li><a class="text-muted" href="{{ route('orders.index') }}">{{ __('Orders') }}</a></li>
                        <li><a class="text-muted" href="{{ route('wizard') }}">{{ __('Wizard') }}</a></li>
                    </ul>
                </div>
                <div class="col-md">
                    <h5>{{ __('Profile') }}</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="#">Resource</a></li>
                        <li><a class="text-muted" href="#">Resource name</a></li>
                        <li><a class="text-muted" href="#">Another resource</a></li>
                        <li><a class="text-muted" href="#">Final resource</a></li>
                    </ul>
                </div>
                <div class="col-md">
                    <h5>{{ __('About') }}</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="#">Team</a></li>
                        <li><a class="text-muted" href="#">Locations</a></li>
                        <li><a class="text-muted" href="#">Privacy</a></li>
                        <li><a class="text-muted" href="#">Terms</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    ...
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger btn-ok">Delete</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
