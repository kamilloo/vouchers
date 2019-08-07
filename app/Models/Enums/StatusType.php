<?php

namespace App\Models\Enums;

class StatusType
{
    const NEW = 'new';
    const CONFIRM = 'confirm';
    const SENT = 'sent';
    const DELIVERY = 'delivery';
    const CANCELLED = 'cancelled';
    const REJECTED = 'rejected';
    const WAITING = 'waiting';
    const RETURNED = 'returned';

    public static function all(): array
    {
        $types = new \ReflectionClass(self::class);
        return $types->getConstants();
    }
}