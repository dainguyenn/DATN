<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quản lý thẻ</title>
</head>
<?php
require_once '../../autoload.php';

$veModel = new \Model\Ve();
$page = $_GET['page'] ?? 1;
$limit = $_GET['limit'] ?? 25;
$allVe = $veModel->getCardDay(null,['*'],$limit,$page);
?>
<body>
<h1>Quản lý thẻ</h1>
<a href="createMonthCard.php">Tạo thẻ tháng mới</a>
<a href="createDayCard.php">Tạo thẻ ngày mới</a>
<a href="index.php">Danh sách vé tháng</a>
<a href="listCardDay.php">Danh sách vé ngày</a>
<table>
    <thead>
    <tr>
        <th>Mã vé</th>
        <th>Loại thẻ</th>
        <th>Loại xe</th>
    </tr>
    </thead>
    <?php
    foreach ($allVe['data'] as $item) {

        ?>
        <tr>
            <td><?php echo $item['ma_ve']?></td>
            <td><?php echo $item['loai_ve']?></td>
            <td><?php echo $item['loai_xe']?></td>
        </tr>
    <?php } ?>
</table>
</body>
</html>