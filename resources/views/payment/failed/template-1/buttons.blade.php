<div class="container-contact1-form-btn">
    @include('payment.recap.template-1.button', [
    'href' => route('checkout.start', $order->merchant),
    'label' => __('Restart')
    ])
    @include('payment.recap.template-1.button', [
        'href' => route('welcome'),
        'label' => __('Back to homepage')
    ])
</div>
