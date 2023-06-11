<!DOCTYPE html>
<html>

<head>
    <title>Quản lý gửi và lấy xe</title>
</head>

<body>
    <h2>Quản lý gửi và lấy xe</h2>
    <h3>Gửi xe</h3>
    <form method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <input type="hidden" name="action" value="gui_xe">
        <label for="bien_so_xe">Biển số</label>
        <input type="text" name="bien_so_xe" id="ma_the">
        <br>
        <input type="submit" name="sub" value="gui">
    </form>
    <?php
    require_once '../../../autoload.php';
    session_start();
    $veModel = new \Model\Ve();
    $thongTinVeModel = new \Model\ThongTinVe();
    $ve = $_SESSION["ve"];
    $luotGui = $_SESSION["luot_gui"];
    if (!isset($ve) || !isset($luotGui))
        header("location:index.php");
    print_r($_SESSION);
    if (isset($_POST["sub"])) {
        if ($ve["loai_the"] == "Tháng") {
            $result = $thongTinVeModel->findById($ve["ma_ve"])[0];
            print_r($result);
            if (!$result) {
                echo "lỗi trong quá trình kiểm tra";
                exit;
            }
            if ($_POST["bien_so_xe"] == $result["bien_so_xe"]) {
                echo "xác nhận biển số thành công";
                $_SESSION["thong_tin_ve"] = $result;
                echo "<script>window.location.href = 'GhiNhanThongTin.php'</script>";
            } else {
                echo "xác nhận biến số không hợp lệ";
                echo "<br />" . $_POST["bien_so_xe"] . "---" . $result["bien_so_xe"];
            }
        } else {
            if ($luotGui["bien_so_xe"] == $_POST["bien_so_xe"]) {
                echo "<h1>Là thẻ ngày</h1> <h2>Đang ghi nhận thông tin lấy</h2>";
                echo "<script>window.location.href = 'GhiNhanThongTin.php'</script>";
            } else {
                echo "<h1>Biển số xe không trùng khớp</h1>";
            }
        }
    }
    ?>
</body>

</html>