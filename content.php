<?php
$getFileForPage = function($page) {return "content/$page.php";};

$default = 'home';
$file = $getFileForPage(isset($_GET['page']) ? $_GET['page'] : $default);
$file = is_file($file) ? $file : $getFileForPage($default);
include_once($file);
?>