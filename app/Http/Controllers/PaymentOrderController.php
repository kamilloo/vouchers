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
            $payment->order->qr_code = uniqid();
            $payment->order->save();

            return redirect()->route('payment.recap', [
                'payment' => $payment,
            ])->with(['success' => 'Congratulation!, you bought voucher successful.']);
        }

        $order = $payment->order;
        $merchant = $payment->merchant->fresh();
        if ($merchant->shopImages()->exists())
        {
            $custom_logo = $merchant->shopImages->logo_enabled ? $merchant->shopImages->logo : null;
            $custom_background_image = $merchant->shopImages->front_enabled ? $merchant->shopImages->front : null;
        }
        if ($merchant->shopStyles()->exists())
        {
            $custom_welcoming = $merchant->shopStyles->welcoming;
            $custom_background = $merchant->shopStyles->background_color;
        }

        $template_path = $merchant->template->file_name;

        return view('payment.return.'. $template_path, compact(
            'vouchers',
            'merchant',
            'custom_logo',
            'custom_background_image',
            'custom_welcoming',
            'custom_background',
            'order',
            'template_path'
        ))->with(['success' => 'Congratulation!, you bought voucher successful.']);
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
        $merchant = $payment->merchant->fresh();
        if ($merchant->shopImages()->exists())
        {
            $custom_logo = $merchant->shopImages->logo_enabled ? $merchant->shopImages->logo : null;
            $custom_background_image = $merchant->shopImages->front_enabled ? $merchant->shopImages->front : null;
        }
        if ($merchant->shopStyles()->exists())
        {
            $custom_welcoming = $merchant->shopStyles->welcoming;
            $custom_background = $merchant->shopStyles->background_color;
        }

        $template_path = $merchant->template->file_name;

        return view('payment.recap.'. $template_path, compact(
            'vouchers',
            'merchant',
            'custom_logo',
            'custom_background_image',
            'custom_welcoming',
            'custom_background',
            'order',
            'template_path'
        ));
    }

    public function sandboxGateway(Payment $payment)
    {
        return redirect()->route('payment.return', $payment);
    }
}
