<?php

namespace App\Models;

class ServiceCategory extends Model
{
    protected $table = 'service_categories';

    public function services()
    {
        return $this->belongsToMany(Service::class, 'category_service', 'category_id', 'service_id');
    }

    public function packages()
    {
        return $this->belongsToMany(ServicePackage::class, 'package_service', 'category_id', 'package_id');
    }

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
        dd($user->merchant()->where('id', $this->merchant_id)->exists());
        return $user->merchant()->where('id', $this->merchant_id)->exists();
    }
}
