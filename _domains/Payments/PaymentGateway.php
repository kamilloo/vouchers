<?php

namespace Domain\Payments;

use App\Contractors\IOrder;
use App\Contractors\IPayment;
use App\Contractors\IPaymentGateway;
use App\Models\Merchant;
use App\Models\Payment;
use Devpark\Transfers24\Requests\Transfers24;

class PaymentGateway implements IPaymentGateway
{
    /**
     * @var Transfers24
     */
    protected $gateway;

    public function __construct(Transfers24 $gateway)
    {
        $this->gateway = $gateway;
    }

    public function pay(IOrder $order, Merchant $merchant): IPayment
    {
        $payment = factory(Payment::class)->create([
            'order_id' => $order->id,
            'merchant_id' => $merchant->id
        ]);

        $register_payment = $this->gateway
            ->setUrlReturn(route('payment.return', $payment))
            ->setUrlStatus(route('payment.status', $payment))
            ->setEmail('test@example.com')
            ->setAmount(100)->setArticle('Article Name')->init();

        if($register_payment->isSuccess())
        {

            $token = $register_payment->getToken();
            $payment->payment_link = $this->gateway->execute($token);;
            $payment->save();
            // save registration parameters in payment object
        }

        return $payment;
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
    }

    public function verify(IPayment $payment): bool
    {
        return true;
    }
}
