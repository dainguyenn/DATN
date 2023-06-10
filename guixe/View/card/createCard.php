<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tạo vé tháng mới</title>
</head>
<body>
    <h1>Tạo thẻ mới</h1>
    <div>
        <form method="POST">
            <div>
                <label>Mã căn hộ</label>
                <input name="ma_can_ho">
            </div>
            <div>
                <label>Biển số xe</label>
                <input name="bien_so_xe">
            </div>
            <div>
                <label>Loại thẻ</label>
                <input name="loai_the">
            </div>
            <div>
                <label>Loại xe</label>
                <input name="loai_xe">
            </div>

            <button name="create">Tạo</button>
        </form>
    </div>
<?php
require_once '../../autoload.php';

use Model\ThongTinVe;
use Model\Ve;


$ve = new Ve();
$thongTinVeModel = new ThongTinVe();
    if(isset($_POST['create'])) {
        $newVe = $ve->create([
            'loai_the' => $_POST['loai_the'],
            'loai_xe' => $_POST['loai_xe'],
        ])[0];
        $thongTinVeModel->create([
            'ma_ve' => $newVe['ma_ve'],
            'ma_can_ho' => $_POST['ma_can_ho'],
            'bien_so_xe' => $_POST['bien_so_xe'],
        ]);
    }
?>
</body>

</html>