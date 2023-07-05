<?php
ob_start(); ?>
<?php
require_once '../../autoload.php';

use Helpers\AuthHelper;

AuthHelper::isLogging();

use Constant\CardConst;
use Helpers\SessionHelper;
use Helpers\ViewHelper;
use Helpers\WindowHelper;
use Model\ChuHo;
use Model\ThongTinVe;
use Model\Ve;


$ve = new Ve();
$thongTinVeModel = new ThongTinVe();
$chuHoModel = new ChuHo();
$coChuHo = false;

if (SessionHelper::get('error')) {
    $errObj = SessionHelper::flash('error');
    echo ViewHelper::toast($errObj['title'], $errObj['message'], $errObj['type']);
}

if (isset($_POST['check'])) {
    $coChuHo = $chuHoModel->exists($_POST['ma_can_ho']);
    $message = $coChuHo ? null : 'Không tồn tại căn hộ có mã là: ' . $_POST['ma_can_ho'];
    if ($message) {
        SessionHelper::store('error', ['title' => 'Lỗi', 'message' => $message, 'type' => 'error']);
        echo WindowHelper::location('createMonthCard.php');
    }
    if ($coChuHo) {
        $_SESSION['ma_can_ho'] = $_POST['ma_can_ho'];
    }
}

if (isset($_POST['create'])) {
    $loaiXe = $_POST['loai_xe'];
    $soluong = $ve->check($_POST['ma_can_ho'], $_POST['loai_xe']);

    switch ($loaiXe) {
        case 'Ô tô':
        {
            if ($soluong >= 1) {
                $message = "Vượt quá số lượng ô tô cho phép đăng ký.";
                SessionHelper::store('error', ['title' => 'Lỗi', 'message' => $message, 'type' => 'warning']);
                echo WindowHelper::location('createMonthCard.php');
            }
            break;
        }
        case 'Xe máy':
        {
            if ($soluong >= 3) {
                $message = "Vượt quá số lượng xe máy cho phép đăng ký.";
                SessionHelper::store('error', ['title' => 'Lỗi', 'message' => $message, 'type' => 'warning']);
                echo WindowHelper::location('createMonthCard.php');
            }
            break;
        }
    }
    $bienSo = $thongTinVeModel->kiemTraBienSo($_POST['bien_so_xe']);
    if ($bienSo) {
        $message = 'Đã tồn tại biển số xe này';
        SessionHelper::store('error', ['title' => 'Lỗi', 'message' => $message, 'type' => 'warning']);
        echo WindowHelper::location('createMonthCard.php');
    }
    $newVe = $ve->create([
        'loai_ve' => CardConst::TYPE_MONTH,
        'loai_xe' => $_POST['loai_xe'],
    ])[0];
    $thongTinVeModel->create([
        'ma_ve' => $newVe['ma_ve'],
        'ma_can_ho' => $_POST['ma_can_ho'],
        'bien_so_xe' => $_POST['bien_so_xe'],
    ]);

    echo WindowHelper::location('index.php?id='. SessionHelper::get('ma'));
}
if (isset($_GET['ma_can_ho']))
{
    SessionHelper::store('ma',$_GET['ma_can_ho']);
}
?>

<body>
<h1>Tạo thẻ mới</h1>

<div>
    <form method="POST" class="form-style-6">

        <div>
            <label>Mã căn hộ</label>
            <input name="ma_can_ho" type="number"
            readonly value="<?php echo SessionHelper::get('ma') ?>">
        </div>

            <div>

                <div>
                    <label>Biển số xe</label>
                    <input required type="text" name="bien_so_xe">
                </div>

                <div>
                    <label>Loại xe</label>
                    <select name="loai_xe">
                        <option value="Xe máy">Xe máy</option>
                        <option value="Ô tô">Ô tô</option>
                    </select>
                </div>


            </div>
        <input type='submit' name='create' value='Tạo'>

    </form>
</div>
<!--Luôn import (coppy vào file của mình)-->
<?php
$content = ob_get_clean(); ?>
<?= str_replace('{{content}}', $content, file_get_contents(\Helpers\PathHelper::app_path('view/sidebar-header.php'))) ?>
<?php
echo ViewHelper::title('Tạo vé tháng mới'); ?>
<!---->