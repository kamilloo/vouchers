@if($order->isOnline())
    <div class="container-contact1-form-btn">
        <div class="col-5">

        @include('payment.recap.template-1.button', [
    'href' => route('voucher.download', $order),
    'label' => __('Download')
    ])
        </div>
        <div class="col-5">

            <form-lazy-loading
                label="{{ __('Send to :recipient', ['recipient' => $order->first_name]) }}"
                btn="contact1-form-btn"
                action="{{ route('voucher.send', $order) }}"
            >
                @csrf
                <input class="form-control" type="text" name="email" value="{{ $order->email }}">
            </form-lazy-loading>
        </div>
    </div>
    {{--    @include('payment.recap.template-1.button', [--}}
    {{--        'href' => route('voucher.push', $order),--}}
    {{--        'label' => __('Send SMS to:recipient', ['recipient' => $order->first_name])--}}
    {{--    ])--}}
@endif

<div class="container-contact1-form-btn justify-content-center">

@include('payment.recap.template-1.button', [
        'href' => $merchant->getHomepage(),
        'label' => __('Back to homepage')
    ])
</div>
