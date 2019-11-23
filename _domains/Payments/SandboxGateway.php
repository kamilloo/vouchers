<?php

namespace Domain\Payments;

use App\Contractors\IOrder;
use App\Contractors\IPayment;
use App\Contractors\IPaymentGateway;
use App\Http\Requests\PaymentCallbackStatus;
use App\Models\Merchant;
use App\Models\Payment;

class SandboxGateway implements IPaymentGateway
{

    public function pay(IOrder $order, Merchant $merchant): IPayment
    {
        $payment = factory(Payment::class)->create([
            'order_id' => $order->id,
            'merchant_id' => $merchant->id
        ]);
        $payment->payment_link = route('payment.sandbox-gateway', $payment);
        return $payment;
    }

    public function cancel(IPayment $payment): bool
    {
        return true;
    }

    public function return(IPayment $payment): bool
    {
        return true;
    }

    public function confirmation(IPayment $payment, PaymentCallbackStatus $request): void
    {
        //
    }

    public function verify(IPayment $payment): bool
    {
        return true;
    }
}
