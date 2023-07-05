<?php

namespace core;

require_once 'autoload.php';
use Helpers\SessionHelper;
require_once 'Model/Ve.php';
require_once 'core/CustomPDO.php';
class App
{
    protected $ve;
    public function __construct()
    {
        SessionHelper::start();
        require_once 'View/index.php';
    }


}

new App();
