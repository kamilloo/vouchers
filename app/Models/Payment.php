<?php

namespace App\Models;

use App\Contractors\IPayment;

class Payment extends Model implements IPayment
{
    protected $link;

    public function link(): string
    {
        return $this->payment_link ?? 'payment_url';
    }

    public function scopeToMe($query)
    {
        return $query->whereHas('order.merchant.user', function ($query){
            return $query->where('id', auth()->id());
        });
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
