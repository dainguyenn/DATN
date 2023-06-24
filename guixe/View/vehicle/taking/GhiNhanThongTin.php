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
$ve = $_SESSION["ve_lay"];
$xacNhanBienSoLay = $_SESSION["xac_nhan_bien_so_lay"];
$xacNhanThanhToan = $_SESSION["da_thanh_toan"];
if (!isset($ve) || !isset($xacNhanBienSoLay) || !$xacNhanBienSoLay) {
    echo "<script>window.location.href = 'index.php'</script>";
}
if ($ve["loai_the"] == "Ngày" && !isset($xacNhanThanhToan) && !$xacNhanThanhToan) {
    echo "<script>window.location.href = 'index.php'</script>";
}
$luotGui = $luotGuiModel->GetThongTinTheDangGui($ve["ma_ve"]);
print_r($_SESSION);
if (isset($_POST["sub"])) {

    if (isset($_FILES["hinh_anh"]) && $_FILES["hinh_anh"]["size"] > 0) {
        $now = date("Y-m-d H:i:s");
        $pathImage = UploadFileHelper::SaveFile($_FILES["hinh_anh"]);
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
                //echo "<br/>";
                //print_r($result);
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
        echo "<h2>Xe đã được ghi nhận lấy thành công <h2><br> <a href='index.php> Quay lai</a>";
        unset($_SESSION["ve_lay"]);
        unset($_SESSION["xac_nhan_bien_so_lay"]);
        unset($_SESSION["la_dang_gui"]);
        unset($_SESSION["bien_so_xe"]);
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
<!--Luôn import (coppy vào file của mình)-->
<?php $content = ob_get_clean(); ?>
<?= str_replace('{{content}}', $content, file_get_contents(\Helpers\PathHelper::app_path('view/sidebar-header.php'))) ?>
<!---->