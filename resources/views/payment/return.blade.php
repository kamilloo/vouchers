@extends('layouts.frontend')

@section('content')
    <div class="content min-vh-100 pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    @include('layouts.flash-message')
                </div>
            </div>
            <div class="jumbotron">
                <h1 class="display-4">
                    {{ __('Congratulation!') }} <span class="badge badge-success rounded-circle" title="check mark" aria-hidden="true"><span class="oi oi-check" title="check mark" aria-hidden="true"></span></span>
                </h1>
                <p class="lead">{{ __('The Voucher was send to Kamil') }}</p>
                <hr class="my-4">
                <p>{{ __('Delivery your Voucher') }} </p>
{{--                    <a href="{{ route('voucher.download', $order) }}" class="btn btn-primary btn-lg">{{ __('Download voucher') }}</a>--}}
{{--                    <a href="{{ route('voucher.send', $order) }}"  class="btn btn-primary btn-lg">{{ __('Send voucher to Kamil') }}</a>--}}
{{--                    <a href="{{ route('voucher.push', $order) }}" class="btn btn-primary btn-lg">{{ __('Send SMS') }}</a>--}}
            </div>
        </div>
    </div>
@endsection
