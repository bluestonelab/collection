<?php

namespace Bluestone\Collection;

use ArrayAccess;

class Arr
{
    public static function get($array, $key, $default = null): mixed
    {
        if (! static::accessible($array)) {
            return $default;
        }

        if (is_null($key)) {
            return $array;
        }

        if (static::exists($array, $key)) {
            return $array[$key];
        }

        if (! str_contains($key, '.')) {
            return $array[$key] ?? $default;
        }

        foreach (explode('.', $key) as $segment) {
            if (static::accessible($array) && static::exists($array, $segment)) {
                $array = $array[$segment];
            } else {
                return $default;
            }
        }

        return $array;
    }

    public static function accessible($value): bool
    {
        return is_array($value) || $value instanceof ArrayAccess;
    }

    public static function exists($array, $key): bool
    {
        if ($array instanceof ArrayAccess) {
            return $array->offsetExists($key);
        }

        if (is_float($key)) {
            $key = (string) $key;
        }

        return array_key_exists($key, $array);
    }
}
