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
        <form action="{{ route('checkout.proceed', $merchant) }}" method="post" class="validate-form" >
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
                <div class="contact1-form">
                <span class="contact1-form-title">
                    {{ $custom_welcoming ?? __('Podaruj prezent') }}
				</span>

            @csrf
            <div class="row">
                <div class="col-xs-12">
                    <div class="bs-stepper">
                        <div class="bs-stepper-header" role="tablist">
                            <!-- your steps here -->
                            @include('templates.common.steppers.step', [
                                'target' => 'vouchers-part',
                                'counter' => 1,
                                'label' => __('Choose Voucher')
                            ])
                            <div class="line"></div>
                            @include('templates.common.steppers.step', [
                                'target' => 'delivery-part',
                                'counter' => 2,
                                'label' => __('Delivery')
                            ])
                            <div class="line"></div>
                            @include('templates.common.steppers.step', [
                                'target' => 'information-part',
                                'counter' => 3,
                                'label' => __('Your Recipient')
                            ])
                            <div class="line"></div>
                            @include('templates.common.steppers.step', [
                                'target' => 'client-part',
                                'counter' => 4,
                                'label' => __('Personal Details')
                            ])
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
                                @include('templates.common.fields.button-next')
                            </div>
                            <div id="delivery-part" class="content" role="tabpanel" aria-labelledby="delivery-part-trigger">
                                @include('templates.common.delivery-choose')

                                @include('templates.common.fields.button-previous')
                                <br>
                                @include('templates.common.fields.button-next')

                            </div>
                            <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                                <div class="box">
                                    <h3 class="box-title">Your Recipient</h3>
                                @include('templates.common.fields.text-input', [
                                    'data_validate' => 'Name is required',
                                    'wrapper_class' => 'wrap-input1 validate-input',
                                    'input_class' => 'input1',
                                    'name' => "first_name"
                                ])
                                    @include('templates.common.fields.text-input', [
                                        'data_validate' => 'Last Name is required',
                                        'wrapper_class' => 'wrap-input1 validate-input',
                                        'input_class' => 'input1',
                                        'name' => "last_name"
                                    ])
                                    @include('templates.common.fields.text-input', [
                                        'data_validate' => 'Email is required',
                                        'wrapper_class' => 'wrap-input1 validate-input',
                                        'input_class' => 'input1',
                                        'name' => "email"
                                    ])
                                    @include('templates.common.fields.text-input', [
                                        'data_validate' => 'Phone is required',
                                        'wrapper_class' => 'wrap-input1 validate-input',
                                        'input_class' => 'input1',
                                        'name' => "phone"
                                    ])

                                    @include('templates.common.fields.button-previous')
                                    <br>
                                    @include('templates.common.fields.button-next')

                                </div>

                            </div>
                            <div id="client-part" class="content" role="tabpanel" aria-labelledby="client-part-trigger">
                                <div class="box">
                                    <h3 class="box-title">Your details</h3>

                                    @include('templates.common.fields.text-input-table', [
                                        'data_validate' => 'Country is required',
                                        'wrapper_class' => 'wrap-input1 validate-input',
                                        'input_class' => 'input1',
                                        'name' => "client",
                                        'fields' => ['name', 'email', 'phone', 'city', 'address', 'postcode', 'country']
                                    ])
                                    @include('templates.common.fields.button-previous')
                                    <br>
                                    @include('templates.common.fields.button-confirm')
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <stepper></stepper>
            </div>
            </div>
        </form>
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
