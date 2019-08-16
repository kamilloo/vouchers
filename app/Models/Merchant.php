<?php

namespace App\Models;

class Merchant extends Model
{
    protected $guarded = [];

    public function template()
    {
        return $this->belongsTo(Template::class);
    }
}
