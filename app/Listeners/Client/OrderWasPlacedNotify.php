<?php

namespace App\Listeners\Client;

use App\Events\OrderWasPlaced;
use App\Models\Order;
use App\Notifications\Client\OrderWasPlaceNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderWasPlacedNotify extends OrderNotify
{
    protected function notification(): string
    {
        return OrderWasPlaceNotification::class;
    }
}
