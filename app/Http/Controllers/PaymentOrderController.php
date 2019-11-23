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

class PaymentOrderController extends Controller
{
    public function create(Merchant $merchant, Order $order, IPaymentGateway $payment_gateway)
    {
        $payment = $payment_gateway->pay($order, $merchant);

        return redirect()->away($payment->link());
    }

    public function callbackReturn(Payment $payment, IPaymentGateway $payment_gateway)
    {
        $verify = $payment_gateway->verify($payment);

        if ($verify)
        {
            return redirect()->route('payment.recap', [
                'payment' => $payment,
            ])->with(['success' => 'Congratulation!, you bought voucher successful.']);
        }
        return view('payment.return');

    }

    public function callbackStatus(PaymentCallbackStatus $request, Payment $payment, IPaymentGateway $payment_gateway)
    {
        $payment_gateway->confirmation($payment, $request);

        echo "OK";
        return ;
    }

    public function recap(Payment $payment)
    {
        $order = $payment->order;
        return view('payment.recap', compact('order'));
    }

    public function sandboxGateway(Payment $payment)
    {
        return redirect()->route('payment.return', $payment);
    }
}
