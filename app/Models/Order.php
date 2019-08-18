<?php

namespace App\Models;

use App\Contractors\IOrder;

class Order extends Model implements IOrder
{
    public function Merchant()
    {
        return $this->belongsTo(Merchant::class);
    }


    public function scopeToMe($query)
    {
        return $query->whereHas('merchant.user', function ($query){
            return $query->where('id', auth()->id());
        });
    }
}
