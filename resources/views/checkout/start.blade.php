@extends('layouts.frontend')

@section('content')
<div class="content">
    <div class="container">
        <form action="{{ route('checkout.proceed') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
                    <div class="box">
                        <h3 class="box-title">Select you voucher</h3>
                        @foreach($vouchers as $voucher)
                            <div class="plan-selection">
                                <div class="plan-data">
                                    <input id="voucher-{{ $voucher->id }}" name="voucher_id" type="radio" class="with-font" value="{{ $voucher->id }}" />
                                    <label for="voucher-{{ $voucher->id }}">{{ $voucher->title }}</label>
                                    <p class="plan-text">
                                        {{ $voucher->service }} | {{ $voucher->type }}</p>
                                    <span class="plan-price">{{ $voucher->price }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="box">
                        <h3 class="box-title">Select delivery option</h3>
                        @foreach(\App\Models\Enums\DeliveryType::all() as $delivery)
                            <div class="plan-selection">
                                <div class="plan-data">
                                    <input id="box-{{ $delivery }}"  name="delivery" type="radio" class="with-font" value="{{ $delivery }}" />
                                    <label for="box-{{ $delivery }}">{{ $delivery }}</label>
                                    <p class="plan-text">Send online.</p>
                                    <span class="plan-price secure-price">$100</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg mb30">Continue With Plans</button>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">

                    <div class="widget">
                        <h4 class="widget-title">Order Summary</h4>
                        <div class="summary-block">
                            <div class="summary-content">
                                <div class="summary-head"><h5 class="summary-title">Personal</h5></div>
                                <div class="summary-price">
                                    <p class="summary-text">$29 / mo</p>
                                    <span class="summary-small-text pull-right">1 month</span>
                                </div>
                            </div>
                        </div>
                        <div class="summary-block">
                            <div class="summary-content">
                                <div class="summary-head"> <h5 class="summary-title">Website Security
                                        Essential</h5></div>
                                <div class="summary-price">
                                    <p class="summary-text">$229 / mo</p>
                                    <span class="summary-small-text pull-right">1 month</span>
                                </div>
                            </div>
                        </div>
                        <div class="summary-block">
                            <div class="summary-content">
                                <div class="summary-head"> <h5 class="summary-title">Total</h5></div>
                                <div class="summary-price">
                                    <p class="summary-text">$258 / mo</p>
                                    <span class="summary-small-text pull-right">1 month</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  text-center mt20">
                Created for <a href="https://goo.gl/XwHgxp" target="_blank">easetemplate</a>
            </div></div>





    </div>
</div>
@endsection