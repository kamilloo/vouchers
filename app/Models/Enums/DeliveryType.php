<?php

namespace App\Models\Enums;

class DeliveryType
{
    const ONLINE = 'online';

    const POST = 'post';

    const ONLINE_DELIVERY_COST = 0;

    public static function all(): array
    {
        return [
            self::ONLINE,
            self::POST,
        ];
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
