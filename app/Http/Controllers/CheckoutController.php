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
        return view('templates.template'. $merchant->template->id, compact('vouchers', 'merchant'));
//        return view('checkout.start', compact('vouchers', 'merchant'));
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
