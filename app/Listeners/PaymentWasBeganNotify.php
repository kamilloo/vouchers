<?php

namespace App\Listeners;

use App\Events\OrderWasPlaced;
use App\Models\Order;
use App\Notifications\OrderWasPlaceNotification;
use App\Notifications\PaymentWasBeganNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentWasBeganNotify extends PaymentNotify
{
    protected function notification(): string
    {
        return PaymentWasBeganNotification::class;
    }
}
