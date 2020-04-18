@if($order->isActive() && $order->isOnline())
    <div class="container-contact2-form-btn">
        <div class="col-5">

        @include('payment.recap.template-2.button', [
    'href' => route('voucher.download', $order),
    'label' => __('Download')
    ])
        </div>
        <div class="col-5">
            <form-lazy-loading action="{{ route('voucher.send', $order) }}">
                <template v-slot:button>
                    @include('payment.recap.template-2.button', [
                        'href' => '#',
                        'label' => __('Send to :recipient', ['recipient' => $order->first_name])
                        ])
                </template>
                    <template v-slot:form>
                    @csrf
                    <input class="form-control" type="text" name="email" value="{{ $order->email }}">
                        @include('payment.recap.template-2.submit', [
                            'label' => __('Send to :recipient', ['recipient' => $order->first_name])
                        ])
                    </template>

            </form-lazy-loading>
        </div>
    </div>
    {{--    @include('payment.recap.template-2.button', [--}}
    {{--        'href' => route('voucher.push', $order),--}}
    {{--        'label' => __('Send SMS to:recipient', ['recipient' => $order->first_name])--}}
    {{--    ])--}}
    @endif
<div class="container-contact2-form-btn justify-content-center">

    @include('payment.recap.template-2.button', [
        'href' => $merchant->getHomepage(),
        'label' => __('Back to homepage')
    ])
</div>
