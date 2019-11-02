<?php

namespace App\Contractors;

use App\Models\Merchant;

interface IPaymentGateway
{
    public function pay(IOrder $order, Merchant $merchant): IPayment;
    public function confirmation(IPayment $payment): bool;
    public function verify(IPayment $payment): bool;
    public function cancel(IPayment $payment): bool;
    public function return(IPayment $payment): bool;

}
