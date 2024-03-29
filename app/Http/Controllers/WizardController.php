<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WizardController extends Controller
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
        return view('home');
    }
}
