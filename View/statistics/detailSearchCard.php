<?php
require_once '../../autoload.php';
session_start();

use Helpers\AuthHelper;
use Helpers\PathHelper;
use Model\LuotGui;
use Model\ThongTinVe;
use Model\Ve;

AuthHelper::isLogging();

if (!isset($_GET["id"])) {
    echo Helpers\WindowHelper::location("searchCard.php");
}

$luotGuiModel = new LuotGui();
$luotGui = $luotGuiModel->findById($_GET["id"])[0];
if (!isset($luotGui) || empty($luotGui)) {
    echo Helpers\WindowHelper::location("searchCard.php");
}
?>

<?php ob_start(); ?>
<!---->

<div>
    <ul class="responsive-table">
        <li class="table-row">
            <div class="col col-1">
                Mã vé
            </div>
            <div class="col col-4">
                <?php
                echo $luotGui['ma_ve'] ?>
            </div>
        </li>
        <li class="table-row">
            <div class="col col-1">
                Mã lượt gửi
            </div>
            <div class="col col-4">
                <?php
                echo $luotGui['ma_luot_gui'] ?>
            </div>
        </li>
        <li class="table-row">
            <div class="col col-1">
                Biển số xe
            </div>
            <div class="col col-4">
                <?php
                echo $luotGui['bien_so_xe'] ?>
            </div>
        </li>
        <li class="table-row">
            <div class="col col-1">
                Giờ vào
            </div>
            <div class="col col-4">
                <?php
                echo $luotGui['gio_vao'] ?>
            </div>
        </li>
        <li class="table-row">
            <div class="col col-1">
                Giờ ra
            </div>
            <div class="col col-4">
                <?php
                echo $luotGui['gio_ra'] ?>
            </div>
        </li>
        <li class="table-row">
            <div class="col col-2">
                Hình ảnh vào
            </div>
            <div class="col col-3">
                Hình ảnh ra
            </div>
        </li>
        <li class="table-row">
            <div class="col col-1">
                <?php
                echo "<img width='550px' src='" . Helpers\PathHelper::storage_path($luotGui['hinh_anh_vao']) . "' /> " ?>
            </div>
            <div class="col col-4">
                <?php
                echo isset($luotGui["hinh_anh_ra"]) ? "<img width='550px' src='" . Helpers\PathHelper::storage_path($luotGui['hinh_anh_ra']) . "' /> " : "" ?>
            </div>
        </li>
    </ul>
</div>

<?php $content = ob_get_clean(); ?>
<?= str_replace('{{content}}', $content, file_get_contents(PathHelper::app_path('view/sidebar-header.php'))) ?>
<!--Đây là title-->
<?php echo \Helpers\ViewHelper::title('Tìm kiếm');
echo \Helpers\ViewHelper::user($_SESSION["user"]); ?><!---->