<?php

namespace App\Listeners\Client;

use App\Events\OrderWasPlaced;
use App\Models\Order;
use App\Notifications\Client\VoucherWasSentNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class VoucherWasSentNotify extends OrderNotify
{
    protected function notification(): string
    {
        return VoucherWasSentNotification::class;
    }
}
