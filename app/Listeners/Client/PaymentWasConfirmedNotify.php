<?php

namespace App\Listeners\Client;

use App\Events\OrderWasPlaced;
use App\Models\Order;
use App\Notifications\Client\PaymentWasConfirmedNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentWasConfirmedNotify extends PaymentNotify
{
    protected function notification(): string
    {
        return PaymentWasConfirmedNotification::class;
    }
}
