<?php

namespace App\Models;

use App\Models\Client;
use App\Contractors\IOrder;
use App\Http\Presenters\OrderPresenter;
use App\Models\Enums\DeliveryType;
use App\Models\Enums\StatusType;
use App\Models\Traits\OrderConcern;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;

class Order extends Model implements IOrder
{
    use OrderConcern;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Merchant
     */
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Voucher
     */
    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Client
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }


    public function scopeToMe($query)
    {
        return $query->whereHas('merchant.user', function ($query){
            return $query->where('id', auth()->id());
        });
    }

    public function scopeByQrCode($query, $qr_code)
    {
        $query->where('qr_code', $qr_code);
    }

    /**
     * @return OrderPresenter
     */
    public function getPresenterAttribute(): OrderPresenter
    {
        return new OrderPresenter($this);
    }

    public function paid():bool
    {
        return $this->payments()->byPaid()->exists();
    }

    public function expired():bool
    {
        return !is_null($this->expired_at) && $this->expired_at < Carbon::now();
    }

    public function isUsed():bool
    {
        return !is_null($this->used_at);
    }

    public function pay():bool
    {
        $this->used_at = Carbon::now();
        return $this->save();
    }

    public function isOnline():bool
    {
        return $this->delivery == DeliveryType::ONLINE;
    }

    public function isNew():bool
    {
        return $this->status === StatusType::NEW;
    }

    public function isWaiting():bool
    {
        return $this->status === StatusType::WAITING;
    }

    public function isCompleted():bool
    {
        return !$this->isNew() || !$this->isWaiting();
    }

    public function isConfirmed():bool
    {
        return $this->status === StatusType::CONFIRM;
    }

    public function isRejected():bool
    {
        return $this->status === StatusType::REJECTED;
    }

    public function moveStatusToWaiting():bool
    {
        if ($this->isNew())
        {
            $this->status = StatusType::WAITING;
            return $this->save();
        }
        return false;
    }

    public function moveStatusToRejected():bool
    {
        if ($this->isNew() || $this->isWaiting())
        {
            $this->status = StatusType::REJECTED;
            return $this->save();
        }
        return false;
    }

    public function moveStatusToConfirmed():bool
    {
        if ($this->isNew() || $this->isWaiting())
        {
            $this->status = StatusType::CONFIRM;
            return $this->save();
        }
        return false;
    }

    public function moveStatusToDeliver():bool
    {
        if ($this->isConfirmed())
        {
            $this->status = StatusType::DELIVERY;
            return $this->save();
        }
        return false;
    }

}
