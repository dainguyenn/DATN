<?php
require_once '../../autoload.php';

$veModel = new \Model\Ve();
$page = $_GET['page'] ?? 1;
$limit = $_GET['limit'] ?? 25;
$allVe = $veModel->getInfo(null,['*'],$limit,$page);
?>
<!--Luôn import-->
<?php ob_start(); ?>
<!---->
<div>
    <h1>Quản lý thẻ</h1>
    <a href="createMonthCard.php">Tạo thẻ tháng mới</a>
    <a href="createDayCard.php">Tạo thẻ ngày mới</a>
    <a href="listCardDay.php">Danh sách vé ngày</a>
    <table>
        <thead>
        <tr>
            <th>Mã vé</th>
            <th>Mã căn hộ</th>
            <th>Tên chủ hộ</th>
            <th>Biển số xe</th>
            <th>Loại thẻ</th>
            <th>Loại xe</th>
        </tr>
        </thead>
        <?php
        foreach ($allVe['data'] as $item) {

            ?>
            <tr>
                <td><?php echo $item['ma_ve']?></td>
                <td><?php echo $item['ma_can_ho']?></td>
                <td><?php echo $item['ten_chu_ho']?></td>
                <td><?php echo $item['bien_so_xe']?></td>
                <td><?php echo $item['loai_ve']?></td>
                <td><?php echo $item['loai_xe']?></td>
            </tr>
        <?php } ?>
    </table>
</div>
<!--Luôn import (coppy vào file của mình)-->
<?php $content = ob_get_clean(); ?>
<?= str_replace('{{content}}', $content, file_get_contents(\Helpers\PathHelper::app_path('view/sidebar-header.php'))) ?>
<!---->
