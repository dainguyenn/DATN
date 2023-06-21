<?php
require_once '../../autoload.php';

$veModel = new \Model\Ve();
$page = $_GET['page'] ?? 1;
$limit = $_GET['limit'] ?? 25;
$allVe = $veModel->getInfo(null, ['*'], $limit, $page);
?>
<!--Luôn import-->
<?php ob_start(); ?>
<!---->
<div>
    <a href="createMonthCard.php">Thêm</a>
<<<<<<< HEAD
    <ul class="responsive-table">
        <li class="table-header">
            <div class="col col-1">Mã vé</div>
            <div class="col col-1">Mã căn hộ</div>
            <div class="col col-2">Tên chủ hộ</div>
            <div class="col col-1">Biển số xe</div>
            <div class="col col-1">Loại thẻ</div>
            <div class="col col-1">Loại xe</div>
        </li>
=======
    <table>
        <thead>
        <tr>
            <th>Mã vé</th>
            <th>Mã căn hộ</th>
            <th>Tên chủ hộ</th>
            <th>Biển số xe</th>
            <th>Loại thẻ</th>
            <th>Loại xe</th>
            <th></th>
        </tr>
        </thead>
>>>>>>> 523e58589a6a9f192dc2be2b8ece0bfc71611e6d
        <?php
        foreach ($allVe['data'] as $item) {

            ?>
<<<<<<< HEAD
            <li class="table-row">
                <div class="col col-1">
                    <?php echo $item['ma_ve'] ?>
                </div>
                <div class="col col-1">
                    <?php echo $item['ma_can_ho'] ?>
                </div>
                <div class="col col-2">
                    <?php echo $item['ten_chu_ho'] ?>
                </div>
                <div class="col col-1">
                    <?php echo $item['bien_so_xe'] ?>
                </div>
                <div class="col col-1">
                    <?php echo $item['loai_ve'] ?>
                </div>
                <div class="col col-1">
                    <?php echo $item['loai_xe'] ?>
                </div>
            </li>
=======
            <tr>
                <td><?php echo $item['ma_ve']?></td>
                <td><?php echo $item['ma_can_ho']?></td>
                <td><?php echo $item['ten_chu_ho']?></td>
                <td><?php echo $item['bien_so_xe']?></td>
                <td><?php echo $item['loai_ve']?></td>
                <td><?php echo $item['loai_xe']?></td>
                <td>
                    <button>Xóa</button>
                    <button>Sửa</button>
                </td>
            </tr>
>>>>>>> 523e58589a6a9f192dc2be2b8ece0bfc71611e6d
        <?php } ?>
    </ul>
</div>
<!--Luôn import (coppy vào file của mình)-->
<?php $content = ob_get_clean(); ?>
<?= str_replace('{{content}}', $content, file_get_contents(\Helpers\PathHelper::app_path('view/sidebar-header.php'))) ?>
<!---->