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
}