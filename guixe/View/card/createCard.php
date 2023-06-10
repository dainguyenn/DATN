<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tạo vé tháng mới</title>
</head>
<?php
require_once '../../autoload.php';

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
            if($soluong >= 2 ) {
                $message = "Vượt quá số lượng xe máy cho phép đăng ký.";
            }
                break;
        }
    }
    if(!isset($message)){
        $newVeId = $ve->create([
            'loai_the' => $_POST['loai_the'],
            'loai_xe' => $_POST['loai_xe'],
        ]);
        $thongTinVeModel->create([
            'ma_ve' => $newVeId,
            'ma_can_ho' => $_POST['ma_can_ho'],
            'bien_so_xe' => $_POST['bien_so_xe'],
        ]);

        echo "<script>window.location.href = 'index.php'</script>";
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
            <input name="ma_can_ho" value="<?php echo $_SESSION['ma_can_ho'] ?? '' ?>">
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
                    <label>Loại thẻ</label>
                    <input name="loai_the">
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
</body>

</html>
