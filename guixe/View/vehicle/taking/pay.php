<!DOCTYPE html>
<html>

<head>
    <title>Quản lý gửi và lấy xe</title>
</head>

<body>
    <h2>Quản lý gửi và lấy xe</h2>
    <h3>Lấy xe - xác nhận thanh toán</h3>
    <form method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <input type="submit" name="sub" value="Xác nhận thanh toán">
    </form>
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
    if ((!isset($ve) || !isset($xacNhanBienSoLay) || !$xacNhanBienSoLay) && $ve["loai_the"] != "Ngày") {
        header("location:index.php");
    }
    $luotGui = $luotGuiModel->GetThongTinTheDangGui($ve["ma_ve"]);
    if ($ve["loai_xe"] == "Ô tô") {
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
        $timeSpan = $startTime->diff($endTime);
        $hoursNotRound = $timeSpan->h + ceil($timeSpan->i / 60);
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
        //print_r($startTime->format("d"));
        //print_r($priceLevel);
    } else {
        echo "<h1>Loại xe là xe máy à </h1>";
        $startTime = new DateTime('2023-06-05 12:00:00');
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
        if($startTime->format("d") != $endTime->format("d")){
            //tiền ngày gửi đầu
            if($startTime->format("H"))
        }
    }


    ?>
</body>

</html>