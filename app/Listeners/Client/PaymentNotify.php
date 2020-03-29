<?php

namespace App\Listeners\Client;

use App\Events\OrderEvent;
use App\Events\OrderWasPlaced;
use App\Events\PaymentEvent;
use App\Models\Order;
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
        $order->client->notify(new $notification($order));
    }

    abstract protected function notification(): string;
}
