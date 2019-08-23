<?php

namespace App\Contractors;

use App\Http\Requests\VoucherStore;
use App\Models\User;
use App\Models\Voucher;

interface IVoucherRepository
{
    public function create(VoucherStore $request, User $user): Voucher;

}
