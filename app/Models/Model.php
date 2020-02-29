<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model as VendorModel;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

abstract class Model extends VendorModel
{
    protected $guarded = [''];

    public function scopeMine(Builder $query): Builder
    {
        return $query->whereUserId(auth()->id());
    }


    public function getRouteKey()
    {
        return \Hashids::encodeHex($this->getKey().config('hashids.start_primary_key'));
    }
}
