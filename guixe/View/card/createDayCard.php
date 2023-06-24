
<?php
require_once '../../autoload.php';

use Constant\CardConst;
use Model\ChuHo;
use Model\ThongTinVe;
use Model\Ve;

use Helpers\AuthHelper;

AuthHelper::isLogging();
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
<?php ob_start(); ?>

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


<!--Luôn import (coppy vào file của mình)-->
<?php $content = ob_get_clean(); ?>
<?= str_replace('{{content}}', $content, file_get_contents(\Helpers\PathHelper::app_path('view/sidebar-header.php'))) ?>
<!---->
