<?php

namespace Domain\Payments;

use App\Contractors\IOrder;
use App\Contractors\IPayment;
use App\Contractors\IPaymentGateway;
use App\Http\Requests\PaymentCallbackStatus;
use App\Models\Merchant;
use App\Models\Payment;
use App\Models\Transaction;
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
        /**
         * @var $payment Payment
         */
        $order_amount = $order->getAmount();
        $payment = $order->payments()->make([
            'amount' => $order_amount
        ]);
        $payment->merchant()->associate($merchant);
        $payment->save();

        $url_return = route('payment.return', $payment);
        $url_status = route('payment.status', $payment);
        $client_email = $order->getClientEmail();
        $client_name = $order->getClientName();
        $client_phone = $order->getClientPhone();
        $client_address = $order->getClientAddress();
        $client_postcode = $order->getClientPostcode();
        $client_city = $order->getClientCity();
        $client_country = $order->getClientCountry();
        $order_description = $order->getDescription();

        $transaction_order_data = compact('order_amount',
            'url_return',
            'url_status',
            'client_email',
            'client_name',
            'client_phone',
            'client_address',
            'client_postcode',
            'client_city',
            'client_country',
            'order_description'
        );

        $this->gateway
            ->setUrlReturn($url_return)
            ->setUrlStatus($url_status)

            ->setEmail($client_email)
            ->setClientName($client_name)
            ->setClientPhone($client_phone)
            ->setAddress($client_address)
            ->setZipCode($client_postcode)
            ->setCity($client_city)
            ->setCountry($client_country)

            ->setAmount($order_amount)
            ->setDescription($order_description);
        if (! $order->getVoucher()->isQuoteType())
        {
            $product_title = $order->getProductTitle();
            $product_description = $order->getProductDescription();
            $this->gateway
                ->setArticle($product_title)
                ->setArticleDescription($product_description);

            $transaction_order_data += compact(
                'product_title',
                'product_description'
            );
        }

        $register_payment = $this->gateway->init();


        $payment_registered = $register_payment->isSuccess();

        $transaction = $payment->transactions()->make($transaction_order_data + [
            'request_parameters' => $register_payment->getRequestParameters(),
            'is_register' => $payment_registered,
        ]);

        if($payment_registered)
        {
            $token = $register_payment->getToken();

            $transaction->session_id = $register_payment->getSessionId();
            $transaction->token = $token;

            $payment->payment_link = $this->gateway->execute($token);
            $payment->save();

        }else{

            $transaction->error_code = $register_payment->getErrorCode();
            $transaction->error_description = $register_payment->getErrorDescription();
        }

        $transaction->save();

        return $payment;
    }

    public function cancel(IPayment $payment): bool
    {
        // TODO: Implement cancel() method.
    }

    public function return(IPayment $payment): bool
    {
        // TODO: Implement return() method.
    }

    public function confirmation(IPayment $payment, PaymentCallbackStatus $request): void
    {
        $payment_response = $this->gateway->receive($request);

        if ($payment_response->isSuccess()) {
//            $payment->payment_link = $payment_response->getSessionId();
//            $payment->save();
        }
        return;
    }

    public function verify(IPayment $payment): bool
    {
        return $payment->paid();
    }
}
