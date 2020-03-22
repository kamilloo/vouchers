@extends('layouts.checkout')

@section('content')
    <div class="bg-contact2"
         @if($custom_background_image)style="background-image:url({{  asset($custom_background_image) }});"
         @else style="background-image: url('/checkout/template2/images/bg-01.jpg');" @endif>
        <div class="container-contact2"
             @if($custom_background) style="background: {{ $custom_background }};" @endif>
            <div class="wrap-contact2">

                <div class="row justify-content-center">
                    <div class="col-md-6">
                        @include('layouts.flash-message')
                    </div>
                </div>
                <span class="contact2-form-title">
						{{ $custom_welcoming ?? __('Podaruj prezent') }}
					</span>
                <form class="contact2-form validate-form"
                      action="{{ route('checkout.proceed', $merchant) }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-12">
                            <div class="bs-stepper">
                                @include('templates.common.steppers.stepper-header')
                                @include('templates.template-2.steppers.stepper-content')
                            </div>


                        </div>
                        <div class="col-lg-4 col-md-12">

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

@endsection
