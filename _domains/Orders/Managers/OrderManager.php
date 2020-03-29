<?php
declare(strict_types=1);

namespace Domain\Orders\Managers;

use App\Events\PaymentWasConfirmed;
use App\Events\VoucherWasSent;
use App\Http\ContentTypes\Tag;
use App\Http\Requests\ProfileUpdate;
use App\Models\Merchant;
use App\Models\User;
use Carbon\Carbon;
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

class OrderManager
{

    /**
     * @var Dispatcher
     */
    protected $event_dispatcher;

    public function __construct(Dispatcher $event_dispatcher)
    {

        $this->event_dispatcher = $event_dispatcher;
    }

    public function confirm(\App\Models\Payment $payment)
    {
        $merchant = $payment->merchant->fresh();
        $expired_at = $this->getVoucherExpiredDate($merchant);
        $payment->order->generateQrCode($expired_at);
        $payment->order->moveStatusToConfirmed();
        $payment->order->checkAsPaid();
        $this->event_dispatcher->dispatch(new VoucherWasSent($payment->order));
    }


    /**
     * @param Merchant $merchant
     *
     * @return Carbon
     */
    protected function getVoucherExpiredDate(Merchant $merchant): Carbon
    {
        if ($merchant->hasShopSettings() && !empty($merchant->getVoucherExpireAfterSetting())) {
            $expiry_after = $merchant->getVoucherExpireAfterSetting();
            return Carbon::now()->addDays($expiry_after);
        }
        return Carbon::now();
    }
}
