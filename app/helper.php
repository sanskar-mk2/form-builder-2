<?php

use App\Models\User;

class EnumHelper
{
    /** Values */
    public static function v(array $e): array
    {
        return array_column($e, 'value');
    }

    /** Keys */
    public static function k(array $e): array
    {
        return array_column($e, 'name');
    }

    /** Keys => Values */
    public static function kv(array $e): array
    {
        return array_column($e, 'value', 'name');
    }

    /** Values => Keys */
    public static function vk(array $e): array
    {
        return array_column($e, 'name', 'value');
    }
}

if (!function_exists('auther')) {
    function auther(): User
    {
        return auth()->user();
    }
}
