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
                @include('payment.return.common.greeting')
                <section class="col">
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
