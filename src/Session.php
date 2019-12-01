<?php

namespace Rentit;

final class Session
{
    public static function init()
    {
        session_start();
        self::set('id', session_id());
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        if (self::exists($key)) {
            return $_SESSION[$key];
        } else {
            return null;
        }
    }

    public static function exists(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    public static function del($key)
    {
        if (self::exists($key)) {
            unset($_SESSION[$key]);
        }
    }

    public static function destroy()
    {
        session_destroy();
    }
}