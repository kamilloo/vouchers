<?php

namespace App\Listeners\Merchant;

use App\Events\OrderEvent;
use App\Events\OrderWasPlaced;
use App\Models\Order;
use App\Notifications\Merchant\OrderWasPlaceNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

abstract class OrderNotify
{
    /**
     * Handle the event.
     *
     * @param  OrderEvent $event
     * @return void
     */
    public function handle(OrderEvent $event)
    {
        $notification = $this->notification();
        $order = $event->getOrder();;
        $order->merchant->user->notify(new $notification($order));
    }

    abstract protected function notification(): string;
}
