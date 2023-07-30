<?php
require_once '../../autoload.php';
session_start();

use Helpers\AuthHelper;
use Helpers\PathHelper;
use Model\LuotGui;
use Model\ThongTinVe;
use Model\Ve;

 AuthHelper::isLogging();

$veModel = new Ve();
$page = $_GET['page'] ?? 1;
$limit = $_GET['limit'] ?? 25;
$allVe = null;
$fillter = [
    "bien_so_xe" => null,
    "ma_ve" => null,
    "loai_ve" => null,
    "ten_chu_ho" => null,
    "gio_vao" => null,
    "gio_ra" => null
];

if (isset($_GET["sub"])) {
    $fillter = [
        "bien_so_xe" => $_GET["bien_so_xe"],
        "ma_ve" => $_GET["ma_ve"],
        "loai_ve" => $_GET["loai_ve"],
        "ten_chu_ho" => $_GET["ten_chu_ho"],
        "gio_vao" => $_GET["gio_vao"],
        "gio_ra" => $_GET["gio_ra"]
    ];
    $allVe = $veModel->DanhSachVe(null, $limit, $page, $fillter);
} else {

    $allVe = $veModel->DanhSachVe(null, $limit, $page, $fillter);
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
                <td>Từ lúc</td>
                <td>Đến lúc</td>
            </tr>
            <tr>
                <td scope="row">
                    <input class="form-control" type="text" name="bien_so_xe"
                        value="<?php echo $fillter["bien_so_xe"] ?>" placeholder="Nhập biển số xe">
                </td>
                <td>
                    <input class="form-control" type="text" name="ma_ve" value="<?php echo $fillter["ma_ve"] ?>"
                        placeholder="Nhập mã vé">
                </td>
                <td>
                    <select class="form-control" name="loai_ve" id="">
                        <option></option>
                        <option <?php echo $fillter["loai_ve"] == "Ngày" ? "selected" : "" ?> value="Ngày">Vé ngày
                        </option>
                        <option <?php echo $fillter["loai_ve"] == "Tháng" ? "selected" : "" ?> value="Tháng">Vé tháng
                        </option>
                    </select>
                </td>
                <td>
                    <input class="form-control" type="text" name="ten_chu_ho"
                        value="<?php echo $fillter["ten_chu_ho"] ?>" placeholder="Nhập tên chủ hộ">
                </td>
                <td>
                    <input class="form-control" type="datetime-local" name="gio_vao"
                        value="<?php echo $fillter["gio_vao"] ?>" placeholder="Từ lúc">
                </td>
                <td>
                    <input class="form-control" type="datetime-local" name="gio_ra"
                        value="<?php echo $fillter["gio_ra"] ?>" placeholder="Đến lúc">
                </td>
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
            <div class="col col-1"></div>
        </li>
        <?php
        foreach ($allVe['data'] as $item) {
            ?>
            <li class="table-row">
                <div class="col col-1">
                    <?php
                    echo $item['ma_luot_gui'] ?>
                </div>
                <div class="col col-1">
                    <?php
                    echo $item['ma_ve'] ?>
                </div>
                <div class="col col-1">
                    <?php
                    echo $item['loai_ve'] ?>
                </div>
                <div class="col col-1">
                    <?php
                    echo $item['loai_xe'] ?>
                </div>
                <div class="col col-1">
                    <?php
                    echo $item['bien_so_xe'] ?>
                </div>
                <div class="col col-1">
                    <?php
                    echo $item['gio_vao'] ?>
                </div>
                <div class="col col-1">
                    <?php
                    echo $item['gio_ra'] ?>
                </div>
                <div class="col col-1">
                    <a class="btn btn-primary" href="detailSearchCard.php?id=<?php
                    echo $item['ma_luot_gui'];
                    ?>">Chi tiết</a>
                </div>
            </li>
            <?php
        } ?>
    </ul>
</div>


<?php $content = ob_get_clean(); ?>
<?= str_replace('{{content}}', $content, file_get_contents(PathHelper::app_path('view/sidebar-header.php'))) ?>
<!--Đây là title-->
<?php echo \Helpers\ViewHelper::title('Tìm kiếm');
echo \Helpers\ViewHelper::user($_SESSION["user"]); ?><!---->