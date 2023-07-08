<?php
ob_start();
require_once '../../autoload.php';

use Helpers\AuthHelper;
use Helpers\PathHelper;
use Helpers\SessionHelper;
use Helpers\ViewHelper;
use Helpers\WindowHelper;
use Model\ChuHo;

AuthHelper::isLogging();

$veModel = new \Model\Ve();
$chuhoModel = new ChuHo();

$page = $_GET['page'] ?? 1;
$limit = $_GET['limit'] ?? 25;
$allVe = $veModel->getInfo($_GET['id'],['*'],$limit,$page);
$chuho = $chuhoModel->findById($_GET['id'])[0];

if(SessionHelper::get('delete'))
{
    $deleteObj = SessionHelper::flash('delete');
    echo ViewHelper::toast($deleteObj['title'],$deleteObj['message'],$deleteObj['type']);
}

if(isset($_GET['delete']))
{
    $veModel->deleteById($_GET['delete']);
    SessionHelper::store('delete',['title' => 'Thành ông','message' => 'Xóa thành công','type' => 'success']);
    echo WindowHelper::location('index.php?id='.$_GET['id']);
}
?>

<div>
    <h3>Chủ hộ: <?php echo $chuho['ten_chu_ho'] ?></h3>
    <a class="btn btn-primary" href="<?php echo 'createMonthCard.php?ma_can_ho='.$_GET['id']?>">Thêm thẻ tháng mới</a>
    <ul class="responsive-table">
        <li class="table-header">
            <div class="col col-1">Mã vé</div>
            <div class="col col-1">Mã căn hộ</div>
            <div class="col col-2">Tên chủ hộ</div>
            <div class="col col-1">Biển số xe</div>
            <div class="col col-1">Loại thẻ</div>
            <div class="col col-1">Loại xe</div>
            <div class="col col-1">Trạng thái</div>
            <div class="col col-1"></div>
        </li>
        <?php
        foreach ($allVe['data'] as $item) {

            ?>
            <li class="table-row flex items-center">
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
                <div class="col col-1">
                    <?php echo $item['trang_thai'] ? 'Hoạt động' : 'Khóa' ?>
                </div>
                <div class="col col-1 flex items-center">
                    <a class="btn btn-danger" onclick="return window.confirm('Bạn chắc chắn muốn xóa?')" href="<?php echo "index.php?delete=".$item['ma_ve']."&id=".$_GET['id']?>">Xóa</a>
                    <a class="btn btn-primary" href="<?php echo "updateMonthCard.php?update=".$item['ma_ve']?>">Sửa</a>
                </div>
            </li>
        <?php } ?>
    </ul>
</div>
<!--Luôn import (coppy vào file của mình)-->
<?php $content = ob_get_clean(); ?>
<?= str_replace('{{content}}', $content, file_get_contents(PathHelper::app_path('View/sidebar-header.php'))) ?>
<?php echo ViewHelper::title('Danh sách vé tháng');?>
<!---->