<?php

namespace App\Models;

use App\Contractors\IOrder;
use App\Http\Presenters\OrderPresenter;

class Order extends Model implements IOrder
{
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }


    public function scopeToMe($query)
    {
        return $query->whereHas('merchant.user', function ($query){
            return $query->where('id', auth()->id());
        });
    }

    public function scopeByQrCode($query, $qr_code)
    {
        $query->where('qr_code', $qr_code);
    }

    /**
     * @return OrderPresenter
     */
    public function getPresenterAttribute(): OrderPresenter
    {
        return new OrderPresenter($this);
    }


}
