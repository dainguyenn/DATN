<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tạo vé tháng mới</title>
</head>
<body>
<?php
require_once '../../autoload.php';

use Model\Ve;

$veModel = new Ve();

$ve = $veModel->findById(1);

?>
<h1>Sửa thẻ</h1>
<div>
    <form method="POST">
        <div>
            <label>Loại thẻ</label>
            <input name="loai_the" value="<?php echo $ve['loai_the']?>">
        </div>
        <div>
            <label>Loại xe</label>
            <input name="loai_xe" value="<?php echo $ve['loai_xe']?>">
        </div>
        <button>Tạo</button>
    </form>
</div>

</body>

</html>