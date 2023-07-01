<?php
require_once '../../autoload.php';

use Helpers\AuthHelper;
use Helpers\PathHelper;
use Model\LuotGui;
use Model\ThongTinVe;
use Model\Ve;

// AuthHelper::isLogging();

$veModel = new Ve();
$page = $_GET['page'] ?? 1;
$limit = $_GET['limit'] ?? 25;
$allVe = $veModel->DangGui(null, $limit, $page);

?>

<?php ob_start(); ?>
<!---->

<div>
    <ul class="responsive-table">
        <li class="table-header">
            <div class="col col-1">Mã lượt gửi</div>
            <div class="col col-1">Mã vé</div>
            <div class="col col-1">Loại vé</div>
            <div class="col col-1">Loại xe</div>
            <div class="col col-1">Biển số xe</div>
            <div class="col col-1">Giờ vào</div>
        </li>
        <?php
            foreach ($allVe['data'] as $item) {
                ?>
                <li class="table-row">
                <div class="col col-1">
                        <?php
                        echo $item['ma_luot_gui'] ?>
                    </div class="col col-1">
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
                        echo $item['bien_so_xe'] ?>
                    </div class="col col-1">
                    <div class="col col-1">
                        <?php
                        echo $item['gio_vao'] ?>
                    </div class="col col-1">
                </li>
            <?php
        } ?>
    </ul>
</div>

<?php $content = ob_get_clean(); ?>
<?= str_replace('{{content}}', $content, file_get_contents(\Helpers\PathHelper::app_path('view/sidebar-header.php'))) ?>
<!--Đây là title-->
<?php echo \Helpers\ViewHelper::title('Danh sách xe đang gửi');?><!---->

