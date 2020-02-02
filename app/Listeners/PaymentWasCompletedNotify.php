<?php

namespace App\Listeners;

use App\Events\OrderWasPlaced;
use App\Events\PaymentWasCompleted;
use App\Models\Order;
use App\Notifications\OrderWasPlaceNotification;
use App\Notifications\PaymentWasBeganNotification;
use App\Notifications\PaymentWasCompletedNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentWasCompletedNotify extends PaymentNotify
{
    protected function notification(): string
    {
        return PaymentWasCompletedNotification::class;
    }
}
