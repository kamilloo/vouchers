<?php

namespace App\Models\Enums;

class BackgroundColorType
{
    const WHITE = 'white';
    const RED = 'red';
    const BLUE = 'blue';
    const GREEN = 'green';
    const BLACK = 'black';
    const NO_BACKGROUND = 'none';

    public static function all(): array
    {
        $types = new \ReflectionClass(self::class);
        return $types->getConstants();
    }

    public static function rgb():array
    {
        return [
            self::WHITE => 'rgba(255,255,255,0.8)',
            self::RED => 'rgba(204,0,0,0.8)',
            self::GREEN => 'rgba(0,153,51,0.8)',
            self::BLUE => 'rgba(51,153,255,0.8)',
            self::BLACK => 'rgba(0,0,0,0.8)',
            self::NO_BACKGROUND => 'none',
        ];
    }

    public static function description():array
    {
        return [
            self::WHITE => __('white'),
            self::RED => __('red'),
            self::GREEN => __('green'),
            self::BLUE => __('blue'),
            self::BLACK => __('black'),
            self::NO_BACKGROUND => __('colorless'),
        ];
    }

    public static function toRgb(string $color): string
    {
        return self::rgb()[$color];
    }


}
