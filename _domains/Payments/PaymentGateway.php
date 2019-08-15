<?php

namespace Domain\Payments;

use App\Contractors\IOrder;
use App\Contractors\IPayment;
use App\Contractors\IPaymentGateway;

class PaymentGateway implements IPaymentGateway
{

    public function pay(IOrder $order): IPayment
    {
        // TODO: Implement pay() method.
    }

    public function confirm(IPayment $payment): bool
    {
        // TODO: Implement confirm() method.
    }

    public function cancel(IPayment $payment): bool
    {
        // TODO: Implement cancel() method.
    }

    public function return(IPayment $payment): bool
    {
        // TODO: Implement return() method.
    }
}