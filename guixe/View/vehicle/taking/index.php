<!DOCTYPE html>
<html>

<head>
    <title>Quản lý gửi và lấy xe</title>
</head>

<body>
    <h1>Quản lý gửi và lấy xe</h1>
    <h2>Lấy xe - Quẹt thẻ</h2>
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

        $ve = $veModel->findById($_POST["ma_the"])[0];
        if (!$ve) {
            echo "Thẻ không tồn tại";
            exit;
        }
        if ($luotGuiModel->CheckMaTheDangGui($_POST["ma_the"])) {
            $_SESSION["ve_lay"] = $ve;
            $_SESSION["la_dang_gui"] = true;
            echo "<script>window.location.href = 'QuetBienSo.php'</script>";
        } else {
            echo "Thẻ chưa được ghi đang nhận gửi xe";
            exit;
        }



    }
    ?>
</body>

</html>