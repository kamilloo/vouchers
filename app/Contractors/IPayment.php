<?php

namespace App\Contractors;

use App\Models\Payment;
use Carbon\Carbon;

/**
 * Interface IPayment
 *
 * @mixin Payment
 */
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
