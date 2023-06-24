<?php

namespace Helpers;

class SessionHelper
{
    public static function start()
    {
        if(!isset($_SESSION)){
            session_start();
        }
    }

    public static function destroy()
    {
        if(!$_SESSION)
        {
            session_destroy();
        }
    }

    public static function store($key,$value)
    {
        self::start();
        $_SESSION[$key] = $value;
    }

    public static function delete($key)
    {
        self::start();
        unset($_SESSION[$key]);
    }

    public static function get($key) : string|array|null
    {
        self::start();
        return $_SESSION[$key];
    }


    /**
     * @param $key
     * @return string|array|null
     * Trả về session có key và xóa luôn -> dùng cho việc store giá trị input cũ
     */
    public function flash($key):string|array|null
    {
        self::start();
        $value = self::get($key);
        self::delete($key);
        return $value;
    }
}