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
$allVe = null;
if (isset($_GET["sub"])) {
    $allVe = $veModel->DanhSachVe(null, $limit, $page, $_GET);
} else {

    $allVe = $veModel->DanhSachVe(null, $limit, $page, null);
}


?>

<?php ob_start(); ?>
<!---->

<div>
    <form action="" method="GET">
        <table class="table" border="0" cellspacing="10px">
            <tr>
                <td>Biển số xe</td>
                <td>Mã vé</td>
                <td>Loại vé</td>
                <td>Tên chủ hộ</td>
            </tr>
            <tr>
                <td scope="row"><input class="form-control" type="text" name="bien_so_xe" placeholder="Nhập biển số xe">
                </td>
                <td><input class="form-control" type="text" name="ma_ve" placeholder="Nhập mã vé"></td>
                <td>
                    <select class="form-control" name="loai_ve" id="">
                        <option></option>
                        <option value="Ngày">Vé ngày</option>
                        <option value="Tháng">Vé tháng</option>
                    </select>
                </td>
                <td><input class="form-control" type="text" name="ten_chu_ho" placeholder="Nhập tên chủ hộ"></td>
            </tr>
        </table>
        <input type="submit" name="sub" value="Tìm kiếm" class="btn btn-primary" />
    </form>
    <ul class="responsive-table">
        <li class="table-header">
            <div class="col col-1">Mã lượt gửi</div>
            <div class="col col-1">Mã vé</div>
            <div class="col col-1">Loại vé</div>
            <div class="col col-1">Loại xe</div>
            <div class="col col-1">Biển số xe</div>
            <div class="col col-1">Giờ vào</div>
            <div class="col col-1">Giờ ra</div>
            <div class="col col-1">Trạng thái </div>
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
                <div class="col col-1">
                    <?php
                    echo $item['gio_ra'] ?>
                </div class="col col-1">
                <div class="col col-1">
                    <?php
                    echo $item['trang_thai'] ? 'Hoạt động' : 'Khóa' ?>
                </div class="col col-1">
                <div class="col col-1">
                    <a class="btn btn-primary" href="detailSearchCard.php?id=<?php
                    echo $item['ma_luot_gui'];
                    ?>">Chi tiết</a>
                </div class="col col-1">
            </li>
            <?php
        } ?>
    </ul>
</div>


<?php $content = ob_get_clean(); ?>
<?= str_replace('{{content}}', $content, file_get_contents(PathHelper::app_path('view/sidebar-header.php'))) ?>
<!--Đây là title-->
<?php echo \Helpers\ViewHelper::title('Tìm kiếm');
echo ViewHelper::user($_SESSION["user"]); ?><!---->