<?php

namespace App\Http\Controllers;

use App\Http\Requests\Checkout;
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
        $order_details = $request->only(array_keys($request->rules()));
        $order = $merchant->orders()->create($order_details);
        return redirect()->route('checkout.confirmation', compact('merchant', 'order'))->with('success', 'Your order was placed.');
    }

    public function confirmation(Merchant $merchant, Order $order)
    {

        return view('checkout.confirmation', compact('merchant', 'order'));
    }
}
