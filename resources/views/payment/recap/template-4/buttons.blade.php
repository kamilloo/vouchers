<div class="container-contact100-form-btn">
    @include('payment.recap.template-4.button', [
    'href' => route('voucher.download', $order),
    'label' => __('Download')
    ])
    @include('payment.recap.template-4.button', [
    'href' => route('voucher.send', $order),
    'label' => __('Send to :recipient', ['recipient' => $order->first_name])
    ])
{{--    @include('payment.recap.template-4.button', [--}}
{{--        'href' => route('voucher.push', $order),--}}
{{--        'label' => __('Send SMS to:recipient', ['recipient' => $order->first_name])--}}
{{--    ])--}}
    @include('payment.recap.template-4.button', [
        'href' => route('welcome'),
        'label' => __('Back to homepage')
    ])
</div>
