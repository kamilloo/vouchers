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
                        @include('templates.common.steppers.stepper-header')
                        @include('templates.template-4.steppers.stepper-content')
                    </div>


                </div>
                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">
                    @include('templates.common.checkout-form')
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
