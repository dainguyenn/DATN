<h2>Lấy xe - Quẹt thẻ</h2>
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
    Helpers\AuthHelper::isLogging();
    use Helpers\ViewHelper;
    use Helpers\SessionHelper;
    use Helpers\WindowHelper;

    session_start();
    $veModel = new \Model\Ve();
    $luotGuiModel = new \Model\LuotGui();
    if (isset($_POST["sub"])) {

        $ve = $veModel->findById($_POST["ma_the"])[0];
        if (!$ve) {
            echo "<p class='invalid'>Thẻ không tồn tại</p>";
        } else if ($ve["trang_thai"] === 0) {
            echo "<p class='invalid'> Thẻ đang tạm thời bị khóa, gặp ban quản lý để giải quyết </p>";
        } else if (!$luotGuiModel->CheckMaTheDangGui($_POST["ma_the"])) {
            echo "<p class='invalid' class='invalid'>Thẻ chưa được ghi nhận gửi</p>";
        } else {
            SessionHelper::store("ve_lay", $ve);
            SessionHelper::store("la_dang_gui", true);
            echo WindowHelper::location("QuetBienSo.php");
        }
    }

    ?>

</div>


<?php
/* log ra dia chi mien
$actual_link = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
echo "<h1>" . $actual_link . "</h1>";
*/
?>
<!--Luôn import (coppy vào file của mình)-->
<?php $content = ob_get_clean(); ?>
<?= str_replace('{{content}}', $content, file_get_contents(\Helpers\PathHelper::app_path('view/sidebar-header.php'))) ?>
<?php echo ViewHelper::title('Quản lí gửi lấy xe');
echo ViewHelper::user($_SESSION["user"]); ?>
<!---->