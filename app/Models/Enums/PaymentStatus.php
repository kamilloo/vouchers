<?php

namespace App\Models\Enums;

class PaymentStatus
{
    const WAITING_FOR_PAY = 0;
    const PAID = 1;

    public static function all(): array
    {
        $types = new \ReflectionClass(self::class);
        return $types->getConstants();
    }
}