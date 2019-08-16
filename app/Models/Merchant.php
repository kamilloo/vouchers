<?php

namespace App\Models;

class Merchant extends Model
{
    protected $guarded = [];

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function ShopStyles()
    {
        return $this->hasOne(ShopStyle::class);
    }

    public function ShopImages()
    {
        return $this->hasOne(ShopImage::class);
    }

}
