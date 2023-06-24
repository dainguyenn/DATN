<?php

require_once '../../autoload.php';

use Helpers\AuthHelper;

AuthHelper::isLogging();

$veModel = new \Model\Ve();
$page = $_GET['page'] ?? 1;
$limit = $_GET['limit'] ?? 25;
$allVe = $veModel->getCardDay(null, ['*'], $limit, $page);
?>
<!--Luôn import-->
<?php ob_start(); ?>
<!---->
<a href="createDayCard.php">Thêm</a>
<div>
    <ul class="responsive-table">
        <li class="table-header">
            <div class="col col-1">Mã vé</div>
            <div class="col col-1">Loại thẻ</div>
            <div class="col col-1">Loại xe</div>
        </li>

        <?php
        foreach ($allVe['data'] as $item) {

            ?>
            <li class="table-row">
                <div class="col col-1">
                    <?php echo $item['ma_ve'] ?>
                </div class="col col-1">
                <div class="col col-1">
                    <?php echo $item['loai_ve'] ?>
                </div class="col col-1">
                <div class="col col-1">
                    <?php echo $item['loai_xe'] ?>
                </div class="col col-1">
            </li>
        <?php } ?>
</div>
</ul>

<!--Luôn import (coppy vào file của mình)-->
<?php $content = ob_get_clean(); ?>
<?= str_replace('{{content}}', $content, file_get_contents(\Helpers\PathHelper::app_path('view/sidebar-header.php'))) ?>
<?= str_replace('{{title}}', 'Danh sách vé ngày', file_get_contents(\Helpers\PathHelper::app_path('view/sidebar-header.php'))) ?>
<!---->