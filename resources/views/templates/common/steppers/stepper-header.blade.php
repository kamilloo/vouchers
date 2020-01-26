<div class="bs-stepper-header" role="tablist">
    <!-- your steps here -->
    @include('templates.common.steppers.step', [
        'target' => 'vouchers-part',
        'counter' => 1,
        'label' => __('Vouchers')
    ])
    <div class="line"></div>
    @include('templates.common.steppers.step', [
        'target' => 'delivery-part',
        'counter' => 2,
        'label' => __('Delivery')
    ])
    <div class="line"></div>
    @include('templates.common.steppers.step', [
        'target' => 'information-part',
        'counter' => 3,
        'label' => __('Recipient')
    ])
    <div class="line"></div>
    @include('templates.common.steppers.step', [
        'target' => 'client-part',
        'counter' => 4,
        'label' => __('Details')
    ])
</div>
