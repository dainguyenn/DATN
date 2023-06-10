<?php

namespace Controller;

class WelcomeController
{
    public function __construct()
    {
        require_once '../View/welcome.php';
    }

}

new WelcomeController();
