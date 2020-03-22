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
                'label' => __('Quote'),
            ],
            [
                'value' => self::SERVICE,
                'label' => __('Service'),
            ],
            [
                'value' => self::SERVICE_PACKAGE,
                'label' => __('Service Package'),
            ],
        ];
    }

    public static function view():string
    {
        return \GuzzleHttp\json_encode(self::description());
    }
}
