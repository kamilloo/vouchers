<?php

namespace Domain\Payments;

use App\Contractors\IOrder;
use App\Contractors\IPayment;
use App\Contractors\IPaymentGateway;
use App\Models\Payment;

class TemplateProvider implements IPaymentGateway
{

    public function pay(IOrder $order): IPayment
    {
        return new Payment();
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

    public function confirmation(IPayment $payment): bool
    {
        // TODO: Implement confirmation() method.
    }

    public function verify(IPayment $payment): bool
    {
        // TODO: Implement verify() method.
    }
}
