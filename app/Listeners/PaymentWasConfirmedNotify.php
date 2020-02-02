<?php

namespace App\Listeners;

use App\Events\OrderWasPlaced;
use App\Models\Order;
use App\Notifications\OrderWasPlaceNotification;
use App\Notifications\PaymentWasBeganNotification;
use App\Notifications\PaymentWasConfirmedNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentWasConfirmedNotify extends PaymentNotify
{
    protected function notification(): string
    {
        return PaymentWasConfirmedNotification::class;
    }
}
