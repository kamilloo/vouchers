@include('payment.failed.'.$template_path.'.box', [
   'title' => __('Transaction Failed!'),
   'lead' => __('You can contact with us by phone :phone or email :email', ['phone' => $order->merchant->user->profile->phone, 'email' => $order->merchant->user->email,]),
   'help' => __('You can make order again')
])
