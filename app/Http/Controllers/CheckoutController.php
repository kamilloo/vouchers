<?php

namespace App\Http\Controllers;

use App\Http\Requests\Checkout;
use App\Models\Merchant;
use App\Models\Voucher;
use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function start(Merchant $merchant)
    {
        $vouchers = Voucher::all();
        return view('checkout.start', compact('vouchers', 'merchant'));
    }

    public function proceed(Checkout $request)
    {
        $order_details = $request->only(array_keys($request->rules()));
        Order::create($order_details);
        return redirect()->route('checkout.confirmation')->with('success', 'Your order was placed.');
    }

    public function confirmation()
    {
        return view('checkout.confirmation');
    }
}
