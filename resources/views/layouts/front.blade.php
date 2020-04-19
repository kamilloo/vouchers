<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="welcome/img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="CodePixar">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
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
<div class="main-wrapper-first">
    <header>
        <div class="container">
            <div class="header-wrap">
                <div class="header-top d-flex justify-content-between align-items-center">
                    <div class="logo">
                        <a href="{{ route('welcome') }}"><img src="welcome/img/logo.png" alt=""></a>
                    </div>
                    <div class="main-menubar d-flex align-items-center">
                        <nav class="hide">
                            <a href="{{ route('home') }}">Home</a>
                            <a href="{{ route('teams') }}">{{ __('Team') }}</a>
                            <a href="{{ route('locations') }}">{{ __('Locations') }}</a>
                            <a href="{{ route('privacy') }}">{{ __('Privacy') }}</a>
                            <a href="{{ route('terms') }}">{{ __('Terms') }}</a>
                        </nav>
                        <div class="menu-bar"><span class="lnr lnr-menu"></span></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="banner-area">
        <div class="container">
            <div class="row justify-content-center height align-items-center">
                <div class="col-lg-8">
                    <div class="banner-content text-center">
                        <h1 class="text-white text-uppercase">Sprzedajemy bony upominkowe</h1>
                        <h2><span class="text-white top text-uppercase">Jesteśmy dla Ciebie</span></h2>

                        <a href="{{ route('home') }}" class="primary-btn d-inline-flex align-items-center"><span class="mr-10">Get Started</span><span class="lnr lnr-arrow-right"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @yield('content')
</div>
<div class="main-wrapper">
    <section class="subscription-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center">
                        <h3>Chcesz wiedzieć więcej, zapraszamy do kontaktu</h3>
                        <span class="text-uppercase">Jesteśmy dla Ciebie</span>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div id="mc_embed_signup">
                        <form novalidate action="{{ route('subscribe') }}" method="post" class="subscription relative">
                            @csrf
                            <input type="email" name="email" placeholder="Podaj adres email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'" required>
                            <button class="primary-btn hover d-inline-flex align-items-center"><span class="mr-10">Wyślij</span><span class="lnr lnr-arrow-right"></span></button>
                            <div class="info"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Subscription Area -->
    <!-- Start Footer Widget Area -->
{{--    <section class="footer-widget-area">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-4">--}}
{{--                    <div class="single-widget d-flex flex-wrap justify-content-between">--}}
{{--                        <div class="icon d-flex align-items-center justify-content-center">--}}
{{--                            <span class="lnr lnr-pushpin"></span>--}}
{{--                        </div>--}}
{{--                        <div class="desc">--}}
{{--                            <h6 class="title text-uppercase">Address</h6>--}}
{{--                            <p>56/8, panthapath, west <br> dhanmondi, kalabagan, <br>Dhaka - 1205</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-4">--}}
{{--                    <div class="single-widget d-flex flex-wrap justify-content-between">--}}
{{--                        <div class="icon d-flex align-items-center justify-content-center">--}}
{{--                            <span class="lnr lnr-earth"></span>--}}
{{--                        </div>--}}
{{--                        <div class="desc">--}}
{{--                            <h6 class="title text-uppercase">Email Address</h6>--}}
{{--                            <div class="contact">--}}
{{--                                <a href="mailto:info@dataarc.com">info@dataarc.com</a> <br>--}}
{{--                                <a href="mailto:support@dataarc.com">support@dataarc.com</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-4">--}}
{{--                    <div class="single-widget d-flex flex-wrap justify-content-between">--}}
{{--                        <div class="icon d-flex align-items-center justify-content-center">--}}
{{--                            <span class="lnr lnr-phone"></span>--}}
{{--                        </div>--}}
{{--                        <div class="desc">--}}
{{--                            <h6 class="title text-uppercase">Phone Number</h6>--}}
{{--                            <div class="contact">--}}
{{--                                <a href="tel:1545">012 4562 982 3612</a> <br>--}}
{{--                                <a href="tel:54512">012 6321 956 4587</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
<!-- End Footer Widget Area -->
    <!-- Start footer Area -->
    <footer>
        <div class="container">
            <div class="footer-content d-flex justify-content-between align-items-center flex-wrap">
                <div class="logo">
                    <img src="welcome/img/logo.png" alt="">
                </div>
                <div class="copy-right-text">Copyright &copy; {{ \Carbon\Carbon::now()->year }}  |  All rights reserved to MyVouchers</div>
                <div class="footer-social">
                    {{--                    <a href="#"><i class="fa fa-facebook"></i></a>--}}
                    {{--                    <a href="#"><i class="fa fa-twitter"></i></a>--}}
                    {{--                    <a href="#"><i class="fa fa-dribbble"></i></a>--}}
                    {{--                    <a href="#"><i class="fa fa-behance"></i></a>--}}
                </div>
            </div>
        </div>
    </footer>
    <!-- End footer Area -->
</div>




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
