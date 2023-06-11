<!DOCTYPE html>
<html>

<head>
    <title>Quản lý gửi và lấy xe</title>
</head>

<body>
    <h2>Quản lý gửi và lấy xe</h2>
    <h3>Gửi xe - Chụp ảnh phía trước xe( người gửi )</h3>
    <form method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"]; ?>
    ">
        <label for="hinh_anh">Hình ảnh gửi</label>
        <input type="file" name="hinh_anh" id="hinh_anh">
        <br>
        <input type="submit" name="sub" value="gui">
    </form>
    <?php
    require_once '../../../autoload.php';
    session_start();

    use Helpers\UploadFileHelper;

    $veModel = new \Model\Ve();
    $luotGuiModel = new \Model\LuotGui();
    $ve = $_SESSION["ve_gui"];
    $thongTinVe = $_SESSION["thong_tin_ve_gui"];
    $bienSoXe = $_SESSION["bien_so_xe_gui"];

    if (!isset($ve) && !(isset($thongTinVe) || isset($bienSoXe)))
        header("location:index.php");
    print_r($_SESSION);

    if (isset($_POST["sub"])) {

        if (isset($_FILES["hinh_anh"])) {
            $now = date("Y-m-d H:i:s");
            $pathImage = UploadFileHelper::SaveFile($_FILES["hinh_anh"]);
            print_r($pathImage . "  log thông tin");
            $result = null;
            if ($ve["loai_ve"] == "Tháng") {
                $result = $luotGuiMoi = $luotGuiModel->create([
                    "ma_ve" => $ve["ma_ve"],
                    "bien_so_xe" => $thongTinVe["bien_so_xe"],
                    "hinh_anh_vao" => $pathImage,
                    "gio_vao" => $now
                ]);
            } else {
                $result = $luotGuiMoi = $luotGuiModel->create([
                    "ma_ve" => $ve["ma_ve"],
                    "bien_so_xe" => $bienSoXe,
                    "hinh_anh_vao" => $pathImage,
                    "gio_vao" => $now
                ]);
            }
            print_r($result);

            if (!$result) {
                echo "lỗi trong quá trình thêm";
                exit;
            } else {
                echo "Xe đã được ghi nhận thành công";
                unset($_SESSION["ve_gui"]);
                unset($_SESSION["thong_tin_ve_gui"]);
                unset($_SESSION["bien_so_xe_gui"]);
            }
        } else {
            echo "<h1>Bạn chưa nhập hình ảnh</h2>";
        }
    } else {
        echo "<h1> Chưa gửi thông tin </h1>";
    }
    ?>
</body>

</html>