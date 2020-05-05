<div class="main-wrapper">
   @include('front.partials.subscriber-form')
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
                            <p>ul. Mossego 2<br>Grodzisk Wlkp.</p>
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
                                <a href="mailto:myvouchers.pl@gmail.com">myvouchers.pl@gmail.com</a>
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
