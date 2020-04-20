@extends('front.partials.page')

@section('content-page')
    <section class="featured-area">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-feature d-flex flex-wrap justify-content-between">
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
                    <div class="single-feature d-flex flex-wrap justify-content-between">
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
                    <div class="single-feature d-flex flex-wrap justify-content-between">
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
@endsection
