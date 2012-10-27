<?php
$getFileForPage = function($page) {return "content/$page.php";};

$default = 'home';
$file = $getFileForPage(isset($_GET['page']) ? $_GET['page'] : $default);
$file = is_file($file) ? $file : $getFileForPage($default);
echo '<div id="lastUpdateTime">Last update: '.date ("d/m/Y H:i:s", filemtime($file)).'</div>';
include_once($file);
?>