<?php

namespace App\Models;

use App\Contractors\IPayment;

class Payment extends Model implements IPayment
{
    protected $link;

    public function link(): string
    {
        return $this->payment_link ?? 'payment_url';
    }
}
