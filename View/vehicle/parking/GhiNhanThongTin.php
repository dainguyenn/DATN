<h3>Gửi xe - Chụp ảnh phía trước xe( người gửi )</h3>
<h4>Loại vé:
    <?php
    session_start();
    echo $_SESSION["ve_gui"]["loai_ve"]
        ?>
</h4>
<div class="form-style-6">
    <form method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"]; ?>
    ">
        <label for="hinh_anh">Hình ảnh gửi</label>
        <input type="file" name="hinh_anh" id="hinh_anh">
        <br>
        <input type="submit" name="sub" value="gui">
    </form>

    <?php
    require_once '../../../autoload.php';

    use Helpers\UploadFileHelper;
    use Helpers\ViewHelper;

    $veModel = new \Model\Ve();
    $luotGuiModel = new \Model\LuotGui();
    $ve = $_SESSION["ve_gui"];
    $bienSoXe = $_SESSION["bien_so_xe_gui"];
    $result = false;

    if (!isset($ve) && !isset($bienSoXe))
        header("location:index.php");
    //print_r($_SESSION);
    
    if (isset($_POST["sub"])) {

        if (isset($_FILES["hinh_anh"])) {
            $now = date("Y-m-d H:i:s");
            $pathImage = UploadFileHelper::SaveFile($_FILES["hinh_anh"]);

            //print_r($pathImage . "  log thông tin");
            if (str_contains($ve["loai_the"], "Tháng")) {
                // echo "<hr>";
                // print_r($thongTinVe);
                // echo "<hr>";
                $result = $luotGuiModel->create([
                    "ma_ve" => $ve["ma_ve"],
                    "bien_so_xe" => $bienSoXe,
                    "hinh_anh_vao" => $pathImage,
                    "gio_vao" => $now
                ]);
            } else {
                // echo "<hr>";
                // print_r($ve["loai_the"]);
                // echo "<hr>";
                $result = $luotGuiModel->create([
                    "ma_ve" => $ve["ma_ve"],
                    "bien_so_xe" => $bienSoXe,
                    "hinh_anh_vao" => $pathImage,
                    "gio_vao" => $now
                ]);
            }

            if ($result) {
                echo "<p class='valid'>Xe đã được ghi nhận gửi thành công <h2><p> <a class='btn btn-primary' href='index.php'> Quay lại</a>";
                unset($_SESSION["ve_gui"]);
                unset($_SESSION["thong_tin_ve_gui"]);
                unset($_SESSION["bien_so_xe_gui"]);
            } else {
                echo "lỗi trong quá trình thêm";
                exit;

            }
        } else {
            echo "<h1 class='invalid'>Bạn chưa nhập hình ảnh</h1>";
        }
    } else {
        //echo "<h1 class='invalid'>Chưa gửi thông tin</h1>";
    }
    ?>

</div>
<!--Luôn import (coppy vào file của mình)-->
<?php $content = ob_get_clean(); ?>
<?= str_replace('{{content}}', $content, file_get_contents(\Helpers\PathHelper::app_path('view/sidebar-header.php'))) ?>
<?php echo ViewHelper::title('Quản lí gửi lấy xe'); ?>
<!---->