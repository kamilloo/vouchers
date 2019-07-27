<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Voucher;
use Illuminate\Auth\Access\HandlesAuthorization;

class VoucherPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(User $user)
    {
        return true;
    }

    public function edit(User $user, Voucher $voucher)
    {
        return $voucher->isOwn($user);
    }

    public function update(User $user, Voucher $voucher)
    {
        return $voucher->isOwn($user);
    }

    public function delete(User $user, Voucher $voucher)
    {
        return $voucher->isOwn($user);
    }
}
