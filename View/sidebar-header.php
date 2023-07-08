<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Css/Sidebar-header.css">
    <link rel="stylesheet" href="/Css/style-table.css">
    <link rel="stylesheet" href="/Css/style-form.css">
    <link rel="stylesheet" href="/Css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title></title>
</head>

<body>
    <div class="container-main">
        <nav class="sidebar">
            <ul class="nav">
                <li class="nav-item">
                    <div class="menu-title">
                        <i class="fa-regular fa-address-card"></i>
                        <span class="title">Quản lý vé</span>
                        <i class="menu-arrow fa fa-chevron-down"></i>
                    </div>
                    <div class="menu-items">
                        <ul class="nav-menu items-show">
                            <li class="nav-item">
                                <a class="nav-link" href="/View/card/chuho.php">Chủ hộ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/View/card/listCardDay.php">Vé ngày</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="menu-title">
                        <i class=" menu-icon fa fa-car-side"></i>
                        <span class="title">Quản lý trông xe</span>
                        <i class="menu-arrow fa fa-chevron-down"></i>
                    </div>
                    <div class="menu-items">
                        <ul class="nav-menu items-show">
                            <li class="nav-item">
                                <a class="nav-link" href="/View/vehicle/parking/index.php">Gửi xe</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/View/vehicle/taking/index.php">Lấy xe</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="menu-title">
                        <i class=" menu-icon fa fa-clipboard-list"></i>
                        <span class="title">Thống kê</span>
                        <i class="menu-arrow fa fa-chevron-down"></i>
                    </div>
                    <div class="menu-items">
                        <ul class="nav-menu items-show">
                            <li class="nav-item">
                                <a class="nav-link" href="/View/statistics/searchCard.php">Tìm kiếm</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/View/statistics/parking.php">Xe đang gửi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/View/statistics/income.php">Doanh thu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/View/statistics/reportMonthCard.php">Vé tháng chưa đóng</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="header-bar">
            <nav class="header-nav">
                <li class="header-nav-item">
                    <a class="logo nav-link" href="">
                        <img src="../storage/images/1686459031.png" alt="">
                        <span class="nav-head-title">
                            Quản lý trông giữ xe chung cư
                        </span>
                    </a>
                </li>
                <li class="header-nav-item">
                    <a class="logo nav-link" href="">
                        <span class="nav-head-title title-page" id="page-title">
                        </span>
                    </a>
                </li>
                <li class="header-nav-item user-dropdown">
                    <div class="user-dropdown">
                        <i class="fa-solid fa-circle-user"></i>
                        <span>Admin</span>
                        <i class="user-arrow fa fa-chevron-down"></i>
                        <ul class="drop-menu">
                            <li class="drop-menu-item">
                                <i class="fa fa-user"></i>
                                <a href="#">Profile</a>
                            </li>
                            <li class="drop-menu-item">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                <a href="#">Logout</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </nav>
        </div>
        <div class="main-panel">
            <div class="content-wrapper">
                {{content}}
            </div>
        </div>
    </div>
</body>