<?php

namespace App\Models;

class Merchant extends Model
{
    protected $guarded = [];

    protected $with = [
        'template',
        'shopStyles',
        'shopImages',
        'user'
    ];

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function shopStyles()
    {
        return $this->hasOne(ShopStyle::class);
    }

    public function shopImages()
    {
        return $this->hasOne(ShopImage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vouchers()
    {
        return $this->hasMany(Voucher::class);
    }

    public function serviceCategories()
    {
        return $this->hasMany(ServiceCategory::class, 'merchant_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|ServicePackage
     */
    public function servicePackages()
    {
        return $this->hasMany(ServicePackage::class, 'merchant_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'merchant_id');
    }
}
