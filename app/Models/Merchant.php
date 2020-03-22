<?php

namespace App\Models;

use App\Http\Presenters\MerchantPresenter;
use App\Http\Presenters\OrderPresenter;
use App\Models\Enums\BackgroundColorType;

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

    public function getHomepage():string
    {
        return $this->user->profile->homepage ?? config('app.url');
    }


    /**
     * @return MerchantPresenter
     */
    public function getPresenterAttribute(): MerchantPresenter
    {
        return new MerchantPresenter($this);
    }

    public function hasShopImages():bool
    {
        return $this->shopImages()->exists();
    }

    /**
     * @return ShopImage|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\HasOne|null
     */
    public function getShopImages():?ShopImage
    {
        return $this->shopImages()->first();
    }

    public function hasShopStyles():bool
    {
        return $this->shopStyles()->exists();
    }

    public function hasShopSettings():bool
    {
        return $this->shopSettings()->exists();
    }

    public function getVoucherExpireAfterSetting():?int
    {
        return $this->shopSettings->expiry_after;
    }

    public function getDeliveryCostSetting():float
    {
        return $this->shopSettings->delivery_cost;
    }

    public function hasActiveLogo():bool
    {
        return $this->shopImages->logo_enabled;
    }

    public function hasActiveBackgroundImage():bool
    {
        return $this->shopImages->front_enabled;
    }

    public function getLogo():string
    {
        return $this->shopImages->logo;
    }

    public function getBackgroundImage():string
    {
        return $this->shopImages->front;
    }

    public function getBackground():string
    {

        return BackgroundColorType::toRgb($this->shopStyles->background_color);
    }

    public function getWelcoming():string
    {
        return $this->shopStyles->welcoming;
    }

    public function hasActiveBackground():bool
    {
        return !empty($this->shopStyles->background_color);
    }

    public function hasActiveWelcoming():bool
    {
        return !empty($this->shopStyles->welcoming);
    }
}
