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
                <section class="col">
                    @include('payment.recap.template-4.greeting')
                    @include('payment.return.common.box')
                </section>
                @include('payment.recap.'.$template_path.'.button-homepage')
            </div>
        </div>
    </div>
    <script>
        setInterval(function(){
            window.location.reload()
        }, 4000)
    </script>
@endsection
