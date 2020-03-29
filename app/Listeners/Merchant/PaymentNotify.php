<?php

namespace App\Listeners\Merchant;

use App\Events\OrderEvent;
use App\Events\OrderWasPlaced;
use App\Events\PaymentEvent;
use App\Models\Order;
use App\Notifications\Merchant\OrderWasPlaceNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

abstract class PaymentNotify
{
    /**
     * Handle the event.
     *
     * @param  PaymentEvent $event
     * @return void
     */
    public function handle(PaymentEvent $event)
    {
        $notification = $this->notification();
        $order = $event->getPayment()->order;;
        $order->merchant->user->notify(new $notification($order));
    }

    abstract protected function notification(): string;
}
