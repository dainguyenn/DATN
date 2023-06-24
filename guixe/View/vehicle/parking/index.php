<form method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <input type="hidden" name="action" value="gui_xe">
    <label for="ma_the">Mã thẻ:</label>
    <input type="text" name="ma_the" id="ma_the">
    <br>
    <input type="submit" name="sub" value="gui">
</form>
<?php
require_once '../../../autoload.php';
session_start();
$veModel = new \Model\Ve();
$luotGuiModel = new \Model\LuotGui();
if (isset($_POST["sub"])) {
    if ($luotGuiModel->CheckMaTheDangGui($_POST["ma_the"])) {
        echo "Thẻ đang trong quá trình gửi";
        exit;
    }
    $allVe = $veModel->findById($_POST["ma_the"])[0];
    if (!$allVe) {
        echo "Thẻ không tồn tại";
        exit;
    }
    $_SESSION["ve_gui"] = $allVe;
    echo "<script>window.location.href = 'QuetBienSo.php'</script>";

}
?>
<!--Luôn import (coppy vào file của mình)-->
<?php $content = ob_get_clean(); ?>
<?= str_replace('{{content}}', $content, file_get_contents(\Helpers\PathHelper::app_path('view/sidebar-header.php'))) ?>
<!---->