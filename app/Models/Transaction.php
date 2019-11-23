<?php

namespace App\Models;

class Transaction extends Model
{

    protected $casts = [
      'request_parameters' => 'array',
      'error_description' => 'array',
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function confirmations()
    {
        return $this->hasMany(TransactionConfirmation::class);
    }
}
