<!DOCTYPE html>
<html>

<head>
    <title>Quản lý gửi và lấy xe</title>
</head>
<?php
require_once '../../../autoload.php';

use Helpers\PathHelper;
use Model\LuotGui;
use Model\ThongTinVe;

?>

<body>
    <h2>Quản lý gửi và lấy xe</h2>
    <h3>thông tin lượt gửi nhận</h3>
    <img src="<?php echo PathHelper::storage_path('storage/images/1686414968.jpeg'); ?>">
    <?php
    session_start();

    use Helpers\UploadFileHelper;

    $thongTinVeModel = new LuotGui();
    $danhsach = $thongTinVeModel->getAll();
    print_r($danhsach);
    echo "<h1>" . count($danhsach) . "</h1>";
    echo "<table border='1' collpadding='5px' collspacing='0'>";

    echo "<tr>";
    foreach ($danhsach as $key => $value) {
        foreach ($value as $nameRow => $x) {
            echo "<td>" . $nameRow . "</td>";
        }
        break;
    }
    echo "</tr>";
    foreach ($danhsach as $key => $value) {
        echo "<tr>";
        foreach ($value as $col => $item) {
            echo <<<tt
            <td>${item}</td>
            tt;
            if ($col == "hinh_anh_vao") {
                echo "<td>";
                $link = PathHelper::storage_path((string) $item);
                $img = "<img src='${link}' width='50px' />";
                echo $img;
                echo "</td>";
            }
        }
        echo "</tr>";
    }
    echo "</table>"
        ?>
</body>

</html>