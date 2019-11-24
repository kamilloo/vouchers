<?php

namespace App\Models;

class TransactionConfirmation extends Model
{

    protected $casts = [
        'request_parameters' => 'array',
        'receive_parameters' => 'array',
        'error_description' => 'array',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
