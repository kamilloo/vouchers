@extends('layouts.checkout')

@section('content')
    <div class="bg-contact3" @if($custom_background_image)style="background-image:url({{  asset($custom_background_image) }});" @else style="background-image: url('template3/images/bg-01.jpg');" @endif>
        <div class="container-contact3" @if($custom_background) style="background: {{ $custom_background }};" @endif>
            <div class="row justify-content-center" style="width: 100%">
                <div class="col-md-6">
                    @include('layouts.flash-message')
                </div>
            </div>
            <div class="wrap-contact3 col-md-8 col-sm-12">
                @include('payment.recap.template-3.greeting')
                <section class="col">
                    @include('payment.recap.template-3.box', $box_content)
                </section>
                @include('payment.recap.template-3.buttons')
            </div>
        </div>
    </div>
@endsection
