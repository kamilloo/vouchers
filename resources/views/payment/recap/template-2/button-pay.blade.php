<div class="container-contact2-form-btn">
@include('payment.recap.template-2.button', [
        'href' => route('payment.create', compact('merchant', 'order')),
        'label' => __('Pay')
    ])
</div>
