<?php

namespace App\Http\Controllers;

use App\Contractors\IPayment;
use App\Contractors\IPaymentGateway;
use App\Http\Requests\Checkout;
use App\Models\Merchant;
use App\Models\Voucher;
use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function create(Merchant $merchant, Order $order, IPaymentGateway $payment_gateway)
    {
        $payment = $payment_gateway->pay($order);

        return redirect()->away($payment->link());
    }

    public function return()
    {

    }

    public function status()
    {

    }
}
