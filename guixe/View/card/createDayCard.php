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

use Constant\CardConst;
use Model\ChuHo;
use Model\ThongTinVe;
use Model\Ve;


$ve = new Ve();
$thongTinVeModel = new ThongTinVe();
$chuHoModel = new ChuHo();


if (isset($_POST['create'])) {

    $newVeId = $ve->create([
        'loai_ve' => CardConst::TYPE_DAY,
        'loai_xe' => $_POST['loai_xe'],
    ]);


    echo "<script>window.location.href = 'index.php'</script>";
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

            <div>
                <label>Loại xe</label>
                <select name="loai_xe">
                    <option value="Xe máy">Xe máy</option>
                    <option value="Ô tô">Ô tô</option>
                </select>
            </div>


        </div>

        <button name='create'>Tạo</button>

    </form>
</div>
</body>

</html>