<?php

namespace App\Models;

use App\Models\Descriptors\MorphType;

class Voucher extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isOwn(User $user): bool
    {
        return $this->user_id === $user->id;
    }

    /**
     * @return
     */
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function product()
    {
        return $this->morphTo(MorphType::PRODUCT);
    }

    public function scopeForMerchant($query, Merchant $merchant)
    {
        return $query->whereHas('merchants', function ($query) use ($merchant){
            $query->where('id', $merchant->id);
        });
    }
}
