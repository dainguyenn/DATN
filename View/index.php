<?php
require_once dirname(__DIR__).'/autoload.php';

use Helpers\AuthHelper;

AuthHelper::isLogging();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="/View/card/chuho.php">Quản lý chủ hộ</a> <br />
    <a href="/View/vehicle/parking/index.php">Gửi xe</a> <br />
    <a href="/View/vehicle/taking/index.php">Lấy xe</a>
</body>

</html>