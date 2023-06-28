<?php
require_once '../../autoload.php';
?>

<?php ob_start(); ?>
<!---->

<div>
    <form action="" method="post" class="style-search">
        <div class="form-item">
            <input class="form-input" type="text" name="account" placeholder=" ">
            <label for="name" class="form-label">
                Biển số xe
            </label>
        </div>
        <a class="btn btn-primary " href="parking.php">Danh sách xe đang gửi</a>
    </form>
</div>


<?php $content = ob_get_clean(); ?>
<?= str_replace('{{content}}', $content, file_get_contents(\Helpers\PathHelper::app_path('view/sidebar-header.php'))) ?>
<!--Đây là title-->
<?php echo \Helpers\ViewHelper::title('Tìm kiếm');?><!---->

