<?php
declare(strict_types=1);

namespace App\Http\ViewModels;

use App\Managers\DeliveryManager;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\Voucher;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

class PaymentRecapViewModel extends OrderViewModel
{
    protected function boxContent():array
    {
        return [
            'title' => __('Congratulation!'),
            'lead' => $order->isOnline() ? __('You can send Voucher to :recipient', ['recipient' => $order->first_name,]) : __('You can contact with us by phone :phone or email :email', ['phone' => $order->merchant->user->profile->phone, 'email' => $order->merchant->user->email,]),
            'help' => $order->isOnline() ? __('Delivery your Voucher.') : __('Voucher will deliver to :recipient by Post', ['recipient' => $order->first_name]),
        ];
    }
}
