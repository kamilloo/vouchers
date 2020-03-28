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
                    @include('payment.recap.template-1.box', $box_content)
                    @include('payment.recap.template-1.button-homepage')
                </div>
            </div>

        </div>

    </div>
    <script>
        setInterval(function(){
            window.location.reload()
        }, 4000)
    </script>
@endsection
