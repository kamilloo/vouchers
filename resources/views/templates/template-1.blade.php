@extends('layouts.checkout')

@section('content')
    <div class="contact1"
         @if($custom_background_image)style="background-image:url({{  asset($custom_background_image) }});"
         @else style="background-image: url('/checkout/template2/images/bg-01.jpg');" @endif>
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

                    <div class="contact1-pic js-tilt" >
                        @if($custom_logo)
                            <img class="img-fluid" src="{{ asset($custom_logo) }}">
                        @else
                            <img class="img-fluid" src="/checkout/template1/images/img-01.png" alt="logo">
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
@endsection
