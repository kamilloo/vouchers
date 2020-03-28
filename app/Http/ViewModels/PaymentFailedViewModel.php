<?php
declare(strict_types=1);

namespace App\Http\ViewModels;

use App\Managers\DeliveryManager;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\Voucher;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

class PaymentFailedViewModel extends OrderViewModel
{
    protected function boxContent():array
    {
        return [
            'title' => __('Transaction Failed!'),
            'lead' => __('You can contact with us by phone :phone or email :email', ['phone' => $this->merchant->user->profile->phone, 'email' => $this->merchant->user->email,]),
            'help' => __('You can make order again'),
        ];
    }
}
