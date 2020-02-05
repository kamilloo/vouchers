<?php

namespace App\Models;

class ShopImage extends Model
{
    protected $guarded = [];

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function adjustBackgroundImageSwitcher():bool
    {
        if (empty($this->front))
        {
            $this->front_enabled = false;
            return $this->save();
        }
        return true;
    }


    public function adjustLogoSwitcher():bool
    {
        if (empty($this->logo))
        {
            $this->logo_enabled = false;
            return $this->save();
        }
        return true;
    }
}
