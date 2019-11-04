<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdate;
use App\Http\Requests\VoucherStore;
use App\Http\Requests\VoucherUpdate;
use App\Models\Order;
use App\Models\UserProfile;
use App\Models\Voucher;
use App\Notifications\SendVoucher;
use Domain\Vouchers\VoucherRepository;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class VoucherOrderController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Order::class);
    }

    public function download(Order $order, \Barryvdh\DomPDF\PDF $generator)
    {
        $order = $order->load('merchant', 'voucher');
        $user_profile = $order->merchant->user->profile;
        $pdf = $generator->loadView('pdf.voucher', compact('order','user_profile'));

        return $pdf->download();
    }

    public function send(Order $order, \Barryvdh\DomPDF\PDF $generator)
    {
        $order = $order->load('merchant', 'voucher');
        $user_profile = $order->merchant->user->profile;
        $pdf = $generator->loadView('pdf.voucher', compact('order','user_profile'));

        $mailable = new \App\Mail\SendVoucher($order);
        $mailable->attachData($pdf->output(), 'voucher.pdf');
        Mail::to($order->email)
            ->send($mailable);
        return back()->with(['success' => 'Mail was send successful!']);
    }

    public function push(Order $order)
    {
        //push
    }
}
