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
            <div class="card-title m-auto">
                <h1>{{ __('Congratulation! You bought voucher') }}</h1>
            </div>
            <div class="card-body">
                <p>
                    <a class="btn btn-primary">{{ __('Download voucher') }}</a>
                </p>
                <p>
                    <a class="btn btn-primary">{{ __('Send voucher') }}</a>
                </p>
                <p>
                    <a class="btn btn-primary">{{ __('Push voucher') }}</a>
                </p>
            </div>
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
