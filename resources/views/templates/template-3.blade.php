@extends('layouts.checkout')

@section('head')
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="template3/images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template3/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template3/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template3/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template3/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template3/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template3/css/util.css">
    <link rel="stylesheet" type="text/css" href="template3/css/main.css">
    <!--===============================================================================================-->
@endsection

@section('content')

<div class="bg-contact3" @if($custom_background_image)style="background-image:url({{  asset($custom_background_image) }});" @else style="background-image: url('template3/images/bg-01.jpg');" @endif>
    <div class="container-contact3" @if($custom_background) style="background: {{ $custom_background }};" @endif>
        <div class="row justify-content-center" style="width: 100%">
            <div class="col-md-6">
                @include('layouts.flash-message')
            </div>
        </div>
        <div class="wrap-contact3">

            <form class="contact3-form validate-form" action="{{ route('checkout.proceed', $merchant) }}" method="post" >
                @csrf
                <span class="contact3-form-title">
                        {{ $custom_welcoming ?? __('Podaruj prezent') }}
					</span>
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
                        <div class="bs-stepper">
                            @include('templates.common.steppers.stepper-header')
                            @include('templates.template-3.steppers.stepper-content')
                        </div>


                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">
                        @include('templates.common.checkout-form')

                        @if($custom_logo)
                        <img class="img-fluid" src="{{ asset($custom_logo) }}">
                        @else
                            <img class="img-fluid" src="">
                        @endif
                    </div>
                </div>
                <stepper></stepper>
            </form>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="template3/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="template3/vendor/bootstrap/js/popper.js"></script>
<script src="template3/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="template3/vendor/select2/select2.min.js"></script>
<script>
    $(".selection-2").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect1')
    });
</script>
<!--===============================================================================================-->
<script src="template3/js/main.js"></script>

@endsection
