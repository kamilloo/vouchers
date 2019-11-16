<?php

namespace App\Models;

class Service extends Model
{
    protected $table = 'services';

    public function categories()
    {
        return $this->belongsToMany(ServiceCategory::class, 'category_service', 'service_id', 'category_id');
    }

    public function packages()
    {
        return $this->belongsToMany(ServicePackage::class, 'package_service', 'service_id', 'package_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Merchant
     */
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
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
