<?php

namespace App\Models\Enums;

class DeliveryType
{
    const ONLINE = 'online';

    const POST = 'post';

    const PERSONAL = 'personal';

    const ZERO_DELIVERY_COST = 0;
    const PERSONAL_DELIVERY_COST = 0;

    public static function all(): array
    {
        return [
            self::ONLINE,
            self::POST,
            self::PERSONAL,
        ];
    }

    static public function description(): array
    {
        return [
            self::ONLINE => __('We send your Voucher online'),
            self::POST => __('We send your Voucher by Post'),
            self::PERSONAL => __('You can pick up Voucher personal'),
        ];
    }

    static public function titles(): array
    {
        return [
            self::ONLINE => __('Online'),
            self::POST => __('Post'),
            self::PERSONAL => __('Personal'),
        ];
    }
}
