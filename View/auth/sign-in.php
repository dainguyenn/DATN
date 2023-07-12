<?php

use Helpers\AuthHelper;
use Helpers\SessionHelper;

require_once '../../autoload.php';

SessionHelper::start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/Css/login.css">
    <title>Login</title>
</head>

<body>
    <div class="sign-in">
        <div class="back-img">
            <div class="sign-in-text">
                <a class="active" href="sign-in.php">Sign In</a>
                <a class="nonactive" href="sign-up.php">Sign Up</a>
            </div>
        </div>
        <form method="post" id="form-login">
            <div class="form-item">
                <input class="form-input" type="text" name="account" placeholder=" ">
                <label for="name" class="form-label">
                    Tên đăng nhập
                </label>
            </div>
            <br />
            <div class="form-item">
                <input class="form-input" type="password" name="password" placeholder=" ">
                <label for="password" class="form-label">
                    Mật khẩu
                </label>
            </div>
            <br />
            <div class="login-options">
                <div class="check">
                    <label>
                        <input type="checkbox" id="checkbox-1" class="checkbox__input" checked>
                        <span class="keep-text">Ghi nhớ đăng nhập</span>
                    </label>
                </div>
                <a class="forgot-text" href="#">Quên mật khẩu?</a>
            </div>
            <button type="submit" name="btn-signin" class="btn-login">
                Sign in
            </button>
        </form>

    </div>
</body>

<?php
use Model\TaiKhoan;

if (isset($_POST['btn-signin'])) {
    $taiKhoanModel = new TaiKhoan();
    $taiKhoan = null;
    if ($_POST["account"] == null || $_POST["password"] == null) {
        echo "<p class='invalid'>Phai nhap day du tai khoan mat khau </p>";
    } else {
        $taiKhoan = $taiKhoanModel->Login($_POST["account"], $_POST["password"]);
        if (count($taiKhoan) == 0) {
            echo "<p class='invalid'>Phai nhap day du tai khoan mat khau </p>";
        } else {
            print_r($taiKhoan);
            AuthHelper::login($taiKhoan[0]["ten_tai_khoan"]);
        }

    }

}
?>

</html>