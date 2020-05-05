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
                <div id="mc_embed_signup" class="col-lg-6">
                    <form novalidate action="{{ route('subscribe') }}" method="post">
                        <div class="row pb-1">
                            <div class="g-recaptcha col-lg-6" data-sitekey="6LfA_vIUAAAAAAB5ev_-g1Br-j-hw9M-MVHwEvq8"></div>
                        </div>

                        <div class="row">
                            <div class="subscription relative">
                                @csrf
                                <input type="email" name="email" placeholder="Podaj adres email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'" required>

                                <button class="primary-btn hover d-inline-flex align-items-center"><span class="mr-10">Wyślij</span><span class="lnr lnr-arrow-right"></span></button>
                                <div class="info"></div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
