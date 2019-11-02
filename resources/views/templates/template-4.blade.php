@extends('layouts.checkout')

@section('head')
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="template4/images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template4/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template4/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template4/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template4/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template4/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template4/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template4/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template4/css/util.css">
    <link rel="stylesheet" type="text/css" href="template4/css/main.css">
    <!--===============================================================================================-->
@endsection

@section('content')

<div class="contact100" @if($custom_background_image)style="background-image:url({{  asset($custom_background_image) }});" @else style="background-image: url('template2/images/bg-01.jpg');" @endif>
<div class="container-contact100" @if($custom_background) style="background: {{ $custom_background }};" @endif>
    <div class="wrap-contact100">
        <div class="row justify-content-center" style="width: 100%">
            <div class="col-md-6">
                @include('layouts.flash-message')
            </div>
        </div>
        <form class="contact100-form validate-form" action="{{ route('checkout.proceed', $merchant) }}" method="post" >
            	<span class="contact100-form-title">
                    {{ $custom_welcoming ?? __('Podaruj prezent') }}
				</span>
            @csrf
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
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
                                <div class="container-contact100-form-btn">
                                    <div class="wrap-contact100-form-btn">
                                        <div class="contact100-form-bgbtn"></div>
                                        <button type="button" class="contact100-form-btn" onclick="stepper_next()">
                                            <span>
                                                Continue With Plans
                                                <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div id="delivery-part" class="content" role="tabpanel" aria-labelledby="delivery-part-trigger">
                                @include('templates.common.delivery-choose')

                                <div class="container-contact100-form-btn">
                                    <div class="wrap-contact100-form-btn">
                                        <div class="contact100-form-bgbtn"></div>
                                        <button type="button" class="contact100-form-btn" onclick="stepper_previous()">
                                            <span>
                                                <i class="fa fa-long-arrow-left m-r-7" aria-hidden="true"></i>
                                                Back to Plans
                                        </span>
                                        </button>
                                    </div>
                                </div>
                                <div class="container-contact100-form-btn">
                                    <div class="wrap-contact100-form-btn">
                                        <div class="contact100-form-bgbtn"></div>
                                        <button type="button" class="contact100-form-btn" onclick="stepper_next()">
                                            <span>
                                                Continue With Plans
                                                <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                                            </span>
                                            </button>
                                    </div>
                                </div>


                            </div>
                            <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                                <div class="box">
                                    <h3 class="box-title">Your details</h3>

                                    <div class="wrap-input100 validate-input" data-validate="Name is required">
                                        <span class="label-input100">Osoba obdarowana</span>
                                        <input type="text" id="first-name" class="input100" aria-describedby="first-name-helper" name="first_name" value="{{ old('first_name') }}" placeholder="Osoba obdarowana">
                                        <span class="focus-input100"></span>
                                        @if($errors->first('first_name'))
                                            <span>{{ $errors->first('first_name') }}</span>
                                        @endif
                                    </div>

                                    <div class="wrap-input100 validate-input" data-validate = "Wybót usługi jest wymagany">
                                        <span class="label-input100">Last Name</span>
                                        <input type="text" id="last-name" class="input100" aria-describedby="last-name-helper" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name">
                                        <span class="focus-input100"></span>
                                        @if($errors->first('last_name'))
                                            <span>{{ $errors->first('last_name') }}</span>
                                        @endif
                                    </div>

                                    <div class="wrap-input100 validate-input" data-validate = "Wybót usługi jest wymagany">
                                        <span class="label-input100">Email</span>
                                        <input type="email" id="email" class="input100" aria-describedby="email-helper" name="email" value="{{ old('email') }}" placeholder="Email">
                                        <span class="focus-input100"></span>
                                        @if($errors->first('email'))
                                            <span>{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>

                                    <div class="wrap-input100 validate-input" data-validate = "Wybót usługi jest wymagany">
                                        <span class="label-input100">Phone</span>
                                        <input type="text" id="phone" class="input100" aria-describedby="phone-helper" name="phone" value="{{ old('phone') }}" placeholder="Phone">
                                        <span class="focus-input100"></span>
                                        @if($errors->first('phone'))
                                            <span>{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>




                                    <div class="container-contact100-form-btn">
                                        <div class="wrap-contact100-form-btn">
                                            <div class="contact100-form-bgbtn"></div>
                                            <button type="button" class="contact100-form-btn" onclick="stepper_previous()">
                                                <span>
                                                    <i class="fa fa-long-arrow-left m-r-7" aria-hidden="true"></i>
                                                    Back to Plans
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="container-contact100-form-btn">
                                        <div class="wrap-contact100-form-btn">
                                            <div class="contact100-form-bgbtn"></div>
                                            <button type="submit" class="contact100-form-btn" onclick="stepper_next()">
                                                <span>
                                                Confirm Order
                                                    <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                                                </span>
                                            </button>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">

                    <checkout-form
                        :delivery-types="{{ json_encode(\App\Models\Enums\DeliveryType::all()) }}"
                        :vouchers="{{ json_encode($vouchers) }}"
                        :selected-voucher="selectedVoucher"
                        :selected-delivery="selectedDelivery"
                    ></checkout-form>
                </div>
            </div>
            <stepper></stepper>
        </form>
    </div>
</div>
    </div>


<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="template4/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="template4/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="template4/vendor/bootstrap/js/popper.js"></script>
<script src="template4/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="template4/vendor/select2/select2.min.js"></script>
<script>
    $(".selection-2").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect1')
    });
</script>
<!--===============================================================================================-->
<script src="template4/vendor/daterangepicker/moment.min.js"></script>
<script src="template4/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="template4/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="template4/js/main.js"></script>

@endsection
