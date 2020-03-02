@extends('layouts.checkout')

@section('content')
    <div class="bg-contact2"
         @if($custom_background_image)style="background-image:url({{  asset($custom_background_image) }});"
         @else style="background-image: url('template2/images/bg-01.jpg');" @endif>
        <div class="container-contact2"
             @if($custom_background) style="background: {{ $custom_background }};" @endif>
            <div class="wrap-contact2">

                <div class="row justify-content-center">
                    <div class="col-md-6">
                        @include('layouts.flash-message')
                    </div>
                </div>
                @include('payment.recap.template-2.greeting')
                <section class="col">
                    @include('payment.recap.template-2.box', [
                        'title' => __('Thanks for your order'),
                        'lead' => __('The Voucher will be wonderful Gift for :recipient', ['recipient' => $order->first_name]),
                        'help' => __('Please complete your payment and send Voucher to :recipient', ['recipient' => $order->first_name])
])
                </section>
                @if($merchant->presenter->hasEnabledPaymentGateway())
                @include('payment.recap.template-2.button-pay')
                @else
                    <h5>{{ __('Contact with Merchant for complete order') }}</h5>
                    <p>{{ __('Email') }}: {{ $merchant->user->email }}</p>
                    <p>{{ __('Phone') }}: {{ $merchant->user->profile->phone }}</p>
                @endif
            </div>
        </div>
    </div>

@endsection
