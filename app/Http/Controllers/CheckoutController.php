<?php

namespace App\Http\Controllers;

use App\Events\OrderWasPlaced;
use App\Http\Requests\Checkout;
use App\Http\ViewFactories\CheckoutViewFactory;
use App\Http\ViewModels\OrderViewModel;
use App\Http\ViewModels\CheckoutViewModel;
use App\Managers\DeliveryManager;
use App\Models\Client;
use App\Models\Merchant;
use App\Models\Voucher;
use App\Models\Order;
use Domain\Orders\Services\CheckoutService;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\Request;
use Symfony\Contracts\EventDispatcher\Event;

class CheckoutController extends Controller
{
    /**
     * @var DeliveryManager
     */
    protected $delivery_manager;
    /**
     * @var CheckoutViewFactory
     */
    protected $view_factory;

    public function __construct(DeliveryManager $delivery_manager, CheckoutViewFactory $view_factory)
    {
        $this->delivery_manager = $delivery_manager;
        $this->view_factory = $view_factory;
    }

    public function start(Merchant $merchant, Voucher $voucher)
    {

        $view_model = new CheckoutViewModel($merchant, $voucher, $this->delivery_manager);

        return $this->view_factory->start($view_model);
    }

    public function proceed(Checkout $request, Merchant $merchant, CheckoutService $checkout_service)
    {
        $order = $checkout_service->proceed($request, $merchant);

        return redirect()
            ->route('checkout.confirmation', compact('merchant', 'order'))
            ->with('success', __('Your order was placed.'));
    }

    public function confirmation(Merchant $merchant, Order $order)
    {
        $view_model = new OrderViewModel($merchant, $order);

        return $this->view_factory->confirmation($view_model);
    }

}
