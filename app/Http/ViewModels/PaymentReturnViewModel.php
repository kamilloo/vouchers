<?php
declare(strict_types=1);

namespace App\Http\ViewModels;

use App\Managers\DeliveryManager;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\Voucher;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

class PaymentReturnViewModel extends OrderViewModel
{
    protected function boxContent():array
    {
        return [
            'title' => __('Congratulation!'),
            'lead' => __('You bought Voucher to :recipient', [
                'recipient' => $this->order->first_name,
            ]),
            'help' => __('Waiting for payment confirmation.'),
        ];
    }
}
