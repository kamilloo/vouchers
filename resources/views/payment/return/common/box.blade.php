@include('payment.recap.'.$template_path.'.box', [
   'lead' => __('You bought Voucher to :recipient', [
    'recipient' => $order->first_name,
   ]),
   'help' => __('Waiting for payment confirmation.')
])
