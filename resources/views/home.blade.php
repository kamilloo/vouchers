@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center pb-md-5  pb-1">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header">{{ __('Share your checkout shop') }}</div>
                <div class="card-body">
                    <shop-input shop-link="{{ auth()->user()->merchant->presenter->shopLink() }}"></shop-input>
                </div>
            </div>
        </div>
    </div>
    <div class="row pb-md-5 pb-xl-5">
    <div class="col-md-6 pb-1">
            <div class="card">
                <div class="card-header">{{ __('Your Payment') }}</div>
                    @if(!$payments->count())
                    <img class="card-img-top" src="{{ asset('images/payments.png') }}">
                    @endif
                    <div class="card-body table-responsive">
                        @if($payments->count())
                            <table class="table  table-bordered table-hover">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Client') }}</th>
                                    <th scope="col">{{ __('Amount')}}&nbsp;w&nbsp;zł</th>
                                    <th scope="col">{{ __('Paid At')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($payments as $payment)
                                    <tr>
                                        <td class="align-middle">{{ $payment->order->presenter->fullName() }}</td>
                                        <td>{{ $payment->presenter->amount() }}</td>
                                        <td>{{ $payment->presenter->paid_at() }}</td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        @else
                            <h5 class="card-title">{{ __('No Payments') }}</h5>
                        @endif
                    </div>
            </div>
        </div>
{{--    <div class="col-md-4 pb-1">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Reviews') }}</div>--}}
{{--                    <img class="card-img-top" src="{{ asset('images/reviews.png') }}">--}}
{{--                    <div class="card-body">--}}
{{--                        <h5 class="card-title">{{ __('Your Review') }}</h5>--}}
{{--                        <table class="table table-hover">--}}
{{--                            <tbody>--}}
{{--                            @foreach($reviews as $review)--}}
{{--                                <tr>--}}
{{--                                    <td class="align-middle">{{ $review->presenter->author() }}</td>--}}
{{--                                    <td class="align-middle">{!! $review->presenter->rating() !!}</td>--}}
{{--                                    <td class="align-middle">{{ $review->presenter->body() }}</td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
{{--                            </tbody>--}}

{{--                        </table>--}}
{{--                    </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    <div class="col-md-6 pb-1">
            <div class="card">
                <div class="card-header">{{ __('Your Sales') }}</div>
                @if(!$orders->count())
                    <img class="card-img-top" src="{{ asset('images/clients.png') }}">
                @endif
                    <div class="card-body table-responsive">
                        @if($orders->count())
                            <table class="table  table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">{{ __('Client') }}</th>
                                    <th scope="col">{{ __('Price')}}</th>
                                    <th scope="col">{{ __('Status')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td class="align-middle">{{ $order->presenter->fullName() }}</td>
                                        <td class="align-middle">{{ $order->presenter->price() }}</td>
                                        <td class="align-middle">{{ $order->presenter->status() }}</td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        @else
                            <h5 class="card-title">{{ __('No Clients') }}</h5>
                        @endif
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection
<script>
    import ShopInput from "../js/components/ShopInput";
    export default {
        components: {ShopInput}
    }
</script>
