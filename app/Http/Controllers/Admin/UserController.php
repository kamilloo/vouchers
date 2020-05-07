<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends AdminController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.users.index', [
            'users' => User::all()
        ]);
    }
}
