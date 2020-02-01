@include('payment.recap.'.$template_path.'.box', [
   'title' => __('Congratulation!'),
   'lead' => $order->isOnline() ? __('You can send Voucher to :recipient', ['recipient' => $order->first_name,]) : __('You can contact with us by phone :phone or email :email', ['phone' => $order->merchant->user->profile->phone, 'email' => $order->merchant->user->email,]),
   'help' => $order->isOnline() ? __('Delivery your Voucher.') : __('Voucher will deliver to :recipient by Post', ['recipient' => $order->first_name])
])
