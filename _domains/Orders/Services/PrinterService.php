<?php
declare(strict_types=1);

namespace Domain\Orders\Services;

use App\Http\ContentTypes\Tag;
use App\Http\Requests\Checkout;
use App\Http\Requests\ProfileUpdate;
use App\Http\ViewModels\PdfViewModel;
use App\Models\Order;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Domain\Merchants\Models\Branch;
use Domain\Merchants\Models\Skill;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use App\Models\UserProfile;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class PrinterService
{

    /**
     * @var Guard
     */
    protected $guard;
    /**
     * @var Dispatcher
     */
    protected $event_dispatcher;
    /**
     * @var PDF
     */
    protected $generator;

    public function __construct(PDF $generator, Guard $guard, Dispatcher $event_dispatcher)
    {
        $this->guard = $guard;
        $this->event_dispatcher = $event_dispatcher;
        $this->generator = $generator;
    }

    /**
     * @param Order $order
     * @param PDF $generator
     *
     * @return PDF
     */
    public function print(Order $order): PDF
    {
        $order = $order->load('merchant', 'voucher');

        $view_model = new PdfViewModel($order->merchant, $order);

        return $this->generator->loadView('pdf.voucher', $view_model);
    }
}
