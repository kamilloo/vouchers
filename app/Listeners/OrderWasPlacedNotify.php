<?php

namespace App\Listeners;

use App\Events\OrderWasPlaced;
use App\Models\Order;
use App\Notifications\OrderWasPlaceNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderWasPlacedNotify extends OrderNotify
{
    protected function notification(): string
    {
        return OrderWasPlaceNotification::class;
    }
}
