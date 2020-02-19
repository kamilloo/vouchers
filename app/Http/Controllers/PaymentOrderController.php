<?php

namespace App\Http\Controllers;

use App\Contractors\IPayment;
use App\Contractors\IPaymentGateway;
use App\Events\PaymentWasBegan;
use App\Events\PaymentWasCompleted;
use App\Events\PaymentWasConfirmed;
use App\Exceptions\PaymentLinkNotAvailable;
use App\Http\Requests\Checkout;
use App\Http\Requests\PaymentCallbackStatus;
use App\Http\ViewModels\OrderViewModel;
use App\Models\Enums\StatusType;
use App\Models\Merchant;
use App\Models\Payment;
use App\Models\Voucher;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\Request;

class PaymentOrderController extends Controller
{
    public function create(Merchant $merchant, Order $order, IPaymentGateway $payment_gateway, Dispatcher $event_dispatcher)
    {
        try {
            $payment = $payment_gateway->pay($order, $merchant);
            $payment_link = $payment->link();
            $event_dispatcher->dispatch(new PaymentWasBegan($payment));
            return redirect()->away($payment_link);

        }catch (PaymentLinkNotAvailable $exception)
        {
            return redirect()->away($merchant->getHomepage());
        }

    }

    public function callbackReturn(Payment $payment, IPaymentGateway $payment_gateway, Dispatcher $event_dispatcher)
    {
        $payment->order->moveStatusToWaiting();
        $verify = $payment_gateway->verify($payment);
        $merchant = $payment->merchant->fresh();
//        $event_dispatcher->dispatch(new PaymentWasCompleted($payment));
        if ($verify)
        {
            $expired_at = $this->getVoucherExpiredDate($merchant);
            $payment->order->generateQrCode($expired_at);
            $payment->order->moveStatusToConfirmed();
            $payment->order->checkAsPaid();

            return redirect()->route('payment.recap', [
                'payment' => $payment,
            ])->with(['success' => __('You bought voucher successful.')]);
        }
        if ($payment->order->isRejected())
        {
            return redirect()->route('voucher.failed', [
                'order' => $payment->order,
            ])->with(['error' => __('You bought voucher failed.')]);
        }

        $order = $payment->order;

        $view_model = new OrderViewModel($merchant, $order);

        return view('payment.return.'. $view_model->templatePath(), $view_model)->with(['success' => __('You bought voucher successful.')]);
    }

    public function callbackStatus(PaymentCallbackStatus $request, Payment $payment, IPaymentGateway $payment_gateway, Dispatcher $event_dispatcher)
    {
        $payment_gateway->confirmation($payment, $request);
        $event_dispatcher->dispatch(new PaymentWasConfirmed($payment));

        echo "OK";
        return ;
    }

    public function recap(Payment $payment)
    {
        $order = $payment->order;
        $merchant = $payment->merchant->fresh();
        $view_model = new OrderViewModel($merchant, $order);

        return view('payment.recap.'. $view_model->templatePath(), $view_model);
    }

    public function sandboxGateway(Payment $payment)
    {
        return redirect()->route('payment.return', $payment);
    }

    /**
     * @param Merchant $merchant
     *
     * @return Carbon
     */
    protected function getVoucherExpiredDate(Merchant $merchant): Carbon
    {
        if ($merchant->hasShopSettings() && !empty($merchant->getVoucherExpireAfterSetting())) {
            $expiry_after = $merchant->getVoucherExpireAfterSetting();
            return Carbon::now()->addDays($expiry_after);
        }
        return Carbon::now();
    }
}
