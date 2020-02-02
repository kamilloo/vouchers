<?php

namespace App\Listeners;

use App\Events\OrderWasPlaced;
use App\Models\Order;
use App\Notifications\OrderWasPlaceNotification;
use App\Notifications\VoucherWasSentNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class VoucherWasSentNotify extends OrderNotify
{
    protected function notification(): string
    {
        return VoucherWasSentNotification::class;
    }
}
