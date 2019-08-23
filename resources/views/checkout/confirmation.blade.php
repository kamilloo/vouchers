@extends('layouts.frontend')

@section('content')
<div class="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @include('layouts.flash-message')
            </div>
        </div>
        <div class="card">
            <div class="card-title">{{ __('Schedule your payment') }}</div>
            <div class="card-body">
                {{ __('For payment click buttons') }}
                <a href="{{ route('payment.create', compact('merchant', 'order') ) }}" class="btn btn-primary"> {{ __('Pay') }}</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  text-center mt20">
                Created for <a href="https://goo.gl/XwHgxp" target="_blank">easetemplate</a>
            </div>
        </div>

    </div>
</div>
@endsection
