<?php
require_once '../../autoload.php';

use Helpers\AuthHelper;
use Helpers\ViewHelper;
use Helpers\WindowHelper;
use Model\LuotGui;

// AuthHelper::isLogging();

$luotGuiModel = new \Model\LuotGui();
$page = $_GET['page'] ?? 1;
$limit = $_GET['limit'] ?? 25;
// $allVe = $luotGuiModel->getCardDay(null, ['*'], $limit, $page);

?>

<?php ob_start(); ?>
<!---->

<div>
    <ul class="responsive-table">
        <li class="table-header">
            <div class="col col-1">Mã vé</div>
            <div class="col col-1">Biển số xe</div>
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
                    echo $item['bien_so_xe'] ?>
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
    </ul>
</div>

<?php $content = ob_get_clean(); ?>
<?= str_replace('{{content}}', $content, file_get_contents(\Helpers\PathHelper::app_path('view/sidebar-header.php'))) ?>
<!--Đây là title-->
<?php echo \Helpers\ViewHelper::title('Danh sách xe đang gửi');?><!---->

