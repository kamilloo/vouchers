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

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

}
