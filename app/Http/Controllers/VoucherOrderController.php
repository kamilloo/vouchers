<?php

namespace App\Http\Controllers;

use App\Events\VoucherWasDelivered;
use App\Http\Requests\ProfileUpdate;
use App\Http\Requests\VoucherStore;
use App\Http\Requests\VoucherUpdate;
use App\Http\ViewModels\OrderViewModel;
use App\Http\ViewModels\PdfViewModel;
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

        return back()->with(['success' => __('Mail was send successful!')]);
    }

    public function push(Order $order)
    {
        //push
    }

    public function failed(Order $order)
    {
        $merchant = $order->merchant->fresh();

        $view_model = new OrderViewModel($merchant, $order);

        return view('payment.failed.'. $view_model->templatePath(), $view_model);
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

        $view_model = new PdfViewModel($order->merchant, $order);

        return $this->generator->loadView('pdf.voucher', $view_model);
    }
}
