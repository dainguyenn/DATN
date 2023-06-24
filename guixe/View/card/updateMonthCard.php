<?php
ob_start(); ?>
<?php

require_once '../../autoload.php';

use Constant\CardConst;
use Helpers\WindowHelper;
use Model\ChuHo;
use Model\ThongTinVe;
use Model\Ve;
use Helpers\AuthHelper;


AuthHelper::isLogging();

$veModel = new Ve();
$thongTinVeModel = new ThongTinVe();
$chuHoModel = new ChuHo();
$id = $_GET['update'];

$veUpdate = $veModel->findById($id)[0];
$thongTinVe = $thongTinVeModel->findById($id)[0];

if (isset($_POST['check'])) {
    $coChuHo = $chuHoModel->exists($_POST['ma_can_ho']);
    $message = $coChuHo ? null : 'Không tồn tại căn hộ có mã là: ' . $_POST['ma_can_ho'];
    if ($coChuHo) {
        $_SESSION['ma_can_ho'] = $_POST['ma_can_ho'];
    }
}
function checkValue($origin, $value)
{
    if ($value == $origin) {
        return true;
    }
    return false;
}

if (isset($_POST['update'])) {
    $loaiXe = $_POST['loai_xe'];
    $soluong = $veModel->check($_POST['ma_can_ho'], $_POST['loai_xe']);

    switch ($loaiXe) {
        case 'Ô tô':
        {
            if ($soluong - 1 >= 1) {
                $message = "Vượt quá số lượng ô tô cho phép đăng ký.";
            }
            break;
        }
        case 'Xe máy':
        {
            if ($soluong - 1 >= 3) {
                $message = "Vượt quá số lượng xe máy cho phép đăng ký.";
            }
            break;
        }
    }
    $bienSo = $thongTinVeModel->findByCondition(
        ['bien_so_xe', '=', $_POST['bien_so_xe']]
    );
    if ($bienSo && $_POST['bien_so_xe'] != $thongTinVe['bien_so_xe']) {
        $message = 'Đã tồn tại biển số xe này';
    }
    if (!isset($message)) {
        $newVe = $veModel->update($id, [
            'loai_ve' => CardConst::TYPE_MONTH,
            'loai_xe' => $_POST['loai_xe'],
            'trang_thai' => $_POST['trang_thai'] == 'true' ? true : false
        ])[0];
        $thongTinVeModel->update($id, [
            'ma_ve' => $newVe['ma_ve'],
            'ma_can_ho' => $_POST['ma_can_ho'],
            'bien_so_xe' => $_POST['bien_so_xe'],
        ]);

        echo WindowHelper::location('index.php');
    }
}
?>


<body>
<h1>Tạo thẻ mới</h1>
<?php
if (isset($message)) {
    echo "<p>$message</p>";
}
?>
<div>
    <form method="POST">

        <div>
            <label>Mã căn hộ</label>
            <input name="ma_can_ho" readonly value="<?php
            echo $thongTinVe['ma_can_ho'] ?? '' ?>">
        </div>
        <div>
            <div>
                <label>Biển số xe</label>
                <input name="bien_so_xe" value="<?php
                echo $thongTinVe['bien_so_xe'] ?>">
            </div>
            <div>
                <label>Loại xe</label>
                <select name="loai_xe">
                    <option <?php
                    echo checkValue($veUpdate['loai_xe'], 'Xe máy') ? 'selected' : '' ?> value="Xe máy">Xe máy
                    </option>
                    <option <?php
                    echo checkValue($veUpdate['loai_xe'], 'Ô tô') ? 'selected' : '' ?> value="Ô tô">Ô tô
                    </option>
                </select>
            </div>
            <div>
                <label>Trạng thái</label>
                <select name="trang_thai">
                    <option <?php
                    echo checkValue($veUpdate['trang_thai'], 1) ? 'selected' : '' ?> value="true">Hoạt động
                    </option>
                    <option <?php
                    echo checkValue($veUpdate['trang_thai'], 0) ? 'selected' : '' ?> value="false">Khóa
                    </option>
                </select>
            </div>

        </div>

        <button name='update'>Sửa</button>

    </form>
</div>
<!--Luôn import (coppy vào file của mình)-->
<?php
$content = ob_get_clean(); ?>
<?= str_replace('{{content}}', $content, file_get_contents(\Helpers\PathHelper::app_path('view/sidebar-header.php'))) ?>
<!---->