<div class="container-contact1-form-btn">
@include('payment.recap.template-1.button', [
        'href' => route('payment.create', compact('merchant', 'order')),
        'label' => __('Pay')
    ])
</div>
