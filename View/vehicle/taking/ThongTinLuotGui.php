<!DOCTYPE html>
<html>

<head>
    <title>Quản lý gửi và lấy xe</title>
</head>
<?php
require_once '../../autoload.php';

use Helpers\PathHelper;

?>

<body>
    <h2>Quản lý gửi và lấy xe</h2>
    <h3>Gửi xe</h3>
    <img src="<?php echo PathHelper::storage_path('storage/images/1686414968.jpeg'); ?>">
    <?php
    require_once '../../../autoload.php';
    
    session_start();

    use Helpers\UploadFileHelper;

    $veModel = new \Model\Ve();
    $luotGuiModel = new \Model\LuotGui();
    $ve = $_SESSION["ve"];
    $thongTinVe = $_SESSION["thong_tin_ve"];
    print_r($_SESSION);
    if (isset($_POST["sub"])) {
        if (isset($_FILES["hinh_anh"])) {
            $now = date("Y-m-d H:i:s");
            $pathImage = UploadFileHelper::SaveFile($_FILES["hinh_anh"]);
            print_r($pathImage . "  log thông tin");
            $result = $luotGuiMoi = $luotGuiModel->create([
                "ma_ve" => $_SESSION["ve"]["ma_ve"],
                "bien_so_xe" => $_SESSION["thong_tin_ve"]["bien_so_xe"],
                "hinh_anh_vao" => $pathImage,
                "gio_vao" => $now
            ]);
            print_r($result);
            if (!$result) {
                echo "lỗi trong quá trình thêm";
                exit;
            } else {
                echo "Thêm không thành công";
            }
        } else {
            echo "<h1>Bạn chưa nhập hình ảnh</h2>";
        }
    } else {
        echo "<h1> Chưa gửi thông tin </h1>";
    }
    ?>
</body>

</html>