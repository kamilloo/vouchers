<?php

namespace App\Listeners;

use App\Events\OrderWasPlaced;
use App\Notifications\OrderWasPlaceNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderWasPlacedNotify
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderWasPlaced  $event
     * @return void
     */
    public function handle(OrderWasPlaced $event)
    {
        $event->getOrder()->merchant->user->notify(new OrderWasPlaceNotification($event->getOrder()));
    }
}
