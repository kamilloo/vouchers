<?php

namespace App\Providers;

use App\Contractors\IPaymentGateway;
use Domain\Payments\PaymentGateway;
use Domain\Payments\SandboxGateway;
use Illuminate\Config\Repository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        $this->app->bind(IPaymentGateway::class, function (Repository $config){
            return $config->get('payments.gateway') === 'live' ?
                PaymentGateway::class : SandboxGateway::class;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
