<?php

namespace App\Services;


class Constants
{
    private const STATUS = [
        1 => 'active',
        2 => 'closed',
        3 => 'archived',
    ];

    public static function getStatus(): array
    {
        return self::STATUS;
    }

    public static function getStatusByName(string $status): int
    {
        $array = array_flip(self::STATUS);
        return $array[$status];
    }

    public static function getStatusFlip(): array
    {
        return array_flip(self::STATUS);
    }

    public static function getStatusName(int $value): string
    {
        return self::STATUS[$value];
    }

    public static function getStatusChange($action): int
    {
        return match ($action) {
            'active' => 2,
            'closed' => 1,
            default => 3,
        };
    }
}

