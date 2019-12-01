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
            [
                'value' => self::QUOTE,
                'label' => 'Quote',
            ],
            [
                'value' => self::SERVICE,
                'label' => 'Service',
            ],
            [
                'value' => self::SERVICE_PACKAGE,
                'label' => 'Service Package',
            ],
        ];
    }

    public static function view():string
    {
        return \GuzzleHttp\json_encode(self::description());
    }
}
