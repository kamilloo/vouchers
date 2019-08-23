<?php

namespace Domain\Vouchers;

use App\Contractors\IOrder;
use App\Contractors\IPayment;
use App\Contractors\IPaymentGateway;
use App\Contractors\IVoucherRepository;
use App\Models\Payment;
use App\Models\Voucher;

class VoucherRepository implements IVoucherRepository
{

    public function first(IOrder $order): Voucher
    {
        // TODO: Implement first() method.
    }
}
