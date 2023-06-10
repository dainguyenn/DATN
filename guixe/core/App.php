<?php

namespace core;

use Model\Ve;
session_start();
require_once 'Model/Ve.php';
require_once 'core/CustomPDO.php';
class App
{
    protected $pdo;
    protected $ve;
    public function __construct()
    {
        require_once 'View/index.php';
    }


}

new App();
