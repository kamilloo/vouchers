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
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">--}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="/open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">

</head>
<body>

    <div id="app" class="{{ $merchant->template->file_name }}">
        @yield('content')
    </div>
    <footer class="pt-2 border-top bg-light mt-n5">
        <div class="container-fluid">
            <div class="col-sm text-center mb-3">
                <img class="img-fluid" src="{{ config('app.name', 'Voucher') }}" alt="Voucher" width="24" height="24">
                <span class="text-muted">© {{ \Carbon\Carbon::today()->year }}</span>
            </div>
            <div class="row text-center mx-5">
                <div class="col-sm text-center mb-3">
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="#">{{ __("Team") }}</a></li>
                        <li><a class="text-muted" href="#">{{ __("Locations") }}</a></li>
                        <li><a class="text-muted" href="#">{{ __("Privacy") }}</a></li>
                        <li><a class="text-muted" href="#">{{ __("Terms") }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
