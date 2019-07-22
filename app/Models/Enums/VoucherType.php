<?php

namespace App\Models\Enums;

class VoucherType
{
    const QUOTE = 'quote';

    const SERVICE = 'service';

    public static function all(): array
    {
        $types = new \ReflectionClass(self::class);
        return $types->getConstants();
    }
}