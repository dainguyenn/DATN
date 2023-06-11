<?php

namespace Helpers;

class PathHelper
{
    public static function storage_path($path): string
    {
        return 'http://' . $_SERVER['SERVER_NAME'] . ':8000/' . $path;
    }
}