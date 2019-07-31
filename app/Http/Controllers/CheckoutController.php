<?php

namespace App\Http\Controllers;

use App\Http\Requests\Checkout;
use App\Models\Voucher;
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
        return redirect()->route('checkout.confirmation');
    }

    public function confirmation()
    {
        return view('checkout.confirmation');
    }
}
