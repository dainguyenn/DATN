<?php ob_start(); ?>
<?php
require_once '../../autoload.php';

use Constant\CardConst;
use Helpers\WindowHelper;
use Model\ChuHo;
use Model\ThongTinVe;
use Model\Ve;


$ve = new Ve();
$thongTinVeModel = new ThongTinVe();
$chuHoModel = new ChuHo();
$coChuHo = false;

if(isset($_POST['check']))
{
    $coChuHo = $chuHoModel->exists($_POST['ma_can_ho']);
        $message = $coChuHo ? null : 'Không tồn tại căn hộ có mã là: '.$_POST['ma_can_ho'];
    if($coChuHo) {
        $_SESSION['ma_can_ho'] = $_POST['ma_can_ho'];
    }
}

if (isset($_POST['create'])) {
    $loaiXe = $_POST['loai_xe'];
    $soluong = $ve->check($_POST['ma_can_ho'],$_POST['loai_xe']);

    switch ($loaiXe){
        case 'Ô tô': {
            if($soluong >= 1 ) {
                $message = "Vượt quá số lượng ô tô cho phép đăng ký.";
            }
            break;
        }
        case 'Xe máy': {
            if($soluong >= 3 ) {
                $message = "Vượt quá số lượng xe máy cho phép đăng ký.";
            }
                break;
        }
    }
    $bienSo = $thongTinVeModel->findByCondition(
        ['bien_so_xe','=',$_POST['bien_so_xe']]
    );
    if($bienSo){
        $message = 'Đã tồn tại biển số xe này';
    }
    if(!isset($message)){

        $newVe = $ve->create([
            'loai_ve' => CardConst::TYPE_MONTH,
            'loai_xe' => $_POST['loai_xe'],
        ])[0];
        $thongTinVeModel->create([
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
    if(isset($message)) {
        echo "<p>$message</p>";
    }
?>
<div>
    <form method="POST">

        <div>
            <label>Mã căn hộ</label>
            <input  name="ma_can_ho" <?php echo $coChuHo ? 'readonly' : '' ?> value="<?php echo $_SESSION['ma_can_ho'] ?? '' ?>">
        </div>

        <?php
        if ($coChuHo) {
            ?>
            <div>

                <div>
                    <label>Biển số xe</label>
                    <input name="bien_so_xe">
                </div>

                <div>
                    <label>Loại xe</label>
                    <select name="loai_xe">
                        <option value="Xe máy">Xe máy</option>
                        <option value="Ô tô">Ô tô</option>
                    </select>
                </div>


            </div>
            <?php
        }
        ?>
        <?php
            if($coChuHo) {
              echo "<button name='create'>Tạo</button>";
            } else {
                echo "<button name='check'>Kiểm tra</button>";
            }
        ?>
    </form>
</div>
<!--Luôn import (coppy vào file của mình)-->
<?php $content = ob_get_clean(); ?>
<?= str_replace('{{content}}', $content, file_get_contents(\Helpers\PathHelper::app_path('view/sidebar-header.php'))) ?>
<!---->