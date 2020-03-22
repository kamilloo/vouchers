<?php

namespace App\Models\Enums;

class BackgroundColorType
{
    const WHITE = 'white';
    const RED = 'red';
    const BLUE = 'blue';
    const GREEN = 'green';
    const BLACK = 'black';

    public static function all(): array
    {
        $types = new \ReflectionClass(self::class);
        return $types->getConstants();
    }

    public static function rgb():array
    {
        return [
            self::WHITE => 'rgba(255,255,255,0.8)',
            self::RED => 'rgba(255,0,0,0.8)',
            self::GREEN => 'rgba(0,255,0,0.8)',
            self::BLUE => 'rgba(0,0,255,0.8)',
            self::BLACK => 'rgba(0,0,0,0.8)',
        ];
    }

    public static function toRgb(string $color): string
    {
        return self::rgb()[$color];
    }


}
