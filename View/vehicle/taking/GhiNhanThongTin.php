<h3>Ghi nhận thông tin lấy xe</h3>

<div class="form-style-6">
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
    use Helpers\ViewHelper;
    use Helpers\SessionHelper;
    use Helpers\WindowHelper;

    $veModel = new \Model\Ve();
    $luotGuiModel = new \Model\LuotGui();
    $ve = $_SESSION["ve_lay"];
    $xacNhanBienSoLay = SessionHelper::get("xac_nhan_bien_so_lay"); //$_SESSION["xac_nhan_bien_so_lay"];
    $xacNhanThanhToan = SessionHelper::get("da_thanh_toan"); //$_SESSION["da_thanh_toan"];
    $thanhTien = SessionHelper::get("da_thanh_toan"); //$_SESSION["so_tien_thanh_toan"];
    print_r($_SESSION);
    //kiểm tra thẻ đã có thông tin vé hay chưa
    // đã xác nhận biển số chưa, biển số đã hợp lệ chưa
    if (!isset($ve) || !isset($xacNhanBienSoLay) || !$xacNhanBienSoLay) {
        //echo "<script>window.location.href = 'index.php'</script>";
        echo WindowHelper::location('index.php');
    }
    //kiểm tra thẻ ngày đã thanh toán chưa
    if ($ve["loai_the"] == "Ngày" && !isset($xacNhanThanhToan) && !$xacNhanThanhToan) {
        //echo "<script>window.location.href = 'index.php'</script>";
        echo WindowHelper::location('index.php');
    }

    $luotGui = $luotGuiModel->GetThongTinTheDangGui($ve["ma_ve"]);
    //print_r($_SESSION);
    
    if (isset($_POST["sub"])) {

        // ghi nhận có thông tin ảnh
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
                            "gio_ra" => $now,
                            "thanh_toan" => $thanhTien
                        ]
                    );
                }
            } catch (\Exception $e) {
                echo "<p class='invalid'>lỗi trong quá trình cập nhật thông tin</p>";

            }

            echo "<p class='valid'>Xe đã được ghi nhận lấy thành công </p> <br/> <a class='btn btn-primary' href='index.php'> Quay lại</a>";

            /*
            unset($_SESSION["ve_lay"]);
            unset($_SESSION["xac_nhan_bien_so_lay"]);
            unset($_SESSION["la_dang_gui"]);
            unset($_SESSION["bien_so_xe"]);
            */

            SessionHelper::delete("ve_lay");
            SessionHelper::delete("xac_nhan_bien_so_lay");
            SessionHelper::delete("la_dang_gui");
            SessionHelper::delete("bien_so_xe");
            SessionHelper::delete("da_thanh_toan");
            SessionHelper::delete("so_tien_thanh_toan");
            // if (!$result) {
            //     exit;
            // } else {
            //     echo "Lấy xe đã được ghi nhận thành công";
            // }
    
        } else {
            echo "<p class='invalid'>Bạn chưa nhập hình ảnh</p>";
        }
    } else {
        //echo "<h1 class='invalid'>Chưa gửi thông tin </h1>";
    }
    ?>

</div>
<!--Luôn import (coppy vào file của mình)-->
<?php $content = ob_get_clean(); ?>
<?= str_replace('{{content}}', $content, file_get_contents(\Helpers\PathHelper::app_path('view/sidebar-header.php'))) ?>
<?php echo ViewHelper::title('Quản lí gửi lấy xe'); ?>
<!---->