<?php

namespace App\Models;

class TransactionReflection extends Model
{
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
