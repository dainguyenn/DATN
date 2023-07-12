<?php
use Helpers\ViewHelper;

require_once dirname(__DIR__) . '/autoload.php';

use Helpers\AuthHelper;

AuthHelper::isLogging();
?>
<?php ob_start(); ?>

<img src="/View/logo.jpg" style="display: block; margin: 0 auto;" width="500px">
<div style="display: flex; justify-content: space-evenly;">
    <div class="btn-menu btn-success my-menu-container">
        <i class="fa-regular fa-address-card"></i>
        Quản lí vé
        <ul class="my-menu-ul">
            <li><a href="./View/card/chuho.php">Danh sách vé tháng</a></li>
            <li><a href="./View/card/listCardDay.php">Danh sách vé ngày</a></li>
            <li><a href="./View/card/createMonthCard.php">Tạo vé tháng mới</a></li>
            <li><a href="./View/card/createDayCard.php">Tạo vé ngày mới</a></li>
        </ul>
    </div>
    <div class="btn-menu btn-success my-menu-container">
        <i class="fa-solid fa-car-side"></i>
        Quản lí trông xe
        <ul class="my-menu-ul">
            <li><a href="./View/vehicle/parking/">Gửi xe</a></li>
            <li><a href="./View/vehicle/taking/">Lấy xe</a></li>
        </ul>
    </div>
    <div class="btn-menu btn-success my-menu-container">
        <i class="fa-solid fa-clipboard-list"></i>
        Thống kê
        <ul class="my-menu-ul">
            <li><a href="./View/statistics/searchCard.php">Thống kê lượt gửi</a></li>
            <li><a href="./View/statistics/income.php">Thống kê doanh thu</a></li>
            <li><a href="./View/statistics/parking.php">Thống kê xe đang gửi</a></li>
            <li><a href="./View/statistics/reportMonthCard.php">Vé tháng chưa đóng tiền</a></li>
        </ul>
    </div>
    <a class="btn-menu btn-warning my-menu-container" href="/View/auth/sign-out.php">
        <i class="fa-solid fa-right-from-bracket"></i>
        Đăng xuất
    </a>
</div>


<!-- Luôn import (coppy vào file của mình)-->
<?php $content = ob_get_clean(); ?>
<?= str_replace('{{content}}', $content, file_get_contents(\Helpers\PathHelper::app_path('view/sidebar-header.php'))) ?>
<?php echo ViewHelper::title('Home');
echo ViewHelper::user($_SESSION["user"]); ?>
<!-- -->

<style>
    /* menu */
    .my-menu-container {
        position: relative;
    }

    .my-menu-ul {
        font-size: 1.2rem;
        display: inline-block;
        padding: 0;
        margin: 0;
        list-style-type: none;
        background: gold;
        width: 100%;
        border-top: 5px solid #fff;
        position: absolute;
        box-shadow: 5px 5px 10px 0 rgba(0, 0, 0, 0.5);

        opacity: 0;
        z-index: -1;

        top: 130%;
        left: 0;
        box-sizing: content-box;
    }

    .my-menu-ul li {
        border-top: 1px solid #fff;
        padding: 10px 10px;
    }

    .my-menu-ul li a {
        display: block;
    }

    .my-menu-ul li:hover {
        background: rgb(207, 176, 0);
    }

    .my-menu-container:hover .my-menu-ul {
        top: 100%;
        opacity: 1;
        z-index: 1;
        transition: all 0.2s ease-in;
    }

    /* ends */
</style>