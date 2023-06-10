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

$allVe = $veModel->getInfo();
print_r($allVe);
?>
<body>
<h1>Quản lý thẻ</h1>
<a href="createCard.php">Tạo thẻ mới</a>
<table>
    <thead>
    <tr>
        <th>Mã thẻ</th>
        <th>Mã căn hộ</th>
        <th>Tên chủ hộ</th>
        <th>Biển số xe</th>
        <th>Loại thẻ</th>
        <th>Loại xe</th>
    </tr>
    </thead>
    <?php
    foreach ($allVe as $item) {

        ?>
        <tr>
            <td><?php echo $item['ma_the']?></td>
            <td><?php echo $item['loai_the']?></td>
            <td><?php echo $item['loai_xe']?></td>
        </tr>
    <?php } ?>
</table>
</body>
</html>