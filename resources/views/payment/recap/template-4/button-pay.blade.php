<div class="container-contact100-form-btn">
    @include('payment.recap.template-4.button', [
        'href' => route('payment.create', compact('merchant', 'order')),
        'label' => __('Pay')
    ])
</div>
