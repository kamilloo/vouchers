@extends('layouts.checkout')


@section('content')

    <div class="contact100"
         @if($custom_background_image)style="background-image:url({{  asset($custom_background_image) }});"
         @else style="background-image: url('template2/images/bg-01.jpg');" @endif>
        <div class="container-contact100"
             @if($custom_background) style="background: {{ $custom_background }};" @endif>
            <div class="wrap-contact100">
                <div class="row justify-content-center" style="width: 100%">
                    <div class="col-md-6">
                        @include('layouts.flash-message')
                    </div>
                </div>
                <form class="contact100-form validate-form"
                      action="{{ route('checkout.proceed', $merchant) }}" method="post">
            	<span class="contact100-form-title">
                    {{ $custom_welcoming ?? __('Podaruj prezent') }}
				</span>
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-12">
                            <div class="bs-stepper">
                                @include('templates.common.steppers.stepper-header')
                                @include('templates.template-4.steppers.stepper-content')
                            </div>


                        </div>
                        <div class="col-lg-4 col-md-12">
                            @include('templates.common.checkout-form')
                        </div>
                    </div>
                    <stepper></stepper>
                </form>
            </div>
        </div>
    </div>


<div id="dropDownSelect1"></div>

@endsection
