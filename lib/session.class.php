<?php

class Session
{
    const FLASH = 'flash';

    public static function setFlash($message)
    {
        $_SESSION[self::FLASH] = $message;
    }

    public static function hasFlash()
    {
        return !empty($_SESSION[self::FLASH]);
    }

    public static function flash()
    {
        echo $_SESSION[self::FLASH];
        $_SESSION[self::FLASH] = null;
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public static function clear($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
}