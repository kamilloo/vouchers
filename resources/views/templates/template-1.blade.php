@extends('layouts.checkout')

@section('head')

{{--    <!--===============================================================================================-->--}}
{{--    <link rel="stylesheet" type="text/css" href="template1/vendor/bootstrap/css/bootstrap.min.css">--}}
{{--    <!--===============================================================================================-->--}}
{{--    <link rel="stylesheet" type="text/css" href="template1/fonts/font-awesome-4.7.0/css/font-awesome.min.css">--}}
{{--    <!--===============================================================================================-->--}}
{{--    <link rel="stylesheet" type="text/css" href="template1/vendor/animate/animate.css">--}}
{{--    <!--===============================================================================================-->--}}
{{--    <link rel="stylesheet" type="text/css"--}}
{{--          href="template1/vendor/css-hamburgers/hamburgers.min.css">--}}
{{--    <!--===============================================================================================-->--}}
{{--    <link rel="stylesheet" type="text/css" href="template1/vendor/select2/select2.min.css">--}}
{{--    <!--===============================================================================================-->--}}
{{--    <link rel="stylesheet" type="text/css" href="template1/css/util.css">--}}
{{--    <link rel="stylesheet" type="text/css" href="template1/css/main.css">--}}
{{--    <!--===============================================================================================-->--}}
@endsection

@section('content')
    <div class="contact1"
         @if($custom_background_image)style="background-image:url({{  asset($custom_background_image) }});"
         @else style="background-image: url('template2/images/bg-01.jpg');" @endif>
        <div class="outline-contact1"
             @if($custom_background) style="background: {{ $custom_background }};" @endif>
            <div class="justify-content-center" style="width: 100%;">
                <div class="col-md-12">
                    @include('layouts.flash-message')
                </div>
            </div>
            <form action="{{ route('checkout.proceed', $merchant) }}" method="post"
                  class="validate-form">
                <div class="container-contact1">

                    <div class="contact1-pic" data-tilt>
                        @if($custom_logo)
                            <img class="img-fluid" src="{{ asset($custom_logo) }}">
                        @else
                            <img class="img-fluid" src="template1/images/img-01.png" alt="logo">
                        @endif


                        <div class="col m-t-30">
                            @include('templates.common.checkout-form')
                        </div>
                    </div>
                    <div class="contact1-form">
                        <span class="contact1-form-title">
                            {{ $custom_welcoming ?? __('Podaruj prezent') }}
                        </span>
                        @csrf
                        <div class="bs-stepper">
                            @include('templates.common.steppers.stepper-header')
                            @include('templates.template-1.steppers.stepper-content')
                        </div>
                        <stepper></stepper>
                    </div>
                </div>
            </form>
        </div>
    </div>




{{--    <!--===============================================================================================-->--}}
{{--    <script src="template1/vendor/jquery/jquery-3.2.1.min.js"></script>--}}
{{--    <!--===============================================================================================-->--}}
{{--    <script src="template1/vendor/bootstrap/js/popper.js"></script>--}}
{{--    <script src="template1/vendor/bootstrap/js/bootstrap.min.js"></script>--}}
{{--    <!--===============================================================================================-->--}}
{{--    <script src="template1/vendor/select2/select2.min.js"></script>--}}
{{--    <!--===============================================================================================-->--}}
{{--    <script src="template1/vendor/tilt/tilt.jquery.min.js"></script>--}}

{{--    <!--===============================================================================================-->--}}
{{--    <script src="template1/js/main.js"></script>--}}
@endsection
