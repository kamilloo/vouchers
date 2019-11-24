<?php

namespace App\Models;

class Client extends Model
{
    protected $guarded = [];

    public function order()
    {
        return $this->hasOne(Order::class);
    }
}
