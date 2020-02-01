<div class="container-contact3-form-btn">
@include('payment.recap.template-3.button', [
        'href' => route('payment.create', compact('merchant', 'order')),
        'label' => __('Pay')
    ])
</div>
