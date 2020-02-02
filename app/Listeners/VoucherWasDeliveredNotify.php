<?php

namespace App\Listeners;

use App\Events\OrderWasPlaced;
use App\Models\Order;
use App\Notifications\OrderWasPlaceNotification;
use App\Notifications\VoucherWasDeliveredNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class VoucherWasDeliveredNotify extends OrderNotify
{
    protected function notification(): string
    {
        return VoucherWasDeliveredNotification::class;
    }
}
