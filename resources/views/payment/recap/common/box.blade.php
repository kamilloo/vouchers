@include('payment.recap.'.$template_path.'.box', [
   'title' => __('Congratulation!'),
   'lead' => __('You can send Voucher to :recipient', [
    'recipient' => $order->first_name,
   ]),
   'help' => __('Delivery your Voucher.')
])
