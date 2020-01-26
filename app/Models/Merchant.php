<?php

namespace App\Models;

class Merchant extends Model
{
    protected $guarded = [];

    protected $with = [
        'template',
        'shopStyles',
        'shopImages',
        'shopSettings',
        'user'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Template
     */
    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne|ShopStyle
     */
    public function shopStyles()
    {
        return $this->hasOne(ShopStyle::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne|ShopImage
     */
    public function shopImages()
    {
        return $this->hasOne(ShopImage::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne|ShopSettings
     */
    public function shopSettings()
    {
        return $this->hasOne(ShopSettings::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|User
     */
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
