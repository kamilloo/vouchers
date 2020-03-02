@extends('layouts.checkout')

@section('content')
    <div class="contact100"
         @if($custom_background_image)style="background-image:url({{  asset($custom_background_image) }});"
         @else style="background-image: url('template2/images/bg-01.jpg');" @endif>
        <div class="container-contact100  pb-5"
             @if($custom_background) style="background: {{ $custom_background }};" @endif>
            <div class="wrap-contact100 col-lg-6 col-md-8 col-sm-12">
                <div class="row justify-content-center" style="width: 100%">
                    <div class="col-md-6">
                        @include('layouts.flash-message')
                    </div>
                </div>
                @include('payment.recap.template-4.greeting')
                <section class="col">
                    @include('payment.recap.template-4.box', [
                        'title' => __('Thanks for your order'),
                        'lead' => __('The Voucher will be wonderful Gift for :recipient', ['recipient' => $order->first_name]),
                        'help' => __('Please complete your payment and send Voucher to :recipient', ['recipient' => $order->first_name])
                    ])
                </section>
                @if($merchant->presenter->hasEnabledPaymentGateway())

                @include('payment.recap.template-4.button-pay')
                @else
                    <h5>{{ __('Contact with Merchant for complete order') }}</h5>
                    <p>{{ __('Email') }}: {{ $merchant->user->email }}</p>
                    <p>{{ __('Phone') }}: {{ $merchant->user->profile->phone }}</p>
                @endif

            </div>
        </div>
    </div>

@endsection
