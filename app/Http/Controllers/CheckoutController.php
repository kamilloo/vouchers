<?php

namespace App\Http\Controllers;

use App\Http\Requests\Checkout;
use App\Models\Voucher;
use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function start()
    {
        $vouchers = Voucher::all();
        return view('checkout.start', compact('vouchers'));
    }

    public function proceed(Checkout $request)
    {
        Order::create($request->only(array_keys($request->rules())));
        return redirect()->route('checkout.confirmation')->with('success', 'Your order was placed.');
    }

    public function confirmation()
    {
        return view('checkout.confirmation');
    }
}
