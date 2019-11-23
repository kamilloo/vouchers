<?php

namespace App\Contractors;

use Carbon\Carbon;

interface IPayment
{
    public function link(): string ;
    public function paid(): bool ;
    public function paidAt(Carbon $paid_at):bool ;
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions();
}
