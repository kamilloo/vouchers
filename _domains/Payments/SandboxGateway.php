<?php

namespace Domain\Payments;

use App\Contractors\IOrder;
use App\Contractors\IPayment;
use App\Contractors\IPaymentGateway;
use App\Models\Payment;

class SandboxGateway implements IPaymentGateway
{

    public function pay(IOrder $order): IPayment
    {
        $payment = factory(Payment::class)->create();
        $payment->payment_link = route('payment.sandbox-gateway', $payment);
        return $payment;
    }

    public function confirm(IPayment $payment): bool
    {
        return true;
    }

    public function cancel(IPayment $payment): bool
    {
        return true;
    }

    public function return(IPayment $payment): bool
    {
        return true;
    }

    public function confirmation(IPayment $payment): bool
    {
        return true;
    }

    public function verify(IPayment $payment): bool
    {
        return true;
    }
}
