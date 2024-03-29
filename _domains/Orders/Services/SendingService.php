<?php
declare(strict_types=1);

namespace Domain\Orders\Services;

use App\Events\VoucherWasDelivered;
use App\Http\ContentTypes\Tag;
use App\Http\Requests\Checkout;
use App\Http\Requests\ProfileUpdate;
use App\Http\Requests\VoucherSendRequest;
use App\Http\ViewFactories\VoucherOrderViewFactory;
use App\Http\ViewModels\PdfViewModel;
use App\Models\Order;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Domain\Merchants\Models\Branch;
use Domain\Merchants\Models\Skill;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use App\Models\UserProfile;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Mail;

class SendingService
{

    /**
     * @var PrinterService
     */
    protected $printer_service;
    /**
     * @var Dispatcher
     */
    protected $event_dispatcher;
    /**
     * @var Mailer
     */
    protected $mailer;

    public function __construct(PrinterService $printer_service, Dispatcher $event_dispatcher, Mailer $mailer)
    {
        $this->printer_service = $printer_service;
        $this->event_dispatcher = $event_dispatcher;
        $this->mailer = $mailer;
    }

    /**
     * @param VoucherSendRequest $email_provider
     * @param Order $order
     *
     * @return bool
     */
    public function send(VoucherSendRequest $email_provider, Order $order): bool
    {

        $voucher = $this->printer_service->print($order);

        $mailable = new \App\Mail\SendVoucher($order);
        $mailable->attachData($voucher->output(), 'voucher.pdf');

        $this->mailer->to($email_provider->getEmailParam())->send($mailable);

        $order->moveStatusToDeliver();
        $this->event_dispatcher->dispatch(new VoucherWasDelivered($order));

        return true;
    }
}
