<?php
use Helpers\AuthHelper;

require_once '../../autoload.php';
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>

<body>
    <div class="form-style-6">
        <form method="POST">
            <div>
                <h1>Login</h1>
                <input type="text" name="username" placeholder="Tên tài khoản" id="">
                <input type="text" name="password" placeholder="Mật khẩu" id="">
                <input type="button" name="login" value="login" />
            </div>
        </form>
        <?php
        if (isset($_POST['login'])) {
            AuthHelper::login('a');
        }
        ?>
    </div>
    <!--Luôn import (coppy vào file của mình)-->
    <?php $content = ob_get_clean(); ?>
    <?= str_replace('{{content}}', $content, file_get_contents(\Helpers\PathHelper::app_path('view/sidebar-header.php'))) ?>
    <!---->
</body>

</html>