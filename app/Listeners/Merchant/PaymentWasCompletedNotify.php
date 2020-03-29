<?php

namespace App\Listeners\Merchant;

use App\Events\OrderWasPlaced;
use App\Events\PaymentWasCompleted;
use App\Listeners\Merchant\PaymentNotify;
use App\Models\Order;
use App\Notifications\Merchant\OrderWasPlaceNotification;
use App\Notifications\Merchant\PaymentWasBeganNotification;
use App\Notifications\Merchant\PaymentWasCompletedNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentWasCompletedNotify extends PaymentNotify
{
    protected function notification(): string
    {
        return PaymentWasCompletedNotification::class;
    }
}
