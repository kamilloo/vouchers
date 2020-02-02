<?php

namespace App\Models\Enums;

class StatusType
{
    const NEW = 'new';
    const WAITING = 'waiting';
    const CONFIRM = 'confirm';
    const SENT = 'sent';
    const DELIVERY = 'delivery';
    const RELEASED = 'released';
    const REJECTED = 'rejected';
    const RETURNED = 'returned';
    const CANCELLED = 'cancelled';

    public static function all(): array
    {
        $types = new \ReflectionClass(self::class);
        return $types->getConstants();
    }

    public static function completed():array
    {
        return [
            self::CONFIRM,
            self::SENT,
            self::DELIVERY,
        ];
    }

    public static function active():array
    {
        return [
            self::NEW,
            self::WAITING,
            self::CONFIRM,
            self::SENT,
            self::DELIVERY,
        ];
    }

    public static function inactive():array
    {
        return [
            self::RELEASED,
            self::REJECTED,
            self::RETURNED,
            self::CANCELLED,
        ];
    }
}
