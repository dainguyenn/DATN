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
        if (!SessionHelper::get('user')) {
            SessionHelper::store('user', $user);
            echo WindowHelper::location('/View');
        }
    }

    public static function logout()
    {
        SessionHelper::delete('user');
        return true;
    }

    public static function isLogging()
    {
        if (!SessionHelper::get('user')) {
            echo WindowHelper::location('/View/auth/sign-in.php');
        }
    }
}