<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;

class Client extends Model
{
    use Notifiable;
    protected $guarded = [];

    public function order()
    {
        return $this->hasOne(Order::class);
    }
}
