<h3>Lấy xe - Quét biển số</h3>
<h4> Loại vé:
    <?php
    session_start();
    echo $_SESSION["ve_lay"]["loai_ve"];
    ?>
</h4>
<div class="form-style-6">
    <form method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <input type="hidden" name="action" value="lay_xe">
        <label for="bien_so_xe">Biển số</label>
        <input type="text" name="bien_so_xe" placeholder="Nhập biển số" id="bien_so_xe">
        <br>
        <input type="submit" name="sub" value="Xác nhận biển số">
    </form>
    <?php
    require_once '../../../autoload.php';

    $veModel = new \Model\Ve();
    $thongTinVeModel = new \Model\ThongTinVe();
    $luotGuiModel = new \Model\LuotGui();
    $ve = $_SESSION["ve_lay"];
    $laDangGui = $_SESSION["la_dang_gui"];
    if (!isset($ve) || !isset($laDangGui) || !$laDangGui)
        header("location:index.php");
    $luotGui = $luotGuiModel->GetThongTinTheDangGui($ve["ma_ve"]);
    //print_r($_SESSION);
    if (isset($_POST["sub"])) {
        if ($ve["loai_ve"] == "Tháng") {
            $result = $thongTinVeModel->findById($ve["ma_ve"])[0];
            //print_r($result);
            if (!$result) {
                echo "<p class='invalid'>lỗi trong quá trình kiểm tra</p>";
                exit;
            }
            if ($_POST["bien_so_xe"] == $result["bien_so_xe"]) {
                echo "<p class='valid'>xác nhận biển số thành công </p>";
                $_SESSION["xac_nhan_bien_so_lay"] = true;
                echo "<script>window.location.href = 'GhiNhanThongTin.php'</script>";
            } else {
                echo "<p class='invalid'>xác nhận biến số không hợp lệ<p>";
                echo "<p>" . $_POST["bien_so_xe"] . "---" . $result["bien_so_xe"] . "</p>";
            }
        } else {
            if ($luotGui["bien_so_xe"] == $_POST["bien_so_xe"]) {
                echo "<p class='valid'>Là thẻ ngày, Tiến hành thanh toán</p>";
                $_SESSION["xac_nhan_bien_so_lay"] = true;
                echo "<script>window.location.href = 'pay.php'</script>";
            } else {
                echo "<p class='invalid'>Biển số xe không trùng khớp</p>";
            }
        }
    }
    ?>

</div>
<!--Luôn import (coppy vào file của mình)-->
<?php $content = ob_get_clean(); ?>
<?= str_replace('{{content}}', $content, file_get_contents(\Helpers\PathHelper::app_path('view/sidebar-header.php'))) ?>
<!---->