<h3>Lấy xe - xác nhận thanh toán</h3>

<div class="form-style-6">
    <form method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <input type="submit" name="sub" value="Xác nhận thanh toán">
    </form>
</div>  
<?php
require_once '../../../autoload.php';
session_start();
$veModel = new \Model\Ve();
$thongTinVeModel = new \Model\ThongTinVe();
$luotGuiModel = new \Model\LuotGui();
$ve = $_SESSION["ve_lay"];
$laDangGui = $_SESSION["la_dang_gui"];
$xacNhanBienSoLay = $_SESSION["xac_nhan_bien_so_lay"];
//print_r($_SESSION);
if ((!isset($ve) || !isset($xacNhanBienSoLay) || !$xacNhanBienSoLay) && $ve["loai_ve"] != "Ngày") {
    header("location:index.php");
}
$luotGui = $luotGuiModel->GetThongTinTheDangGui($ve["ma_ve"]);
if ($ve["loai_xe"] == "Ô tô") {
    echo "<h1>Thanh toán cho ô tô </h1>";

    $startTime = new DateTime($luotGui["gio_vao"]);
    $endTimeStr = date("Y-m-d H:i:s");
    $endTime = new DateTime($endTimeStr);

    $priceLevel = 20000;
    if (
        $startTime->format("d") != $endTime->format("d")
        || $endTime->format("H") >= 18
    ) {
        $priceLevel = 40000;
    }
    $timeSpan = $endTime->diff($startTime);
    $hoursNotRound = $timeSpan->h + ceil($timeSpan->i / 60) + $timeSpan->d * 24;
    $intoMoney = $hoursNotRound * 20000;

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

    //print_r($startTime->diff($endTime));
    //print_r($startTime->format("d"));
    //print_r($priceLevel);
} else {
    echo "<h1>Thanh toán cho xe máy </h1>";
    $startTime = new DateTime($luotGui["gio_vao"]);
    $endTimeStr = date("Y-m-d H:i:s");
    $endTime = new DateTime($endTimeStr);
    // Giá tiền ban ngày
    $dayPrice = 5000;

    // Giá tiền ban đêm
    $nightPrice = 10000;
    $timeSpan = $startTime->diff($endTime);
    $dayTotal = 0;
    $nightToTal = 0;
    print_r($timeSpan);
    // gửi trong nhiều ngày
    if ($startTime->format("d") != $endTime->format("d")) {
        //tiền ngày gửi đầu
        if ($startTime->format("H") < 6) {
            $dayTotal += 1; //1 ca ngày
            $nightToTal += 2; //2 ca đêm
            echo "<h1>A1</h1>";
        }
        if ($startTime->format("H") >= 6 && $startTime->format("H") < 18) {
            $dayTotal += 1; //1 ca ngày
            $nightToTal += 1; // 1 ca đêm
            echo "<h1>A2</h1>";
        }
        if ($startTime->format("H") >= 18) {
            $nightToTal = $nightToTal + 1; // 1 ca đêm
            echo "<h1>A3 ${nightToTal}</h1>";
        }

        //tiền gửi ngày giữa
        $totalDays = $endTime->format("d") - $startTime->format("d") - 1;
        echo ($totalDays);
        //$totalPrice += ($totalDays - 1) * ($dayPrice);
        if ($totalDays >= 2) {
            $dayTotal += $totalDays * 2;
            $nightToTal += $totalDays * 2 - 1;
            echo "<h1>B1 ${dayTotal} - ${nightToTal}</h1>";
        }
        //tiền gửi ngày cuối
        if ($endTime->format("H") < 6) { //
            $nightToTal = $nightToTal + 1; //1 ca đêm
            echo "<h1>C1</h1>";
        }
        if ($endTime->format("H") >= 6 && $startTime->format("H") < 18) {
            $dayTotal += 1; //1 ca ngày
            $nightToTal += 1; // 1 ca đêm
            echo "<h1>C2</h1>";
        }
        if ($endTime->format("H") >= 18) {
            $dayTotal += 1; //1 ca ngày
            $nightToTal = $nightToTal + 1; //2 ca đêm
            echo "<h1>C3 ${nightToTal}</h1>";
        }
    } else {
        if ($startTime->format("H") < 6) {
            if ($endTime->format("H") < 6) {
                $dayTotal += 0; //0 ca ngày
                $nightToTal += 1; //1 ca đêm
                echo "<h1>A1</h1>";
            }
            if ($endTime->format("H") >= 6 && $endTime->format("H") < 18) {
                $dayTotal += 1; //1 ca ngày
                $nightToTal += 1; // 1 ca đêm
                echo "<h1>A2</h1>";
            }
            if ($startTime->format("H") >= 18) {
                $nightToTal = $nightToTal + 2; // 1 ca đêm
                $dayTotal += 1; //1 ca ngày
                echo "<h1>A3 ${nightToTal}</h1>";
            }
        }
        if ($startTime->format("H") >= 6 && $startTime->format("H") < 18) {
            if ($endTime->format("H") >= 6 && $endTime->format("H") < 18) {
                $dayTotal += 1; //1 ca ngày
                echo "<h1>A2</h1>";
            }
            if ($startTime->format("H") >= 18) {
                $nightToTal = $nightToTal + 1; // 1 ca đêm
                $dayTotal += 1; //1 ca ngày
                echo "<h1>A3 ${nightToTal}</h1>";
            }
        }
        if ($startTime->format("H") >= 18) {
            $nightToTal = $nightToTal + 1; // 1 ca đêm
            echo "<h1>A3 ${nightToTal}</h1>";
        }

    }
    echo <<<LOG
            <table>
            <tr> 
                <td>Số mức tính ban ngày</td>
                <td>Số mức tính ban đêm</td>
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
    $_SESSION["da_thanh_toan"] = true;
    echo "<script>window.location.href = 'GhiNhanThongTin.php'</script>";
}
?>
<!--Luôn import (coppy vào file của mình)-->
<?php $content = ob_get_clean(); ?>
<?= str_replace('{{content}}', $content, file_get_contents(\Helpers\PathHelper::app_path('view/sidebar-header.php'))) ?>
<!---->