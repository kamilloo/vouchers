<?php

namespace App\Http\Controllers;

use App\Events\VoucherWasDelivered;
use App\Http\Requests\ProfileUpdate;
use App\Http\Requests\VoucherStore;
use App\Http\Requests\VoucherUpdate;
use App\Http\ViewFactories\VoucherOrderViewFactory;
use App\Http\ViewModels\OrderViewModel;
use App\Http\ViewModels\PaymentFailedViewModel;
use App\Http\ViewModels\PdfViewModel;
use App\Models\Order;
use App\Models\UserProfile;
use App\Models\Voucher;
use App\Notifications\SendVoucher;
use Barryvdh\DomPDF\PDF;
use Domain\Orders\Services\PrinterService;
use Domain\Orders\Services\SendingService;
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
     * @var VoucherOrderViewFactory
     */
    protected $view_factory;
    /**
     * @var PrinterService
     */
    protected $printer_service;
    /**
     * @var SendingService
     */
    protected $sending_service;

    public function __construct(VoucherOrderViewFactory $view_factory, PrinterService $printer_service, SendingService $sending_service)
    {

        $this->authorizeResource(Order::class);
        $this->view_factory = $view_factory;
        $this->printer_service = $printer_service;
        $this->sending_service = $sending_service;
    }

    public function download(Order $order)
    {
        $voucher = $this->printer_service->print($order);

        return $voucher->stream();
    }

    public function send(Order $order)
    {
        $this->sending_service->send($order);

        return back()->with(['success' => __('Mail was send successful!')]);
    }

    public function push(Order $order)
    {
        //push
    }

    public function failed(Order $order)
    {
        $merchant = $order->merchant->fresh();

        $view_model = new PaymentFailedViewModel($merchant, $order);

        return $this->view_factory->failed($view_model);
    }
}
