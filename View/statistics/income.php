<?php
require_once '../../autoload.php';

use Helpers\AuthHelper;
use Helpers\PathHelper;
use Model\LuotGui;
use Model\ThongTinVe;
use Model\Ve;

$veModel = new Ve();
$luotGuiModel = new LuotGui();
$page = $_GET['page'] ?? 1;
$limit = $_GET['limit'] ?? 25;
$allVe = $veModel->DaThanhToan(null, $limit, $page);
$tong = null;
$danhSachNgay = null;
if ($_GET["sub"]) {
    $danhSachNgay = $luotGuiModel->ChiTietDoanhThuCacNgay($_GET["thang"], $_GET["nam"]);
    $tong = 0;
    foreach ($danhSachNgay as $item) {
        $tong += $item['tong_doanh_thu'];
    }
} else {
    $danhSachNgay = $luotGuiModel->ChiTietDoanhThuCacNgay();
    $tong = 0;
    foreach ($danhSachNgay as $item) {
        $tong += $item['tong_doanh_thu'];

    }
}
?>

<?php ob_start(); ?>
<!---->

<form action="" method="GET">
    <table class="table" border="0" cellspacing="10px">
        <tr>
            <td>Tháng</td>
            <td>Năm</td>
        </tr>
        <tr>
            <td scope="row">
                <input type="number" class="form-control" type="text" name="thang" placeholder="Nhập tháng"
                    value="<?php echo date("m"); ?>">
            </td>
            <td>
                <input type="number" class="form-control" type="text" name="nam" placeholder="Nhập năm"
                    value="<?php echo date("Y"); ?>">
            </td>
        </tr>
    </table>
    <input type="submit" name="sub" value="Thống kê" class="btn btn-primary" />
</form>


<div>
    <h1> Tổng tiền:
        <?php echo number_format($tong, 0, ',', '.') ?? 0 ?>
        VND
    </h1>
</div>
<div>
    <ul class="responsive-table">
        <li class="table-header">
            <div class="col col-2">Ngày</div>
            <div class="col col-3">Doanh thu</div>
        </li>
        <?php
        foreach ($danhSachNgay as $item) {
            $format = number_format($item['tong_doanh_thu'], 0, ',', '.');
            echo <<<ROW
                        <li class="table-row">
                            <div class="col col-2">${item['ngay']}</div>
                            <div class="col col-3">$format</div>
                        </li>
                ROW;
        }
        ?>
    </ul>
</div>

<?php $content = ob_get_clean(); ?>
<?= str_replace('{{content}}', $content, file_get_contents(PathHelper::app_path('view/sidebar-header.php'))) ?>
<!--Đây là title-->
<?php echo \Helpers\ViewHelper::title('Thống kê doanh thu');
echo ViewHelper::user($_SESSION["user"]); ?><!---->