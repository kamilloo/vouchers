<?php

namespace App\Models;

class ShopSettings extends Model
{
    protected $table = 'shop_settings';

    protected $guarded = [];

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }
}
