<h3>Gửi xe - Quét biển số</h3>
<h4>Loại vé:
    <?php
    use Helpers\WindowHelper;

    session_start();
    echo $_SESSION["ve_gui"]["loai_ve"]
        ?>
</h4>
<div class="form-style-6">
    <form method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <input type="hidden" name="action" value="gui_xe">
        <label for="bien_so_xe">Biển số: </label>
        <input type="text" name="bien_so_xe" placeholder="Nhập biển số xe" id="bien_so_xe">
        <br>
        <input type="submit" name="sub" value="xác nhận biển số">
    </form>
    <div class="form-style-6">

        <?php
        require_once '../../../autoload.php';
        use Helpers\ViewHelper;
        use Helpers\SessionHelper;

        $veModel = new \Model\Ve();
        $thongTinVeModel = new \Model\ThongTinVe();
        $ve = SessionHelper::get("ve_gui"); 

        if (!isset($ve))
            echo WindowHelper::location("index.php");

        if (isset($_POST["sub"])) {
            if ($ve["loai_ve"] == "Tháng") {
                $result = $thongTinVeModel->findById($ve["ma_ve"])[0];
                
                if (!$result) {
                    echo "<p class='invalid'>lỗi trong quá trình kiểm tra</p>";
                    exit;
                }
                if ($_POST["bien_so_xe"] == $result["bien_so_xe"]) {
                    SessionHelper::store("bien_so_xe_gui", $result["bien_so_xe"]);
                    echo "<p class='valid'>Đang ghi nhận thông tin gửi</p>";
                    echo WindowHelper::location('GhiNhanThongTin.php');
                } else {
                    echo "<p class='invalid'>xác nhận biến số không hợp lệ </p>";
                }
            } else {
                SessionHelper::store("bien_so_xe_gui", $_POST["bien_so_xe"]);
                echo "<p class='valid'>Đang ghi nhận thông tin gửi</p>";
                echo WindowHelper::location('GhiNhanThongTin.php');
            }
        }
        ?>
        <!--Luôn import (coppy vào file của mình)-->
        <?php $content = ob_get_clean(); ?>
        <?= str_replace('{{content}}', $content, file_get_contents(\Helpers\PathHelper::app_path('view/sidebar-header.php'))) ?>
        <?php echo ViewHelper::title('Quản lí gửi lấy xe'); ?>
        <!---->