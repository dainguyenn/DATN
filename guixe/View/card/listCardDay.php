
<?php
require_once '../../autoload.php';

$veModel = new \Model\Ve();
$page = $_GET['page'] ?? 1;
$limit = $_GET['limit'] ?? 25;
$allVe = $veModel->getCardDay(null,['*'],$limit,$page);
?>
<!--Luôn import-->
<?php ob_start(); ?>
<!---->
<a href="createDayCard.php">Thêm</a>
<table>
    <thead>
    <tr>
        <th>Mã vé</th>
        <th>Loại thẻ</th>
        <th>Loại xe</th>
    </tr>
    </thead>
    <?php
    foreach ($allVe['data'] as $item) {

        ?>
        <tr>
            <td><?php echo $item['ma_ve']?></td>
            <td><?php echo $item['loai_ve']?></td>
            <td><?php echo $item['loai_xe']?></td>
        </tr>
    <?php } ?>
</table>

<!--Luôn import (coppy vào file của mình)-->
<?php $content = ob_get_clean(); ?>
<?= str_replace('{{content}}', $content, file_get_contents(\Helpers\PathHelper::app_path('view/sidebar-header.php'))) ?>
<!---->
