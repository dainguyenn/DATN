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
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/Css/login.css">
    <title>Login</title>
</head>
<body>
    <div class="sign-in">
        <div class="back-img">
            <div class="sign-in-text">
                <a class="nonactive" href="sign-in.php">Sign In</a>
                <a class="active" href="sign-up.php">Sign Up</a>
            </div>
        </div> 
            <form method="post" id="form-login">
                <div class="form-item">
                    <input class="form-input" type="text" name="account" placeholder=" ">
                    <label for="name" class="form-label">
                        Tên đăng nhập
                    </label>
                </div>
                <br/>
                <div class="form-item">
                    <input class="form-input" type="password" name="password" placeholder=" ">
                    <label for="password" class="form-label">
                        Mật khẩu  
                    </label>
                </div>
                <br/>
                <div class="form-item">
                    <input class="form-input" type="password" name="password" placeholder=" ">
                    <label for="password" class="form-label">
                        Nhập lại mật khẩu 
                    </label>
                </div>
                
                <!-- <div class="form-option">
                    <i class="forgot-text">Forgot Password ?</i>
                    <label class="check-label" for="checkbox-1">
                        <input type="checkbox" id="checkbox-1" class="checkbox__input" checked>
                        <span class="keep-text">Keep me Signed In</span>
                    </label>
                </div> -->
                <button type="submit" name="btn-login" class="btn-login">
                        Sign up
                </button>   
            </form>
        
    </div>
</body>

<?php
if(isset($_POST['login']))
{
    AuthHelper::login('a');
}
?>
</html>