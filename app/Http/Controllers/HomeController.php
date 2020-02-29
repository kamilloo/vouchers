<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = Order::toMe()->latest()->limit(5)->get();
        $payments = Payment::toMe()->latest()->limit(5)->get();
//        $reviews = Review::toMe()->latest()->limit(5)->get();
        return view('home', compact('orders', 'payments', 'reviews'));
    }
}
