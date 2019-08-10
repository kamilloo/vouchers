@extends('layouts.frontend')

@section('content')
<div class="content" onclick="init_data({{ $vouchers }})">
    <div class="container">
        <form action="{{ route('checkout.proceed') }}" method="post" >
            @csrf
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
                    <div class="bs-stepper">
                        <div class="bs-stepper-header" role="tablist">
                            <!-- your steps here -->
                            <div class="step" data-target="#vouchers-part">
                                <button type="button" class="step-trigger" role="tab" aria-controls="vouchers-part" id="vouchers-part-trigger">
                                    <span class="bs-stepper-circle">1</span>
                                    <span class="bs-stepper-label">Logins</span>
                                </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#delivery-part">
                                <button type="button" class="step-trigger" role="tab" aria-controls="delivery-part" id="delivery-part-trigger">
                                    <span class="bs-stepper-circle">2</span>
                                    <span class="bs-stepper-label">Delivery</span>
                                </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#information-part">
                                <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                                    <span class="bs-stepper-circle">3</span>
                                    <span class="bs-stepper-label">Personal details</span>
                                </button>
                            </div>
                        </div>
                        <div class="bs-stepper-content">
                            <!-- your steps content here -->
                            <div id="vouchers-part" class="content" role="tabpanel" aria-labelledby="vouchers-part-trigger">
                                <div class="box">
                                    <h3 class="box-title">Select you voucher</h3>
                                    @foreach($vouchers as $voucher)
                                        <div class="plan-selection">
                                            <div class="plan-data">
                                                <input v-model="selectedVoucher.id" id="voucher-{{ $voucher->id }}" name="voucher_id" type="radio" class="with-font" value="{{ $voucher->id }}" />
                                                <label for="voucher-{{ $voucher->id }}">{{ $voucher->title }}</label>
                                                <p class="plan-text">
                                                    {{ $voucher->service }} | {{ $voucher->type }}</p>
                                                <span class="plan-price">{{ $voucher->price }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-primary btn-lg mb30" onclick="stepper_next()">Continue With Plans</button>
                            </div>
                            <div id="delivery-part" class="content" role="tabpanel" aria-labelledby="delivery-part-trigger">
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
                                <button type="button" class="btn btn-primary btn-lg mb30" onclick="stepper_previous()">Back to Plans</button>

                                <button type="button" class="btn btn-primary btn-lg mb30" onclick="stepper_next()">Continue With Plans</button>
                            </div>
                            <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                                <div class="box">
                                    <h3 class="box-title">Your details</h3>
                                    <div class="form-group">
                                        <label for="first-name">First Name</label>
                                        <input type="text" id="first-name" class="form-control" aria-describedby="first-name-helper" name="first_name" value="{{ old('first_name') }}">
                                        <small id="first-name-helper" class="form-text text-muted">Put your First Name</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="last-name">Last Name</label>
                                        <input type="text" id="last-name" class="form-control" aria-describedby="last-name-helper" name="last_name" value="{{ old('last_name') }}">
                                        <small id="last-name-helper" class="form-text text-muted">Put your Last Name</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" class="form-control" aria-describedby="email-helper" name="email" value="{{ old('email') }}">
                                        <small id="email-helper" class="form-text text-muted">Put your email</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" id="phone" class="form-control" aria-describedby="phone-helper" name="phone" value="{{ old('phone') }}">
                                        <small id="phone-helper" class="form-text text-muted">Put your phone</small>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary btn-lg mb30" onclick="stepper_previous()">Back to Plans</button>
                                <button type="submit" class="btn btn-primary btn-lg mb30" onclick="stepper_next()">Confirm Order</button>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">

                    <div class="widget">
                        <h4 class="widget-title">Wish list</h4>
                        <div class="summary-block">
                            <div class="summary-content">
                                <div class="summary-head"><h5 class="summary-title">@{{ selectedVoucher.name }}</h5></div>
                                <div class="summary-price">
                                    <p class="summary-text">$@{{ selectedVoucher.price }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="summary-block">
                            <div class="summary-content">
                                <div class="summary-head"> <h5 class="summary-title">@{{ selectedDelivery.type }}</h5></div>
                                <div class="summary-price">
                                    <p class="summary-text">$@{{ selectedDelivery.price }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="summary-block">
                            <div class="summary-content">
                                <div class="summary-head"> <h5 class="summary-title">Total</h5></div>
                                <div class="summary-price">
                                    <p class="summary-text">$@{{ total }}</p>
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
            </div>
        </div>

    </div>
</div>
@endsection