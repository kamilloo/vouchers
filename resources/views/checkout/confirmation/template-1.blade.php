@extends('layouts.checkout')

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
            <div class="container-contact1 justify-content-center">
                @include('payment.recap.template-1.greeting')
                <div class="col-md-8 col-sm-12 p-b-160">
                    @include('payment.recap.template-1.box', [
                        'title' => __('Thanks for your order'),
                        'lead' => __('The Voucher will be wonderful Gift for :recipient', ['recipient' => $order->first_name]),
                        'help' => __('Please complete your payment and send Voucher to :recipient', ['recipient' => $order->first_name])
                        ])
                    @if($merchant->presenter->hasEnabledPaymentGateway())
                    @include('payment.recap.template-1.button-pay')
                        @else
                        <h5>{{ __('Contact with Merchant for complete order') }}</h5>
                        <p>{{ __('Email') }}: {{ $merchant->user->email }}</p>
                        <p>{{ __('Phone') }}: {{ $merchant->user->profile->phone }}</p>
                    @endif

                </div>
            </div>

        </div>

    </div>

@endsection
