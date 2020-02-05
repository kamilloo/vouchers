<?php

namespace App\Http\Controllers;

use App\Events\OrderWasPlaced;
use App\Http\Requests\Checkout;
use App\Http\ViewModels\TemplateViewModel;
use App\Managers\DeliveryManager;
use App\Models\Client;
use App\Models\Merchant;
use App\Models\Voucher;
use App\Models\Order;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\Request;
use Symfony\Contracts\EventDispatcher\Event;

class CheckoutController extends Controller
{
    /**
     * @var DeliveryManager
     */
    protected $delivery_manager;

    public function __construct(DeliveryManager $delivery_manager)
    {
        $this->delivery_manager = $delivery_manager;
    }

    public function start(Merchant $merchant, Voucher $voucher)
    {

//        if ($merchant->shopImages()->exists())
//        {
//            $custom_logo = $merchant->shopImages->logo_enabled ? $merchant->shopImages->logo : null;
//            $custom_background_image = $merchant->shopImages->front_enabled ? $merchant->shopImages->front : null;
//        }
//        if ($merchant->shopStyles()->exists())
//        {
//            $custom_welcoming = $merchant->shopStyles->welcoming;
//            $custom_background = $merchant->shopStyles->background_color;
//        }

        $template_view_model = new TemplateViewModel($merchant, $voucher, $this->delivery_manager);

        return view('templates.'. $merchant->template->file_name, $template_view_model);
    }

    public function proceed(Checkout $request, Merchant $merchant, Dispatcher $event_dispatcher)
    {
        $client = Client::create($request->getClientParam());
        $order = $this->makeOrder($request, $merchant);
        $order->client()->associate($client);
        $order->save();
        $event_dispatcher->dispatch(new OrderWasPlaced($order));
        return redirect()->route('checkout.confirmation', compact('merchant', 'order'))->with('success', __('Your order was placed.'));
    }

    public function confirmation(Merchant $merchant, Order $order)
    {
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

        return view('checkout.confirmation.'. $merchant->template->file_name, compact(
            'vouchers',
            'merchant',
            'custom_logo',
            'custom_background_image',
            'custom_welcoming',
            'custom_background',
            'order'
        ));
    }

    /**
     * @param Checkout $request
     * @param Merchant $merchant
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function makeOrder(Checkout $request, Merchant $merchant): Order
    {
        return $merchant->orders()->make([
            'voucher_id' => $request->getVoucherIdParam(),
            'delivery' => $request->getDeliveryParam(),
            'price' => $request->getPriceParam(),
            'first_name' => $request->getFirstNameParam(),
            'last_name' => $request->getLastNameParam(),
            'phone' => $request->getPhoneParam(),
            'email' => $request->getEmailParam(),
        ]);
}
}
