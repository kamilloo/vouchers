<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdate;
use App\Http\Requests\VoucherStore;
use App\Http\Requests\VoucherUpdate;
use App\Models\Order;
use App\Models\UserProfile;
use App\Models\Voucher;
use App\Notifications\SendVoucher;
use Barryvdh\DomPDF\PDF;
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
    /**
     * @var PDF
     */
    protected $generator;

    public function __construct(PDF $generator)
    {

        $this->authorizeResource(Order::class);
        $this->generator = $generator;
    }

    public function download(Order $order)
    {
        $pdf = $this->createPdf($order);

        return $pdf->download();
    }

    public function send(Order $order)
    {
        $pdf = $this->createPdf($order);

        $mailable = new \App\Mail\SendVoucher($order);
        $mailable->attachData($pdf->output(), 'voucher.pdf');

        Mail::to($order->email)->send($mailable);

        return back()->with(['success' => 'Mail was send successful!']);
    }

    public function push(Order $order)
    {
        //push
    }

    /**
     * @param Order $order
     * @param PDF $generator
     *
     * @return PDF
     */
    protected function createPdf(Order $order): PDF
    {
        $order = $order->load('merchant', 'voucher');
        $user_profile = $order->merchant->user->profile;
        $pdf = $this->generator->loadView('pdf.voucher', compact('order', 'user_profile'));

        return $pdf;
    }
}
