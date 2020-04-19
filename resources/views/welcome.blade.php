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

    <!-- Start Feature Area -->
    <section class="featured-area">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-feature d-flex flex-wrap justify-content-between">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="lnr lnr-sun"></span>
                        </div>
                        <div class="desc">
                            <h6 class="title text-uppercase">Pełna personalizacja</h6>
                            <p>Dopasuj platformę do swoich potrzeb, wybierz jedną z dostępnych templatek lub stwórz swoją stronę.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-feature d-flex flex-wrap justify-content-between">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="lnr lnr-code"></span>
                        </div>
                        <div class="desc">
                            <h6 class="title text-uppercase">Proste zasady</h6>
                            <p>Proste i przejrzyste reguły współpracy, dopasowanie do klienta. </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-feature d-flex flex-wrap justify-content-between">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="lnr lnr-clock"></span>
                        </div>
                        <div class="desc">
                            <h6 class="title text-uppercase">Szybka integracja</h6>
                            <p>Zacznij sprzedawać bony w 5 minut! I czekaj na pierwszych klientów. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Feature Area -->
    <!-- Start Service Area -->
    <section class="service-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center">
                        <h3 class="text-white">Oferujemy bony upomnikowe</h3>
                        <span class="text-white text-uppercase">Jesteśmy dla Ciebie</span>
                    </div>
                </div>
            </div>
{{--            <div class="row">--}}
{{--                <div class="col-lg-3 col-sm-6">--}}
{{--                    <div class="single-service">--}}
{{--                        <div class="thumb" style="background: url(welcome/img/s1.jpg);">--}}
{{--                            <div class="overlay overlay-content d-flex justify-content-center align-items-center">--}}
{{--                                <a href="#" class="primary-btn hover d-inline-flex align-items-center"><span class="mr-10">Get Started</span><span class="lnr lnr-arrow-right"></span></a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="desc">--}}
{{--                            <h6 class="text-uppercase text-white">Creative Design</h6>--}}
{{--                            <p class="text-white">WordPress, the premier free open-source blogging utility, has gone through several upgrades in</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-sm-6">--}}
{{--                    <div class="single-service">--}}
{{--                        <div class="thumb" style="background: url(welcome/img/s2.jpg);">--}}
{{--                            <div class="overlay overlay-content d-flex justify-content-center align-items-center">--}}
{{--                                <a href="#" class="primary-btn hover d-inline-flex align-items-center"><span class="mr-10">Get Started</span><span class="lnr lnr-arrow-right"></span></a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="desc">--}}
{{--                            <h6 class="text-uppercase text-white">Driving Lesson</h6>--}}
{{--                            <p class="text-white">The buying of large-screen TVs has absolutely skyrocketed lately. It seems that everyone wants one – </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-sm-6">--}}
{{--                    <div class="single-service">--}}
{{--                        <div class="thumb" style="background: url(welcome/img/s3.jpg);">--}}
{{--                            <div class="overlay overlay-content d-flex justify-content-center align-items-center">--}}
{{--                                <a href="#" class="primary-btn hover d-inline-flex align-items-center"><span class="mr-10">Get Started</span><span class="lnr lnr-arrow-right"></span></a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="desc">--}}
{{--                            <h6 class="text-uppercase text-white">Climbing Stairs</h6>--}}
{{--                            <p class="text-white">Having used discount toner cartridges for twenty years, there have been a lot of changes in the </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-sm-6">--}}
{{--                    <div class="single-service">--}}
{{--                        <div class="thumb" style="background: url(welcome/img/s4.jpg);">--}}
{{--                            <div class="overlay overlay-content d-flex justify-content-center align-items-center">--}}
{{--                                <a href="#" class="primary-btn hover d-inline-flex align-items-center"><span class="mr-10">Get Started</span><span class="lnr lnr-arrow-right"></span></a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="desc">--}}
{{--                            <h6 class="text-uppercase text-white">Bike Accident</h6>--}}
{{--                            <p class="text-white">Every avid independent filmmaker has dre amed about making that special interest documentary, or </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-sm-6">--}}
{{--                    <div class="single-service">--}}
{{--                        <div class="thumb" style="background: url(welcome/img/s5.jpg);">--}}
{{--                            <div class="overlay overlay-content d-flex justify-content-center align-items-center">--}}
{{--                                <a href="#" class="primary-btn hover d-inline-flex align-items-center"><span class="mr-10">Get Started</span><span class="lnr lnr-arrow-right"></span></a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="desc">--}}
{{--                            <h6 class="text-uppercase text-white">Car Driving</h6>--}}
{{--                            <p class="text-white">Looking to buy a new computer Overwhelmed by all of the options available to you? Stressed by the </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-sm-6">--}}
{{--                    <div class="single-service">--}}
{{--                        <div class="thumb" style="background: url(welcome/img/s6.jpg);">--}}
{{--                            <div class="overlay overlay-content d-flex justify-content-center align-items-center">--}}
{{--                                <a href="#" class="primary-btn hover d-inline-flex align-items-center"><span class="mr-10">Get Started</span><span class="lnr lnr-arrow-right"></span></a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="desc">--}}
{{--                            <h6 class="text-uppercase text-white">Beach HoTel</h6>--}}
{{--                            <p class="text-white">Shure’s Music Phone Adapter (MPA) is our favorite iPhone solution, since it lets you use the headphones </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-sm-6">--}}
{{--                    <div class="single-service">--}}
{{--                        <div class="thumb" style="background: url(welcome/img/s7.jpg);">--}}
{{--                            <div class="overlay overlay-content d-flex justify-content-center align-items-center">--}}
{{--                                <a href="#" class="primary-btn hover d-inline-flex align-items-center"><span class="mr-10">Get Started</span><span class="lnr lnr-arrow-right"></span></a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="desc">--}}
{{--                            <h6 class="text-uppercase text-white">Under Passway</h6>--}}
{{--                            <p class="text-white">Over 92% of computers are infected with Adware and spyware. Such software is rarely accompanied by</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-sm-6">--}}
{{--                    <div class="single-service">--}}
{{--                        <div class="thumb" style="background: url(welcome/img/s8.jpg);">--}}
{{--                            <div class="overlay overlay-content d-flex justify-content-center align-items-center">--}}
{{--                                <a href="#" class="primary-btn hover d-inline-flex align-items-center"><span class="mr-10">Get Started</span><span class="lnr lnr-arrow-right"></span></a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="desc">--}}
{{--                            <h6 class="text-uppercase text-white">Dawn to dusk</h6>--}}
{{--                            <p class="text-white">Computers have become ubiquitous in almost every facet of our lives. At work, desk jockeys spend hours in </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </section>
    <!-- End Service Area -->
    <!-- Start Amazing Works Area -->
</div>
<div class="main-wrapper">
    <section class="amazing-works-area">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title text-center">
                    <h3>Co wybierają nasi klienci</h3>
                    <span class="text-uppercase">Jesteśmy dla Ciebie</span>
                </div>
            </div>
        </div>
        <div class="active-works-carousel mt-40">
            <div class="item">
                <div class="thumb" style="background: url(welcome/img/templates/template-1.png);"></div>
                <div class="caption text-center">
                    <h6 class="text-uppercase">Nowoczesny styl</h6>
                    <p>Strona idealna dla usług opartych na branży IT i pokrewnych.</p>
                </div>
            </div>
            <div class="item">
                <div class="thumb" style="background: url(welcome/img/templates/template-2.png);"></div>
                <div class="caption text-center">
                    <h6 class="text-uppercase">Klasyczny styl</h6>
                    <p>Strona idealna dla każdej branży.</p>
                </div>
            </div>
            <div class="item">
                <div class="thumb" style="background: url(welcome/img/templates/template-3.png);"></div>
                <div class="caption text-center">
                    <h6 class="text-uppercase">Retro styl</h6>
                    <p>Strona idealna dla usług hipsterskich.</p>
                </div>
            </div>
            <div class="item">
                <div class="thumb" style="background: url(welcome/img/templates/template-4.png);"></div>
                <div class="caption text-center">
                    <h6 class="text-uppercase">Elegancki styl</h6>
                    <p>Strona idealna dla usług opartych na branży beauty i pokrewnych.</p>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="main-wrapper">
    <!-- End Amazing Works Area -->
    <!-- Start Story Area -->
    <section class="story-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <div class="story-title">
                        <h3 class="text-white">Poznaj Nas</h3>
                        <span class="text-uppercase text-white">Jesteśmy dla Ciebie</span>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="story-box">
                        <h6 class="text-uppercase">Od początku...</h6>
                        <p>Internet łączy ludzi. Chcemy być częścią tego wspaniałego świata.</p>
                        <a href="{{ route('home') }}" class="primary-btn hover d-inline-flex align-items-center"><span class="mr-10">Get Started</span><span class="lnr lnr-arrow-right"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Story Area -->
    <!-- Start Subscription Area -->
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
    <section class="footer-widget-area">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-widget d-flex flex-wrap justify-content-between">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="lnr lnr-pushpin"></span>
                        </div>
                        <div class="desc">
                            <h6 class="title text-uppercase">Adres</h6>
                            <p>ul. Mossego 2<br>Grodziks Wlkp.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-widget d-flex flex-wrap justify-content-between">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="lnr lnr-earth"></span>
                        </div>
                        <div class="desc">
                            <h6 class="title text-uppercase">Email Adres</h6>
                            <div class="contact">
                                <a href="mailto:pietka.kasia3@gmail.com">pietka.kasia3@gmail.com</a> <br>
                                <a href="mailto:kamil.pietka85@gmail.com">kamil.pietka85@gmail.com</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-widget d-flex flex-wrap justify-content-between">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="lnr lnr-phone"></span>
                        </div>
                        <div class="desc">
                            <h6 class="title text-uppercase">Numer telefonu</h6>
                            <div class="contact">
                                <a href="tel:+48602139040">+48 602 139 040</a><br>
                                <a href="tel:+48662362356">+48 662 362 356</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
