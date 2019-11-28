<?php

namespace App\Models\Enums;

class VoucherType
{
    const QUOTE = 'quote';

    const SERVICE = 'service';

    const SERVICE_PACKAGE = 'service-package';

    public static function all(): array
    {
        $types = new \ReflectionClass(self::class);
        return $types->getConstants();
    }

    public static function description(): array
    {
        return [
            self::QUOTE => 'quote',
            self::SERVICE => 'service',
            self::SERVICE_PACKAGE => 'service package',
        ];
    }
}
