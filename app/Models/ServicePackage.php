<?php

namespace App\Models;

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
}
