<?php

namespace Rentit;

final class Session
{
    /**
     * Session start
     */
    public static function init()
    {
        session_start();
        self::set('id', session_id());
    }

    /**
     * Set an id to identify the session
     * @param $key
     * @param $value
     */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Retrieve the id
     * @param $key
     * @return mixed|null
     */
    public static function get($key)
    {
        if (self::exists($key)) {
            return $_SESSION[$key];
        } else {
            return null;
        }
    }

    /**
     * Detect if the session exists
     * @param string $key
     * @return bool
     */
    public static function exists(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    /**
     * Delete session key
     * @param $key
     */
    public static function del($key)
    {
        if (self::exists($key)) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * Delete session
     */
    public static function destroy()
    {
        session_destroy();
    }
}