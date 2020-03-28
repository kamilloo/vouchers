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
use App\Http\ViewFactories\PaymentOrderViewFactory;
use App\Http\ViewModels\OrderViewModel;
use App\Http\ViewModels\PaymentRecapViewModel;
use App\Http\ViewModels\PaymentReturnViewModel;
use App\Models\Enums\StatusType;
use App\Models\Merchant;
use App\Models\Payment;
use App\Models\Voucher;
use App\Models\Order;
use Carbon\Carbon;
use Domain\Orders\Managers\OrderManager;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\Request;

class PaymentOrderController extends Controller
{
    /**
     * @var PaymentOrderViewFactory
     */
    protected $view_factory;

    public function __construct(PaymentOrderViewFactory $view_factory)
    {
        $this->view_factory = $view_factory;
    }

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

    public function callbackReturn(Payment $payment, IPaymentGateway $payment_gateway, Dispatcher $event_dispatcher, OrderManager $order_manager)
    {
        $payment->order->moveStatusToWaiting();
        $verify = $payment_gateway->verify($payment);
//        $event_dispatcher->dispatch(new PaymentWasCompleted($payment));
        if ($verify)
        {
            $order_manager->confirm($payment);

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
        $merchant = $payment->merchant->fresh();

        $view_model = new PaymentReturnViewModel($merchant, $order);

        return $this->view_factory->callbackReturn($view_model);

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
        $view_model = new PaymentRecapViewModel($merchant, $order);

        return $this->view_factory->recap($view_model);
    }

    public function sandboxGateway(Payment $payment)
    {
        return redirect()->route('payment.return', $payment);
    }
}
