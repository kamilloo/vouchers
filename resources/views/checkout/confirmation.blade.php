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
                {{ __('Thanks for your order') }} <span class="badge badge-success rounded-circle" title="check mark" aria-hidden="true"><span class="oi oi-check" title="check mark" aria-hidden="true"></span></span>
            </h1>
            <p class="lead">{{ __('The Voucher will be wonderful Gift for Kamil') }}</p>
            <hr class="my-4">
            <p>{{ __('Please complete you payment and send Voucher to Kamil') }} </p>
            <a href="{{ route('payment.create', compact('merchant', 'order') ) }}" class="btn btn-primary btn-lg"> {{ __('Pay') }}</a>
        </div>
    </div>
</div>
@endsection
