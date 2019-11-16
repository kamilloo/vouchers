<?php

namespace App\Providers;

use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServicePackage;
use App\Models\Voucher;
use App\Policies\Policy;
use App\Policies\ServiceCategoryPolicy;
use App\Policies\VoucherPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Voucher::class => Policy::class,
        ServiceCategory::class => Policy::class,
        Service::class => Policy::class,
        ServicePackage::class => Policy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
