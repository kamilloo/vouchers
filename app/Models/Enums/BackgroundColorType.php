<?php

namespace App\Models\Enums;

class BackgroundColorType
{
    const WHITE = 'white';
    const RED = 'red';

    public static function all(): array
    {
        $types = new \ReflectionClass(self::class);
        return $types->getConstants();
    }


}
