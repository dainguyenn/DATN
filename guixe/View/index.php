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
    <a href="/View/card/index.php">Quản lý thẻ</a>

    <h1>Seeder chủ hộ</h1>
    <form method="POST">
        <button name="seed">Seed</button>
    </form>

<?php
require_once 'autoload.php';

use core\CustomPDO;

if(isset($_POST['seed'])){
    $pdo = new CustomPDO();

        for ($i = 0; $i < 30; $i++) {
            $id = $i +1;
            $chuHo = "Chủ hộ $id";
            $cmnd = "234567891$id";
            $sql = "INSERT INTO chu_ho(ma_can_ho,ten_chu_ho,cmnd) VALUES($id,'$chuHo','$cmnd')";
            $pdo->query($sql);
        }
    }

?>
</body>
</html>

