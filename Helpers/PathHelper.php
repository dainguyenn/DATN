<?php

namespace Helpers;

class PathHelper
{
    public static function storage_path($path): string
    {
        return 'http://' . $_SERVER['SERVER_NAME'] . ':8000/' . $path;
    }

    public static function app_path($path)
    {
        return dirname(__DIR__).'/'.$path;
    }
}