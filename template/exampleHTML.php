<?php
require_once '../../autoload.php';
?>

<?php ob_start(); ?>
<!---->

<div>
<!--Content ở đây-->
</div>


<?php $content = ob_get_clean(); ?>
<?= str_replace('{{content}}', $content, file_get_contents(\Helpers\PathHelper::app_path('view/sidebar-header.php'))) ?>
<!--Đây là title-->
<?php echo \Helpers\ViewHelper::title('Danh sách vé tháng');?><!---->
