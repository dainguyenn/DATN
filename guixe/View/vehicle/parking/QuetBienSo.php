<!DOCTYPE html>
<html>

<head>
    <title>Quản lý gửi và lấy xe</title>
</head>

<body>
    <h2>Quản lý gửi và lấy xe</h2>
    <h3>Gửi xe - Quét biển số</h3>
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
    $ve = $_SESSION["ve_gui"];
    if (!isset($ve))
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
                $_SESSION["thong_tin_ve_gui"] = $result;
                echo "<script>window.location.href = 'GhiNhanThongTin.php'</script>";
            } else {
                echo "xác nhận biến số không hợp lệ";
                echo $_POST["bien_so_xe"] . "---" . $result["bien_so_xe"];
            }
        } else {
            $_SESSION["bien_so_xe_gui"] = $_POST["bien_so_xe"];
            echo "<h1>Là thẻ ngày</h1> <h2>Đang ghi nhận thông tin gửi</h2>";
            echo "<script>window.location.href = 'GhiNhanThongTin.php'</script>";
        }
    }
    ?>
</body>

</html>