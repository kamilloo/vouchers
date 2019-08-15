<?php

namespace App\Contractors;

interface IPaymentGateway
{
    public function pay(IOrder $order): IPayment;
    public function confirmation(IPayment $payment): bool;
    public function verify(IPayment $payment): bool;
    public function cancel(IPayment $payment): bool;
    public function return(IPayment $payment): bool;

}
