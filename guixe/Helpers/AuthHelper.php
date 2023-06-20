<?php

namespace Helpers;

class AuthHelper
{
    public static function user()
    {
        return SessionHelper::get('user');
    }

    public static function login($user)
    {
        SessionHelper::store('user',$user);
        return true;
    }

    public static function logout()
    {
        SessionHelper::delete('user');
        return true;
    }
}