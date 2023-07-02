<h3>Lấy xe - xác nhận thanh toán</h3>

<div class="form-style-6">
    <form method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <input type="submit" name="sub" value="Xác nhận thanh toán">
    </form>
</div>
<?php
require_once '../../../autoload.php';
use Helpers\ViewHelper;
use Helpers\SessionHelper;
use Helpers\WindowHelper;

session_start();
$veModel = new \Model\Ve();
$thongTinVeModel = new \Model\ThongTinVe();
$luotGuiModel = new \Model\LuotGui();
$bangGiaModel = new \Model\BangGia();

$ve = SessionHelper::get("ve_lay"); //$_SESSION["ve_lay"];
$laDangGui = SessionHelper::get("la_dang_gui"); //$_SESSION["la_dang_gui"];
$xacNhanBienSoLay = SessionHelper::get("xac_nhan_bien_so_lay"); //$_SESSION["xac_nhan_bien_so_lay"];
$thanhTien = 0;

//print_r($_SESSION);
if ((!isset($ve) || !isset($xacNhanBienSoLay) || !$xacNhanBienSoLay) && $ve["loai_ve"] != "Ngày") {
    echo WindowHelper::location("index.php");
    //header("location:index.php");
}
$luotGui = $luotGuiModel->GetThongTinTheDangGui($ve["ma_ve"]);
if ($ve["loai_xe"] == "Ô tô") {
    echo "<h1>Thanh toán cho ô tô </h1>";
    $startTime = new DateTime($luotGui["gio_vao"]);
    $endTimeStr = date("Y-m-d H:i:s");
    $endTime = new DateTime($endTimeStr);

    $priceLevel = $bangGiaModel->getGia("Ngày", "Ô tô", "Sáng");
    if (
        $startTime->format("d") != $endTime->format("d")
        || $endTime->format("H") >= 18
    ) {
        $priceLevel = $bangGiaModel->getGia("Ngày", "Ô tô", "Tối");
    }
    $timeSpan = $endTime->diff($startTime);
    $hoursNotRound = $timeSpan->h + ceil($timeSpan->i / 60) + $timeSpan->d * 24;
    $intoMoney = $hoursNotRound * $priceLevel;

    $result_str_show = <<<result
        <table border='1' cellpadding='5' cellspacing='0'>
        <tr>
            <td>Thời gian bắt đầu gửi</td>
            <td>${luotGui['gio_vao']}</td>
        </tr>
        <tr>
            <td>Thời gian kết thúc gửi</td>
            <td>${endTimeStr}</td>
        </tr>
        <tr>
            <td>Thời gian gửi xe( tiếng) </td>
            <td>${hoursNotRound}</td>
        </tr>
        <tr>
            <td>Đơn giá( tiếng) </td>
            <td>${priceLevel}</td>
        </tr>
        <tr>
            <td>Thành tiền </td>
            <td>${intoMoney}</td>
        </tr>
        </table>
        result;
    echo $result_str_show;

} else {
    echo "<h1>Thanh toán cho xe máy </h1>";
    $startTime = new DateTime($luotGui["gio_vao"]);
    $endTimeStr = date("Y-m-d H:i:s");
    $endTime = new DateTime($endTimeStr);
    // Giá tiền ban ngày
    $dayPrice = $bangGiaModel->getGia("Ngày", "Xe máy", "Sáng");

    // Giá tiền ban đêm
    $nightPrice = $bangGiaModel->getGia("Ngày", "Xe máy", "Tối");
    $timeSpan = $startTime->diff($endTime);
    $dayTotal = 0;
    $nightToTal = 0;
    //gửi trong nhiều ngày
    if ($startTime->format("d") != $endTime->format("d")) {
        //tiền ngày gửi đầu
        if ($startTime->format("H") < 6) {
            $dayTotal += 1; //1 ca ngày
            $nightToTal += 2; //2 ca đêm
        }
        if ($startTime->format("H") >= 6 && $startTime->format("H") < 18) {
            $dayTotal += 1; //1 ca ngày
            $nightToTal += 1; // 1 ca đêm
        }
        if ($startTime->format("H") >= 18) {
            $nightToTal = $nightToTal + 1; // 1 ca đêm
        }

        //tiền gửi ngày giữa
        $totalDays = $endTime->format("d") - $startTime->format("d") - 1;
        if ($totalDays >= 2) {
            $dayTotal += $totalDays * 2;
            $nightToTal += $totalDays * 2 - 1;
        }
        //tiền gửi ngày cuối
        if ($endTime->format("H") < 6) { //
            $nightToTal = $nightToTal + 1; //1 ca đêm
        }
        if ($endTime->format("H") >= 6 && $startTime->format("H") < 18) {
            $dayTotal += 1; //1 ca ngày
            $nightToTal += 1; // 1 ca đêm
        }
        if ($endTime->format("H") >= 18) {
            $dayTotal += 1; //1 ca ngày
            $nightToTal = $nightToTal + 1; //2 ca đêm
        }
    } else { // gửi trong ngày
        // lúc bắt đầu gửi là ca sáng
        if ($startTime->format("H") < 6) {
            if ($endTime->format("H") < 6) {
                $dayTotal += 0; //0 ca ngày
                $nightToTal += 1; //1 ca đêm
            }
            if ($endTime->format("H") >= 6 && $endTime->format("H") < 18) {
                $dayTotal += 1; //1 ca ngày
                $nightToTal += 1; // 1 ca đêm
            }
            if ($startTime->format("H") >= 18) {
                $nightToTal = $nightToTal + 2; // 1 ca đêm
                $dayTotal += 1; //1 ca ngày
            }
        }
        if ($startTime->format("H") >= 6 && $startTime->format("H") < 18) {
            if ($endTime->format("H") >= 6 && $endTime->format("H") < 18) {
                $dayTotal += 1; //1 ca ngày
            }
            if ($startTime->format("H") >= 18) {
                $nightToTal = $nightToTal + 1; // 1 ca đêm
                $dayTotal += 1; //1 ca ngày
            }
        }
        if ($startTime->format("H") >= 18) {
            $nightToTal = $nightToTal + 1;
        }

    }
    echo <<<LOG
            <table border ='1' cellpadding='3' cellspacing='0'>
            <tr> 
                <td>Số lượt gửi ban ngày</td>
                <td>Số lượt gửi ban đêm</td>
            </tr>
            <tr> 
                <td>${dayTotal}</td>
                <td>${nightToTal}</td>
            </tr>
            </table>
        LOG;
    $thanhTien = $dayTotal * $dayPrice + $nightToTal * $nightPrice;
    $result_str_show = <<<result
        <table border='1' cellpadding='5' cellspacing='0'>
        <tr>
            <td>Thời gian bắt đầu gửi</td>
            <td>${luotGui['gio_vao']}</td>
        </tr>
        <tr>
            <td>Thời gian kết thúc gửi</td>
            <td>${endTimeStr}</td>
        </tr>
        <tr>
            <td>Số lần gửi xe ban ngày </td>
            <td>${dayTotal}</td>
        </tr>
        <tr>
            <td>Số lần gửi xe ban đêm </td>
            <td>${nightToTal}</td>
        </tr>
        <tr>
            <td>Thành tiền </td>
            <td>${thanhTien}</td>
        </tr>
        </table>
        result;
    echo $result_str_show;
}

if (isset($_POST["sub"])) {
    SessionHelper::store("da_thanh_toan", true);
    SessionHelper::store("so_tien_thanh_toan", $thanhTien);
    echo WindowHelper::location('GhiNhanThongTin.php');
}
?>
<!--Luôn import (coppy vào file của mình)-->
<?php $content = ob_get_clean(); ?>
<?= str_replace('{{content}}', $content, file_get_contents(\Helpers\PathHelper::app_path('view/sidebar-header.php'))) ?>
<?php echo ViewHelper::title('Quản lí gửi lấy xe'); ?>
<!---->