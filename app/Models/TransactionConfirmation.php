<?php

namespace App\Models;

class TransactionConfirmation extends Model
{
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
