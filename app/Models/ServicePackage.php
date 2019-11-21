<?php

namespace App\Models;

use App\Models\Descriptors\ProductType;

class ServicePackage extends Model
{
    protected $table = 'service_packages';

    public function services()
    {
        return $this->belongsToMany(Service::class, 'package_service', 'package_id', 'service_id');
    }

    public function categories()
    {
        return $this->belongsToMany(ServiceCategory::class, 'category_package', 'package_id', 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Merchant
     */
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }


    public function vouchers()
    {
        return $this->morphMany(Voucher::class, ProductType::SERVICE_PACKAGE);
    }

    public function scopeToMe($query)
    {
        return $query->whereHas('merchant.user', function ($query){
            return $query->where('id', auth()->id());
        });
    }

    public function isOwn(User $user): bool
    {
        return $user->merchant()->where('id', $this->merchant_id)->exists();
    }
}
