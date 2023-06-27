<h3>Gửi xe - Quét mã thẻ</h3>


<div class="form-style-6">
    <form method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <input type="hidden" name="action" value="gui_xe">
        <label for="ma_the">Mã thẻ:</label>
        <input type="text" name="ma_the" placeholder="Nhập mã thẻ" id="ma_the">
        <br>
        <input type="submit" name="sub" value="Xác nhận mã thẻ">
    </form>


    <?php

    require_once '../../../autoload.php';
    session_start();
    $veModel = new \Model\Ve();
    $luotGuiModel = new \Model\LuotGui();

    if (isset($_POST["sub"])) {
        $laDangGui = $luotGuiModel->CheckMaTheDangGui($_POST["ma_the"]);
        $allVe = $veModel->findById($_POST["ma_the"])[0];
        if ($laDangGui) {

            echo "<p class='invalid'>Thẻ đang trong quá trình gửi</p>";

        } else if (!$allVe) {

            echo "<p class='invalid'>Thẻ không tồn tại</p>";

        } else {

            $_SESSION["ve_gui"] = $allVe;
            echo "<script>window.location.href = 'QuetBienSo.php'</script>";

        }

    }
    ?>

</div>

<!--Luôn import (coppy vào file của mình)-->
<?php $content = ob_get_clean(); ?>
<?= str_replace('{{content}}', $content, file_get_contents(\Helpers\PathHelper::app_path('view/sidebar-header.php'))) ?>
<!---->