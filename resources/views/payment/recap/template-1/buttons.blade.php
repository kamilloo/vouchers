<div class="container-contact1-form-btn">
    @include('payment.recap.template-1.button', [
    'href' => route('voucher.download', $order),
    'label' => __('Download')
    ])
    @if($order->isOnline())
    @include('payment.recap.template-1.button', [
    'href' => route('voucher.send', $order),
    'label' => __('Send to :recipient', ['recipient' => $order->first_name])
    ])
    @endif
    {{--    @include('payment.recap.template-1.button', [--}}
    {{--        'href' => route('voucher.push', $order),--}}
    {{--        'label' => __('Send SMS to:recipient', ['recipient' => $order->first_name])--}}
    {{--    ])--}}
    @include('payment.recap.template-1.button', [
        'href' => route('welcome'),
        'label' => __('Back to homepage')
    ])
</div>
