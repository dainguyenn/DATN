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

$veModel = new ChuHo();
$page = $_GET['page'] ?? 1;
$limit = $_GET['limit'] ?? 25;
$allVe = $veModel->getAll(null, ['*'], $limit, $page);
if (SessionHelper::get('delete')) {
    $deleteObj = SessionHelper::flash('delete');
    echo ViewHelper::toast($deleteObj['title'], $deleteObj['message'], $deleteObj['type']);
}

if (isset($_GET['delete'])) {
    $veModel->deleteById($_GET['delete']);
    SessionHelper::store('delete', ['title' => 'Thành ông', 'message' => 'Xóa thành công', 'type' => 'success']);
    echo WindowHelper::location('index.php');
}
?>

<div>
    <ul class="responsive-table">
        <li class="table-header">
            <div class="col col-1">Mã số căn hộ</div>
            <div class="col col-2">Tên chủ hộ</div>
            <div class="col col-1">CCCD</div>
            <div class="col col-1"></div>
        </li>
        <?php
        foreach ($allVe as $item) {

            ?>
            <li class="table-row flex items-center">
                <div class="col col-1">
                    <?php echo $item['ma_can_ho'] ?>
                </div>
                <div class="col col-2">
                    <?php echo $item['ten_chu_ho'] ?>
                </div>
                <div class="col col-2">
                    <?php echo $item['cmnd'] ?>
                </div>
                <div class="col col-1 flex items-center">
                    <a class="btn btn-primary" href="<?php echo "index.php?id=" . $item['ma_can_ho'] ?>">Chi tiết</a>
                </div>
            </li>
        <?php } ?>
    </ul>
</div>
<!--Luôn import (coppy vào file của mình)-->
<?php $content = ob_get_clean(); ?>
<?= str_replace('{{content}}', $content, file_get_contents(PathHelper::app_path('View/sidebar-header.php'))) ?>
<?php echo ViewHelper::title('Danh sách chủ hộ');
echo ViewHelper::user($_SESSION["user"]); ?>
<!---->