<?php

namespace App\Listeners;

use App\Events\OrderWasPlaced;
use App\Models\Order;
use App\Notifications\OrderWasPlaceNotification;
use App\Notifications\VoucherWasReleasedNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class VoucherWasReleasedNotify extends OrderNotify
{
    protected function notification(): string
    {
        return VoucherWasReleasedNotification::class;
    }
}
