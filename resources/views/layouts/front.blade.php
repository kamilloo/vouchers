<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="images/my-vouchers-icon.png">
    <!-- Author Meta -->
    <meta name="author" content="CodePixar">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">

    <meta property="og:url"                content="{{ route('welcome') }}" />
    <meta property="og:type"               content="website" />
    <meta property="og:title"              content="MyVouchers" />
    <meta property="og:description"        content="Sprzedajemy bony upominkowe" />
    <meta property="og:image"              content="{{ asset('welcome/img/body-bg.jpg') }}" />

    <!-- Site Title -->
    <title>MyVouchers</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,500,600" rel="stylesheet">
    <!--
    CSS
    ============================================= -->
    <link rel="stylesheet" href="welcome/css/linearicons.css">
    <link rel="stylesheet" href="welcome/css/owl.carousel.css">
    <link rel="stylesheet" href="welcome/css/font-awesome.min.css">
    <link rel="stylesheet" href="welcome/css/nice-select.css">
    <link rel="stylesheet" href="welcome/css/magnific-popup.css">
    <link rel="stylesheet" href="welcome/css/bootstrap.css">
    <link rel="stylesheet" href="welcome/css/main.css">
</head>
<body>
<div style="position: fixed; bottom: 0; width: 100%; background-color: orange">
        @include('cookieConsent::index')
</div>
@yield('content')

<script src="welcome/js/vendor/jquery-2.2.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="welcome/js/vendor/bootstrap.min.js"></script>
<script src="welcome/js/jquery.ajaxchimp.min.js"></script>
<script src="welcome/js/owl.carousel.min.js"></script>
<script src="welcome/js/jquery.nice-select.min.js"></script>
<script src="welcome/js/jquery.magnific-popup.min.js"></script>
<script src="welcome/js/main.js"></script>
</body>
</html>
