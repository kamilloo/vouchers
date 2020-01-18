@extends('layouts.checkout')

@section('content')
    <div class="contact100"
         @if($custom_background_image)style="background-image:url({{  asset($custom_background_image) }});"
         @else style="background-image: url('template2/images/bg-01.jpg');" @endif>
        <div class="container-contact100  pb-5"
             @if($custom_background) style="background: {{ $custom_background }};" @endif>
            <div class="wrap-contact100 w-100">
                <div class="row justify-content-center" style="width: 100%">
                    <div class="col-md-6">
                        @include('layouts.flash-message')
                    </div>
                </div>
            	<span class="contact100-form-title">
                    {{ $custom_welcoming ?? __('Podaruj prezent') }}
				</span>
                        <div class="content col">
                            <div class="box">
                                <h1 class="box-title">
                                    {{ __('Congratulation!') }} <span class="badge badge-success rounded-circle p-3" title="check mark" aria-hidden="true"><span class="oi oi-check" title="check mark" aria-hidden="true"></span></span>
                                </h1>

                                <p class="lead">{{ __('You can send Voucher to Kamil') }}</p>
                                <hr class="my-4">
                                <p>{{ __('Delivery your Voucher') }} </p>
                            </div>
                            <div class="container-contact100-form-btn">
                                <div class="wrap-contact100-form-btn">
                                    <div class="contact100-form-bgbtn"></div>
                                    <a type="button" class="contact100-form-btn" href="{{ route('voucher.download', $order) }}">
                                        <span>
                                            {{ __('Download') }}
                                            <i class="fa fa-long-arrow-right m-l-7"
                                               aria-hidden="true"></i>
                                        </span>
                                    </a>
                                </div>
                                <div class="wrap-contact100-form-btn">
                                    <div class="contact100-form-bgbtn"></div>
                                    <a type="button" class="contact100-form-btn" href="{{ route('voucher.send', $order) }}">
                                        <span>
                                            {{ __('Send To Kamil') }}
                                            <i class="fa fa-long-arrow-right m-l-7"
                                               aria-hidden="true"></i>
                                        </span>
                                    </a>
                                </div>
                                <div class="wrap-contact100-form-btn">
                                    <div class="contact100-form-bgbtn"></div>
                                    <a type="button" class="contact100-form-btn" href="{{ route('voucher.push', $order) }}">
                                        <span>
                                            {{ __('Send SMS') }}
                                            <i class="fa fa-long-arrow-right m-l-7"
                                               aria-hidden="true"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>

                        </div>


                        <div class="jumbotron">

                        </div>

            </div>
        </div>
    </div>
@endsection
