<?php

namespace App\Listeners\Merchant;

use App\Events\OrderWasPlaced;
use App\Listeners\Merchant\OrderNotify;
use App\Models\Order;
use App\Notifications\Merchant\OrderWasPlaceNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderWasPlacedNotify extends OrderNotify
{
    protected function notification(): string
    {
        return OrderWasPlaceNotification::class;
    }
}
