<?php

namespace Domain\Payments;

use App\Contractors\IOrder;
use App\Contractors\IPayment;
use App\Contractors\IPaymentGateway;
use App\Models\Merchant;
use App\Models\Payment;

class PaymentGateway implements IPaymentGateway
{

    public function pay(IOrder $order, Merchant $merchant): IPayment
    {
        $payment = new Payment();
        $registration_request = app()->make(\Devpark\Transfers24\Requests\Transfers24::class);

        $register_payment = $registration_request
            ->setUrlReturn(route('payment.return', $payment))
            ->setUrlStatus(route('payment.status', $payment))
            ->setEmail('test@example.com')
            ->setAmount(100)->setArticle('Article Name')->init();

        if($register_payment->isSuccess())
        {
            // save registration parameters in payment object

            return $registration_request->execute($register_payment->getToken(), true);
        }


        return;
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
