<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<?php

use Helpers\AuthHelper;
use Helpers\WindowHelper;

require_once 'autoload.php';

if(!AuthHelper::user())
{
    echo WindowHelper::location('/View/auth/login.php');
}

?>
<body>
    <a href="/View/card/index.php">Quản lý thẻ</a> <br />
    <a href="/View/vehicle/parking/index.php">Gửi xe</a> <br />
    <a href="/View/vehicle/taking/index.php">Lấy xe</a>
</body>

</html>