<?php

namespace App\Http\Controllers;

use App\Http\Requests\Checkout;
use App\Models\Client;
use App\Models\Merchant;
use App\Models\Voucher;
use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function start(Merchant $merchant, Voucher $voucher)
    {
        $vouchers = $voucher->forMerchant($merchant)->get();
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

        return view('templates.'. $merchant->template->file_name, compact(
            'vouchers',
            'merchant',
            'custom_logo',
            'custom_background_image',
            'custom_welcoming',
            'custom_background'
        ));
    }

    public function proceed(Checkout $request, Merchant $merchant)
    {
        $client = Client::create($request->getClientParam());
        $order = $this->makeOrder($request, $merchant);
        $order->client()->associate($client);
        $order->save();
        return redirect()->route('checkout.confirmation', compact('merchant', 'order'))->with('success', 'Your order was placed.');
    }

    public function confirmation(Merchant $merchant, Order $order)
    {

        return view('checkout.confirmation', compact('merchant', 'order'));
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
