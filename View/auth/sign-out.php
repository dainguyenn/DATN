<?php
require_once '../../autoload.php';

use \Helpers\SessionHelper;
use \Helpers\WindowHelper;

session_start();
session_destroy();
echo WindowHelper::location("/View/auth/sign-in.php");