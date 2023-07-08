<?php

require_once '../../autoload.php';

use Helpers\AuthHelper;
use Helpers\ViewHelper;
use Helpers\WindowHelper;

AuthHelper::isLogging();

$veModel = new \Model\Ve();
$page = $_GET['page'] ?? 1;
$limit = $_GET['limit'] ?? 25;
$allVe = $veModel->getCardDay(null, ['*'], $limit, $page);

if (isset($_GET['delete'])) {
    $veModel->deleteById($_GET['delete']);
    echo WindowHelper::location('listCardDay.php');
}
?>
<!--Luôn import-->
<?php
ob_start(); ?>
<!---->
<a class="btn btn-primary" href="createDayCard.php">Thêm vé ngày mới</a>
<div>
    <ul class="responsive-table">
        <li class="table-header">
            <div class="col col-1">Mã vé</div>
            <div class="col col-1">Loại thẻ</div>
            <div class="col col-1">Loại xe</div>
            <div class="col col-1">Trạng thái</div>
            <div class="col col-1"></div>
        </li>

        <?php
        foreach ($allVe['data'] as $item) {
            ?>
            <li class="table-row">
                <div class="col col-1">
                    <?php
                    echo $item['ma_ve'] ?>
                </div class="col col-1">
                <div class="col col-1">
                    <?php
                    echo $item['loai_ve'] ?>
                </div class="col col-1">
                <div class="col col-1">
                    <?php
                    echo $item['loai_xe'] ?>
                </div class="col col-1">
                <div class="col col-1">
                    <?php
                    echo $item['trang_thai'] ? 'Hoạt động' : 'Khóa' ?>
                </div class="col col-1">
                <div class="col col-1 flex items-center">
                    <a class="btn btn-danger" onclick="return window.confirm('Bạn chắc chắn muốn xóa?')" href="<?php
                    echo "?delete=" . $item['ma_ve'] ?>">Xóa</a>
                </div>
            </li>
            <?php
        } ?>
</div>
</ul>

<!--Luôn import (coppy vào file của mình)-->
<?php
$content = ob_get_clean(); ?>
<?= str_replace('{{content}}', $content, file_get_contents(\Helpers\PathHelper::app_path('view/sidebar-header.php'))) ?>
<?php
echo ViewHelper::title('Danh sách vé ngày'); ?>
<!---->