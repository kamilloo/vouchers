<?php

namespace App\Contractors;

use App\Models\Voucher;

interface IVoucherRepository
{
    public function first(IOrder $order): Voucher;

}
