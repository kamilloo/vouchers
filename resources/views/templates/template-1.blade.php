@extends('layouts.checkout')

@section('head')
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="template1/images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template1/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template1/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template1/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template1/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template1/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template1/css/util.css">
    <link rel="stylesheet" type="text/css" href="template1/css/main.css">
    <!--===============================================================================================-->
@endsection

@section('content')

<div class="contact1" @if($custom_background_image)style="background-image:url({{  asset($custom_background_image) }});" @else style="background-image: url('template2/images/bg-01.jpg');" @endif>
    <div class="outline-contact1" @if($custom_background) style="background: {{ $custom_background }};" @endif>
    <div class="justify-content-center" style="width: 100%;">
        <div class="col-md-12">
            @include('layouts.flash-message')
        </div>
    </div>
    <div class="container-contact1">

        <div class="contact1-pic js-tilt" data-tilt>
            @if($custom_logo)
                <img class="img-fluid" src="{{ asset($custom_logo) }}">
            @else
                <img class="img-fluid" src="template1/images/img-01.png" alt="logo">
            @endif


            <div class="col-xs-12 m-t-30">

                <checkout-form
                    :delivery-types="{{ json_encode(\App\Models\Enums\DeliveryType::all()) }}"
                    :vouchers="{{ json_encode($vouchers) }}"
                    :selected-voucher="selectedVoucher"
                    :selected-delivery="selectedDelivery"
                ></checkout-form>
            </div>
        </div>

        <form class="contact1-form validate-form" action="{{ route('checkout.proceed', $merchant) }}" method="post" >
				<span class="contact1-form-title">
                    {{ $custom_welcoming ?? __('Podaruj prezent') }}
				</span>

            @csrf
            <div class="row">
                <div class="col-xs-12">
                    <div class="bs-stepper">
                        <div class="bs-stepper-header" role="tablist">
                            <!-- your steps here -->
                            <div class="step" data-target="#vouchers-part">
                                <button type="button" class="step-trigger" role="tab" aria-controls="vouchers-part" id="vouchers-part-trigger">
                                    <span class="bs-stepper-circle">1</span>
                                    <span class="bs-stepper-label">Logins</span>
                                </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#delivery-part">
                                <button type="button" class="step-trigger" role="tab" aria-controls="delivery-part" id="delivery-part-trigger">
                                    <span class="bs-stepper-circle">2</span>
                                    <span class="bs-stepper-label">Delivery</span>
                                </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#information-part">
                                <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                                    <span class="bs-stepper-circle">3</span>
                                    <span class="bs-stepper-label">Personal details</span>
                                </button>
                            </div>
                        </div>
                        <div class="bs-stepper-content">
                            <!-- your steps content here -->
                            <div id="vouchers-part" class="content" role="tabpanel" aria-labelledby="vouchers-part-trigger">
                                <div class="box">
                                    <h3 class="box-title">Select you voucher</h3>
                                    @foreach($vouchers as $voucher)
                                        <div class="plan-selection">
                                            <div class="plan-data">
                                                <input v-model="selectedVoucher.id" id="voucher-{{ $voucher->id }}" name="voucher_id" type="radio" class="with-font" value="{{ $voucher->id }}" />
                                                <label for="voucher-{{ $voucher->id }}">{{ $voucher->title }}</label>
                                                <p class="plan-text">
                                                    @if($voucher->type == \App\Models\Enums\VoucherType::QUOTE )
                                                        {{ __('You can used full quote whatever.') }}
                                                    @else
                                                    Your service: {{ $voucher->service }}</p>
                                                    @endif
                                                <span class="plan-price">{{ $voucher->price }} $</span>
                                            </div>
                                        </div>
                                    @endforeach
                                    @if($errors->first('voucher_id'))
                                        <span>{{ $errors->first('voucher_id') }}</span>
                                    @endif
                                </div>
                                <div class="container-contact1-form-btn">
                                    <button type="button" class="contact1-form-btn" onclick="stepper_next()">
                                                <span>
                                                    Continue With Plans
                                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                                </span>
                                    </button>
                                </div>
                            </div>
                            <div id="delivery-part" class="content" role="tabpanel" aria-labelledby="delivery-part-trigger">
                                @include('templates.common.delivery-choose')

                                <div class="container-contact1-form-btn">
                                    <button type="button" class="contact1-form-btn" onclick="stepper_previous()">
                                                <span>
                                                    <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                                                    Back to Plan
                                                </span>
                                    </button>
                                </div>
                                <br>
                                <div class="container-contact1-form-btn">
                                    <button type="button" class="contact1-form-btn" onclick="stepper_next()">
                                                <span>
                                                    Continue With Plans
                                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                                </span>
                                    </button>
                                </div>

                            </div>
                            <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                                <div class="box">
                                    <h3 class="box-title">Your details</h3>


                                    <div class="wrap-input1 validate-input" data-validate="Name is required">
                                        <input type="text" id="first-name" class="input1" aria-describedby="first-name-helper" name="first_name" value="{{ old('first_name') }}" placeholder="First Name">
                                        <span class="shadow-input1"></span>
                                        @if($errors->first('first_name'))
                                            <span>{{ $errors->first('first_name') }}</span>
                                        @endif
                                    </div>
                                    <div class="wrap-input1 validate-input" data-validate = "Wybót usługi jest wymagany">
                                        <input type="text" id="last-name" class="input1" aria-describedby="last-name-helper" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name">
                                        <span class="shadow-input1"></span>
                                        @if($errors->first('last_name'))
                                            <span>{{ $errors->first('last_name') }}</span>
                                        @endif
                                    </div>

                                    <div class="wrap-input1 validate-input" data-validate = "Wybót usługi jest wymagany">
                                        <input type="email" id="email" class="input1" aria-describedby="email-helper" name="email" value="{{ old('email') }}" placeholder="Email">
                                        <span class="shadow-input1"></span>
                                        @if($errors->first('email'))
                                            <span>{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>

                                    <div class="wrap-input1 validate-input" data-validate = "Wybót usługi jest wymagany">
                                        <input type="text" id="phone" class="input1" aria-describedby="phone-helper" name="phone" value="{{ old('phone') }}" placeholder="Phone">
                                        <span class="shadow-input1"></span>
                                        @if($errors->first('phone'))
                                            <span>{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>
                                    <div class="container-contact1-form-btn">
                                            <button type="button" class="contact1-form-btn" onclick="stepper_previous()">
                                                <span>
                                                    <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                                                    Back to Plan
                                                </span>
                                            </button>
                                    </div>
                                    <br>
                                    <div class="container-contact1-form-btn">
                                        <button type="submit" class="contact1-form-btn" onclick="stepper_next()">
                                            <span>
                                                Confirm Order
                                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                            </span>
                                        </button>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <stepper></stepper>

        </form>
    </div>
    </div>
</div>




<!--===============================================================================================-->
<script src="template1/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="template1/vendor/bootstrap/js/popper.js"></script>
<script src="template1/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="template1/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="template1/vendor/tilt/tilt.jquery.min.js"></script>
<script >
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>

<!--===============================================================================================-->
<script src="template1/js/main.js"></script>
@endsection
