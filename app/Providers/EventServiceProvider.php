<?php

namespace App\Providers;

use App\Events\OrderWasPlaced;
use App\Events\PaymentWasBegan;
use App\Events\PaymentWasCompleted;
use App\Events\PaymentWasConfirmed;
use App\Events\VoucherWasDelivered;
use App\Events\VoucherWasReleased;
use App\Events\VoucherWasSent;
use App\Listeners\Merchant\OrderWasPlacedNotify;
use App\Listeners\Merchant\PaymentWasBeganNotify;
use App\Listeners\Merchant\PaymentWasCompletedNotify;
use App\Listeners\Merchant\PaymentWasConfirmedNotify;
use App\Listeners\Merchant\VoucherWasDeliveredNotify;
use App\Listeners\Merchant\VoucherWasReleasedNotify;
use App\Listeners\Merchant\VoucherWasSentNotify;
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
            OrderWasPlacedNotify::class,
            \App\Listeners\Client\OrderWasPlacedNotify::class
        ],
        PaymentWasBegan::class => [
            PaymentWasBeganNotify::class,
        ],
        PaymentWasCompleted::class => [
            PaymentWasCompletedNotify::class,
        ],
        PaymentWasConfirmed::class => [
            PaymentWasConfirmedNotify::class,
            \App\Listeners\Client\PaymentWasConfirmedNotify::class
        ],
        VoucherWasSent::class => [
            VoucherWasSentNotify::class,
            \App\Listeners\Client\VoucherWasSentNotify::class
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
