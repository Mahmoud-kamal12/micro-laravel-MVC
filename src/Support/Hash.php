<?php

namespace Lib\Support;

class Hash
{
    public static function make($value): string
    {
        return password_hash($value, PASSWORD_BCRYPT);
    }

    public static function hash($value): string
    {
        return sha1($value);
    }

    public static function verify($value, $hashedValue): bool
    {
        return password_verify($value, $hashedValue);
    }
}
