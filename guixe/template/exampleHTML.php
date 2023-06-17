<?php
require_once '../../autoload.php';
?>
<!--Luôn import-->
<?php ob_start(); ?>
<!---->

<div>
<!--Content ở đây-->
</div>

<!--Luôn import (coppy vào file của mình)-->
<?php $content = ob_get_clean(); ?>
<?= str_replace('{{content}}', $content, file_get_contents(\Helpers\PathHelper::app_path('view/sidebar-header.php'))) ?>
<!---->
