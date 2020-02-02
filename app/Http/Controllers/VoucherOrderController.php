<?php

namespace App\Http\Controllers;

use App\Events\VoucherWasDelivered;
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
use Illuminate\Contracts\Events\Dispatcher;
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

        return $pdf->stream();
    }

    public function send(Order $order, Dispatcher $event_dispatcher)
    {
        $pdf = $this->createPdf($order);

        $mailable = new \App\Mail\SendVoucher($order);
        $mailable->attachData($pdf->output(), 'voucher.pdf');

        Mail::to($order->email)->send($mailable);

        $order->moveStatusToDeliver();
        $event_dispatcher->dispatch(new VoucherWasDelivered($order));

        return back()->with(['success' => 'Mail was send successful!']);
    }

    public function push(Order $order)
    {
        //push
    }

    public function failed(Order $order)
    {
        $merchant = $order->merchant->fresh();
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

        $template_path = $merchant->template->file_name;

        return view('payment.failed.'. $template_path, compact(
            'vouchers',
            'merchant',
            'custom_logo',
            'custom_background_image',
            'custom_welcoming',
            'custom_background',
            'order',
            'template_path'
        ));
    }

    /**
     * @param Order $order
     * @param PDF $generator
     *
     * @return PDF
     */
    protected function createPdf(Order $order): PDF
    {
        \QrCode::format('png')->size(400)->generate($order->qr_code ?? 'my code', public_path('qrcode.png'));
        $order = $order->load('merchant', 'voucher');
        $user_profile = $order->merchant->user->profile;
        $pdf = $this->generator
            ->loadView('pdf.voucher', compact('order', 'user_profile'));
        return $pdf;
    }
}
