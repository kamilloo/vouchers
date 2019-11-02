<?php

namespace App\Models\Enums;

class DeliveryType
{
    const ONLINE = 'online';

    const POST = 'post';

    public static function all(): array
    {
        $types = new \ReflectionClass(self::class);
        return $types->getConstants();
    }

    static public function description(): array
    {
        return [
            self::ONLINE => __('We send your Voucher online.'),
            self::POST => __('We send your Voucher by Post.'),
        ];
    }

    static public function prices(): array
    {
        return [
            self::ONLINE => 0,
            self::POST => 100,
        ];
    }
}
