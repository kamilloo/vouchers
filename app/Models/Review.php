<?php

namespace App\Models;

use App\Http\Presenters\OrderPresenter;
use App\Http\Presenters\ReviewPresenter;

class Review extends Model
{
    public function scopeToMe($query)
    {
        return $query->whereHas('merchant.user', function ($query){
            return $query->where('id', auth()->id());
        });
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    /**
     * @return ReviewPresenter
     */
    public function getPresenterAttribute(): ReviewPresenter
    {
        return new ReviewPresenter($this);
    }
}
