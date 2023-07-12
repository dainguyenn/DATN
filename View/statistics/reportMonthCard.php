<?php
require_once '../../autoload.php';

use Helpers\AuthHelper;
use Helpers\PathHelper;
use Model\Ve;

// AuthHelper::isLogging();

$veModel = new Ve();
$page = $_GET['page'] ?? 1;
$limit = $_GET['limit'] ?? 25;
$allVe = $veModel->ChuaDongTien(null, $limit, $page);

if (isset($_GET['delete'])) {
    $veModel->deleteById($_GET['delete']);
    echo WindowHelper::location('reportMonthCard');
}
?>

<?php ob_start(); ?>
<!---->

<div>
    <ul class="responsive-table">
        <li class="table-header">
            <div class="col col-1">Mã vé</div>
            <div class="col col-1">Loại vé</div>
            <div class="col col-1">Mã căn hộ</div>
            <div class="col col-1">Tên chủ hộ</div>
            <div class="col col-1">Loại xe</div>
            <div class="col col-1">Biển số xe</div>
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
                        echo $item['ma_can_ho'] ?>
                    </div class="col col-1">
                    <div class="col col-1">
                        <?php
                        echo $item['ten_chu_ho'] ?>
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
                        echo $item['trang_thai'] ? 'Hoạt động' : 'Khóa'?>
                    </div class="col col-1">
                    <div class="col col-1 flex items-center">
                        <a class="btn btn-danger" onclick="return window.confirm('Bạn chắc chắn muốn xóa?')" href="<?php echo "index.php?delete=".$item['ma_ve']?>">Xóa</a>
                        <a class="btn btn-primary" href="<?php echo "../card/updateMonthCard.php?update=".$item['ma_ve']?>">Sửa</a>
                    </div>
                </li>
            <?php
        } ?>
    </ul>
</div>


<?php $content = ob_get_clean(); ?>
<?= str_replace('{{content}}', $content, file_get_contents(\Helpers\PathHelper::app_path('view/sidebar-header.php'))) ?>
<!--Đây là title-->
<?php echo \Helpers\ViewHelper::title('Danh sách vé tháng chưa đóng');?><!---->

