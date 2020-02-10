<?php
declare(strict_types=1);

namespace App\Http\ViewModels;

use App\Managers\DeliveryManager;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\UserProfile;
use App\Models\Voucher;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

class PdfViewModel extends TemplateViewModel
{
    /**
     * @var Order
     */
    protected $order;

    public function __construct(Merchant $merchant, Order $order)
    {
        parent::__construct($merchant);
        $this->order = $order;
    }

    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'order' => $this->order,
            'user_profile' => $this->userProfile(),
            'qr_code' => $this->qrCode(),
        ]);
    }

    protected function qrCode(): string
    {
        return base64_encode(\QrCode::format('png')->size(400)->generate($order->qr_code));
    }

    protected function userProfile(): UserProfile
    {
        return $this->merchant->user->profile;
    }
}
