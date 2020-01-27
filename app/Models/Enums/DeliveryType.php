<?php

namespace App\Models\Enums;

class DeliveryType
{
    const ONLINE = 'online';

    const POST = 'post';

    const ONLINE_DELIVERY_COST = 0;

    public static function all(): array
    {
        $types = new \ReflectionClass(self::class);

        return $types->getConstants();
    }

    static public function description(): array
    {
        return [
            self::ONLINE => __('We send your Voucher online'),
            self::POST => __('We send your Voucher by Post'),
        ];
    }

    static public function titles(): array
    {
        return [
            self::ONLINE => __('Online'),
            self::POST => __('Post'),
        ];
    }
}
