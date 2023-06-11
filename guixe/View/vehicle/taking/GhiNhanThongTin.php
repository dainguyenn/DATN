<!DOCTYPE html>
<html>

<head>
    <title>Quản lý gửi và lấy xe</title>
</head>

<body>
    <h2>Quản lý gửi và lấy xe</h2>
    <h3>Ghi nhận thông tin lấy xe</h3>
    <form method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"]; ?>
    ">
        <label for="hinh_anh">Hình ảnh lấy</label>
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
    $ve = $_SESSION["ve"];
    $thongTinVe = $_SESSION["thong_tin_ve"];
    $bienSoXe = $_SESSION["bien_so_xe"];
    $luotGui = $_SESSION["luot_gui"];
    if (!isset($ve) || !(isset($thongTinVe) || isset($bienSoXe)))
        header("location:index.php");
    print_r($_SESSION);

    if (isset($_POST["sub"])) {

        if (isset($_FILES["hinh_anh"]) && $_FILES["hinh_anh"]["size"] > 0) {
            $now = date("Y-m-d H:i:s");
            $pathImage = UploadFileHelper::SaveFile($_FILES["hinh_anh"]);
            print_r($pathImage . "  log thông tin");
            $result = null;
            try {
                if ($ve["loai_ve"] == "Tháng") {
                    $result = $luotGuiModel->update(
                        $luotGui["ma_luot_gui"],
                        [
                            "hinh_anh_ra" => $pathImage,
                            "gio_ra" => $now
                        ]
                    );
                } else {
                    $result = $luotGuiModel->update(
                        $luotGui["ma_luot_gui"],
                        [
                            "hinh_anh_ra" => $pathImage,
                            "gio_ra" => $now
                        ]
                    );
                }
            } catch (\Exception $e) {
                echo "lỗi trong quá trình cập nhật thông tin";

            }

            // if (!$result) {
            //     exit;
            // } else {
            //     echo "Lấy xe đã được ghi nhận thành công";
            // }
        } else {
            echo "<h1>Bạn chưa nhập hình ảnh</h2>";
        }
    } else {
        echo "<h1> Chưa gửi thông tin </h1>";
    }
    ?>
</body>

</html>