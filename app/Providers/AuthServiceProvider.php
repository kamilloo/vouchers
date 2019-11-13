<?php

namespace App\Providers;

use App\Models\ServiceCategory;
use App\Models\Voucher;
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
        Voucher::class => VoucherPolicy::class,
        ServiceCategory::class => ServiceCategoryPolicy::class,
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
