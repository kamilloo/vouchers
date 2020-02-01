<?php

namespace App\Http\Controllers;

use App\Contractors\IPayment;
use App\Contractors\IPaymentGateway;
use App\Http\Requests\Checkout;
use App\Http\Requests\PaymentCallbackStatus;
use App\Models\Enums\StatusType;
use App\Models\Merchant;
use App\Models\Payment;
use App\Models\Voucher;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentOrderController extends Controller
{
    public function create(Merchant $merchant, Order $order, IPaymentGateway $payment_gateway)
    {
        $payment = $payment_gateway->pay($order, $merchant);

        if ($order->isNew())
        {
            return redirect()->away($payment->link());
        }
        if ($order->isRejected())
        {
            return redirect()->route('payment.failed', [
                'payment' => $payment,
            ])->with(['error' => __('You bought voucher failed.')]);
        }
        if ($order->isWaiting() || $order->isNew() )
        {
            return redirect()->route('payment.recap', [
                'payment' => $payment,
            ])->with(['success' => __('You bought voucher successful.')]);
        }


    }

    public function callbackReturn(Payment $payment, IPaymentGateway $payment_gateway)
    {
        $payment->order->moveStatusToWaiting();
        $verify = $payment_gateway->verify($payment);
        $merchant = $payment->merchant->fresh();

        if ($verify)
        {
            $payment->order->qr_code = uniqid();
            $payment->order->expired_at = Carbon::now()->addDays($merchant->shopSettings->expiry_after);
            $payment->order->save();
            $payment->order->moveStatusToConfirmed();

            return redirect()->route('payment.recap', [
                'payment' => $payment,
            ])->with(['success' => __('You bought voucher successful.')]);
        }
        if ($payment->order->isRejected())
        {
            return redirect()->route('payment.failed', [
                'payment' => $payment,
            ])->with(['error' => __('You bought voucher failed.')]);
        }

        $order = $payment->order;
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
        ))->with(['success' => __('You bought voucher successful.')]);
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

    public function failed(Payment $payment)
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

        return view('payment.failed.'. $template_path, compact(
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
