<div class="main-wrapper-first">
@include('front.partials.header')
@include('front.partials.banner-area')

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
                        <h3 class="text-white">Zaufaj nam</h3>
                        <span class="text-white text-uppercase">Internet nie ma granic</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="single-service">
                        <div class="thumb" style="background: url(welcome/img/s1.jpg);">
                            <div class="overlay overlay-content d-flex justify-content-center align-items-center">
                                <a href="{{ route('home') }}" class="primary-btn hover d-inline-flex align-items-center"><span class="mr-10">Rozpocznij</span><span class="lnr lnr-arrow-right"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-sm-6">
                    <div class="single-service">
                        <div class="desc">
                            <div class="desc">
                                <h6 class="text-white">Internetowa sprzedaż bonów upominkowych to idealna droga do rozwoju Twojej firmy.
                                    W dzisiejszych czasach nie znajdziesz lepszej formy promowania swoich usług niż Internet, gdzie Twoja oferta jest dostępna online bez względu na porę dnia i dzień tygodnia.</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-service">
                        <div class="desc">
                            <p class="text-white">
                                Każdy klient może w dowolnym momencie:</p>
                            <ul class="text-white" style="list-style: disc; margin-left: 14px">
                                <li>Skorzystać z Twojej oferty,</li>
                                <li>Zrobić prezent bliskiej osobie</li>
                                <li>Udostępnić Twoją ofertę innym.</li>
                            </ul>
                        </div>


                    </div>
                </div>
                <div class="col-lg-7 col-sm-6">
                    <div class="single-service">
                        <div class="desc">
                            <p class="text-white">
                                Bony upominkowe nie mają przypisanych branż ani ograniczonego wachlarza usług, dlatego jeżeli zajmujesz się:
                            </p>
                            <ul class="text-white" style="list-style: disc; margin-left: 14px">
                                <li>Fotografią,</li>
                                <li>Organizacją eventów,</li>
                                <li>Prowadzeniem kursów i szkoleń,</li>
                                <li>Organizacją wycieczek i podróży,</li>
                                <li>Usługami Beauty i Spa,</li>
                                <li>Holetarstwem,</li>
                                <li>Rozrywką,</li>
                                <li>Lub wieloma innymi,</li>
                            </ul>
                            <p class="text-white">zachęcamy Cię do zaufania Nam.
                            </p>
                            <br>
                            <h6 class="text-white">Łatwość z jaką jest to możliwe na naszej platformie sama Cię zachęci. :)</h6>
                        </div>
                    </div>
                </div>

                {{--                <div class="col-lg-3 col-sm-6">--}}
{{--                    <div class="single-service">--}}
{{--                        <div class="thumb" style="background: url(welcome/img/s2.jpg);">--}}
{{--                            <div class="overlay overlay-content d-flex justify-content-center align-items-center">--}}
{{--                                <a href="{{ route('home') }}" class="primary-btn hover d-inline-flex align-items-center"><span class="mr-10">Get Started</span><span class="lnr lnr-arrow-right"></span></a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="desc">--}}
{{--                            <h6 class="text-uppercase text-white">Eventy</h6>--}}
{{--                            <p class="text-white">The buying of large-screen TVs has absolutely skyrocketed lately. It seems that everyone wants one – </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-sm-6">--}}
{{--                    <div class="single-service">--}}
{{--                        <div class="thumb" style="background: url(welcome/img/s3.jpg);">--}}
{{--                            <div class="overlay overlay-content d-flex justify-content-center align-items-center">--}}
{{--                                <a href="{{ route('home') }}" class="primary-btn hover d-inline-flex align-items-center"><span class="mr-10">Get Started</span><span class="lnr lnr-arrow-right"></span></a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="desc">--}}
{{--                            <h6 class="text-uppercase text-white">Kursy i szkolenia</h6>--}}
{{--                            <p class="text-white">Having used discount toner cartridges for twenty years, there have been a lot of changes in the </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-sm-6">--}}
{{--                    <div class="single-service">--}}
{{--                        <div class="thumb" style="background: url(welcome/img/s4.jpg);">--}}
{{--                            <div class="overlay overlay-content d-flex justify-content-center align-items-center">--}}
{{--                                <a href="{{ route('home') }}" class="primary-btn hover d-inline-flex align-items-center"><span class="mr-10">Get Started</span><span class="lnr lnr-arrow-right"></span></a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="desc">--}}
{{--                            <h6 class="text-uppercase text-white">Podróże</h6>--}}
{{--                            <p class="text-white">Every avid independent filmmaker has dre amed about making that special interest documentary, or </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-sm-6">--}}
{{--                    <div class="single-service">--}}
{{--                        <div class="thumb" style="background: url(welcome/img/s5.jpg);">--}}
{{--                            <div class="overlay overlay-content d-flex justify-content-center align-items-center">--}}
{{--                                <a href="{{ route('home') }}" class="primary-btn hover d-inline-flex align-items-center"><span class="mr-10">Get Started</span><span class="lnr lnr-arrow-right"></span></a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="desc">--}}
{{--                            <h6 class="text-uppercase text-white">Turystyka</h6>--}}
{{--                            <p class="text-white">Looking to buy a new computer Overwhelmed by all of the options available to you? Stressed by the </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-sm-6">--}}
{{--                    <div class="single-service">--}}
{{--                        <div class="thumb" style="background: url(welcome/img/s6.jpg);">--}}
{{--                            <div class="overlay overlay-content d-flex justify-content-center align-items-center">--}}
{{--                                <a href="{{ route('home') }}" class="primary-btn hover d-inline-flex align-items-center"><span class="mr-10">Get Started</span><span class="lnr lnr-arrow-right"></span></a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="desc">--}}
{{--                            <h6 class="text-uppercase text-white">Beauty i Spa</h6>--}}
{{--                            <p class="text-white">Shure’s Music Phone Adapter (MPA) is our favorite iPhone solution, since it lets you use the headphones </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-sm-6">--}}
{{--                    <div class="single-service">--}}
{{--                        <div class="thumb" style="background: url(welcome/img/s7.jpg);">--}}
{{--                            <div class="overlay overlay-content d-flex justify-content-center align-items-center">--}}
{{--                                <a href="{{ route('home') }}" class="primary-btn hover d-inline-flex align-items-center"><span class="mr-10">Get Started</span><span class="lnr lnr-arrow-right"></span></a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="desc">--}}
{{--                            <h6 class="text-uppercase text-white">Holete</h6>--}}
{{--                            <p class="text-white">Over 92% of computers are infected with Adware and spyware. Such software is rarely accompanied by</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-sm-6">--}}
{{--                    <div class="single-service">--}}
{{--                        <div class="thumb" style="background: url(welcome/img/s8.jpg);">--}}
{{--                            <div class="overlay overlay-content d-flex justify-content-center align-items-center">--}}
{{--                                <a href="{{ route('home') }}" class="primary-btn hover d-inline-flex align-items-center"><span class="mr-10">Get Started</span><span class="lnr lnr-arrow-right"></span></a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="desc">--}}
{{--                            <h6 class="text-uppercase text-white">Rozrywka</h6>--}}
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
