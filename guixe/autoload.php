<?php


function myAutoloader($className)
{
    $file = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
}

spl_autoload_register('myAutoloader');

// Bắt đầu ứng dụng của bạn
// ...
