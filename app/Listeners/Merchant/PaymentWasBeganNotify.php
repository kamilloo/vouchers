<?php

namespace App\Listeners\Merchant;

use App\Events\OrderWasPlaced;
use App\Listeners\Merchant\PaymentNotify;
use App\Models\Order;
use App\Notifications\Merchant\OrderWasPlaceNotification;
use App\Notifications\Merchant\PaymentWasBeganNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentWasBeganNotify extends PaymentNotify
{
    protected function notification(): string
    {
        return PaymentWasBeganNotification::class;
    }
}
