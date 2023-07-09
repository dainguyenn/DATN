<?php
use Helpers\ViewHelper;

require_once dirname(__DIR__) . '/autoload.php';

use Helpers\AuthHelper;

AuthHelper::isLogging();
?>
<?php ob_start(); ?>
<div>
</div>

<!--Luôn import (coppy vào file của mình)-->
<?php $content = ob_get_clean(); ?>
<?= str_replace('{{content}}', $content, file_get_contents(\Helpers\PathHelper::app_path('view/sidebar-header.php'))) ?>
<?php echo ViewHelper::title('Home'); ?>
<!---->
