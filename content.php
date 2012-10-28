<?php
$page = Page::getDisplayedPage();
echo '<div id="lastUpdateTime">Last update: '.date ("d/m/Y H:i:s", $page->getLastUpdateTime()).'</div>';
echo $page->getContent();
?>