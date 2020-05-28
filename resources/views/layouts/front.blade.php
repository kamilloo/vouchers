<!DOCTYPE html>
<html lang="pl" class="no-js">
<head>
@include('partials.head')
@yield('extra-head')
</head>
<body>
<div style="position: fixed; bottom: 0; width: 100%; background-color: orange; z-index: 3">
        @include('cookieConsent::index')
</div>
@yield('content')
<script src="{{ asset('welcome/js/vendor/jquery-2.2.4.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="{{ asset('welcome/js/vendor/bootstrap.min.js') }}"></script>
<script src="{{ asset('welcome/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('welcome/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('welcome/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('welcome/js/main.js') }}"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>
