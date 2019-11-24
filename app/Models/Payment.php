<?php

namespace App\Models;

use App\Contractors\IPayment;
use App\Http\Presenters\PaymentPresenter;
use App\Models\Transaction;
use Carbon\Carbon;

class Payment extends Model implements IPayment
{
    protected $link;

    public function link(): string
    {
        return $this->payment_link ?? 'payment_url';
    }

    public function scopeToMe($query)
    {
        return $query->whereHas('order.merchant.user', function ($query){
            return $query->where('id', auth()->id());
        });
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * @return PaymentPresenter
     */
    public function getPresenterAttribute(): PaymentPresenter
    {
        return new PaymentPresenter($this);
    }

    public function paid(): bool
    {
        return (bool)$this->paid_at;
    }

    public function paidAt(Carbon $paid_at): bool
    {
        $this->paid_at = $paid_at;
        return $this->save();
    }

    public function scopeByPaid($query)
    {
        $query->whereNotNull('paid_at');
    }
}
