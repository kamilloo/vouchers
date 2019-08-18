<?php

namespace App\Models;

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

    public function merchants()
    {
        return $this->belongsToMany(Merchant::class);
    }

    public function scopeForMerchant($query, Merchant $merchant)
    {
        return $query->whereHas('merchants', function ($query) use ($merchant){
            $query->where('id', $merchant->id);
        });
    }
}
