<?php
require 'top.php';
$main_content = $gSmarty->fetch('index.tpl');
$gSmarty->assign_by_ref('main_content', $main_content);
$gSmarty->display('main_template.tpl');
require 'bottom.php';
?>
