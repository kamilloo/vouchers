<?php

namespace App\Http\Controllers;

use App\Contractors\IPayment;
use App\Contractors\IPaymentGateway;
use App\Http\Requests\Checkout;
use App\Http\Requests\PaymentCallbackStatus;
use App\Models\Merchant;
use App\Models\Payment;
use App\Models\Voucher;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create(Merchant $merchant, Order $order, IPaymentGateway $payment_gateway)
    {
        $payment = $payment_gateway->pay($order);

        return redirect()->away($payment->link());
    }

    public function callbackReturn(Payment $payment, IPaymentGateway $payment_gateway)
    {
        $verify = $payment_gateway->verify($payment);

        if ($verify)
        {
            return redirect()->route('payment.return', [
                'payment' => $payment,
            ]);
        }
        return view('payment.return');

    }

    public function callbackStatus(PaymentCallbackStatus $request)
    {
        return ;
    }

    public function recap(Merchant $merchant, Order $order, IPaymentGateway $payment_gateway)
    {
        return view('payment.recap');
    }
}
