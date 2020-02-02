<?php

namespace App\Providers;

use App\Events\OrderWasPlaced;
use App\Events\PaymentWasBegan;
use App\Events\PaymentWasCompleted;
use App\Events\PaymentWasConfirmed;
use App\Events\VoucherWasDelivered;
use App\Events\VoucherWasReleased;
use App\Events\VoucherWasSent;
use App\Listeners\OrderWasPlacedNotify;
use App\Listeners\PaymentWasBeganNotify;
use App\Listeners\PaymentWasCompletedNotify;
use App\Listeners\PaymentWasConfirmedNotify;
use App\Listeners\VoucherWasDeliveredNotify;
use App\Listeners\VoucherWasReleasedNotify;
use App\Listeners\VoucherWasSentNotify;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        OrderWasPlaced::class => [
            OrderWasPlacedNotify::class
        ],
        PaymentWasBegan::class => [
            PaymentWasBeganNotify::class,
        ],
        PaymentWasCompleted::class => [
            PaymentWasCompletedNotify::class,
        ],
        PaymentWasConfirmed::class => [
            PaymentWasConfirmedNotify::class,
        ],
        VoucherWasSent::class => [
            VoucherWasSentNotify::class,
        ],
        VoucherWasDelivered::class => [
            VoucherWasDeliveredNotify::class,
        ],
        VoucherWasReleased::class => [
            VoucherWasReleasedNotify::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
