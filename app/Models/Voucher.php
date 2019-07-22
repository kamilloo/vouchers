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
}