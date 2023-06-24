<?php

require_once '../../autoload.php';

use Helpers\AuthHelper;

AuthHelper::isLogging();

$veModel = new \Model\Ve();
$page = $_GET['page'] ?? 1;
$limit = $_GET['limit'] ?? 25;
$allVe = $veModel->getInfo(null,['*'],$limit,$page);

if(isset($_GET['delete']))
{
    $veModel->deleteById($_GET['delete']);
}
?>
<!--Luôn import-->
<?php ob_start(); ?>
<!---->
<div>
    <a href="createMonthCard.php">Thêm</a>
    <table>
        <thead>
        <tr>
            <th>Mã vé</th>
            <th>Mã căn hộ</th>
            <th>Tên chủ hộ</th>
            <th>Biển số xe</th>
            <th>Loại thẻ</th>
            <th>Loại xe</th>
            <th>Trạng thái</th>
            <th></th>
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
                <td><?php echo $item['trang_thai'] ? 'Hoạt động' : 'Khóa' ?></td>
                <td>
                    <a onclick="return window.confirm('Bạn chắc chắn muốn xóa?')" href="<?php echo "index.php?delete=".$item['ma_ve']?>">Xóa</a>
                    <a href="<?php echo "updateMonthCard.php?update=".$item['ma_ve']?>">Sửa</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

<!--Luôn import (coppy vào file của mình)-->
<?php $content = ob_get_clean(); ?>
<?= str_replace('{{content}}', $content, file_get_contents(\Helpers\PathHelper::app_path('view/sidebar-header.php'))) ?>
<!---->
