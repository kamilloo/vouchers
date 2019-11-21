<?php

namespace App\Models;

class Transaction extends Model
{

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function reflections()
    {
        return $this->hasMany(TransactionReflection::class);
    }
}
