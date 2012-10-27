<?php
$url = Url::getCurrentUrl();
$pages = array(
	'home' => 'Home',
	'papers' => 'Papers',
	'thinking' => 'Personal Thinking',
);
foreach($pages as $page => $title) {
	$selected = !$url->hasQueryVar('page') && $page == 'home'
	            || $url->hasQueryVar('page') && $url->getQueryVar('page') == $page;
	echo '<a '.($selected ? 'class="selected"' : '').' href="?page='.$page.'">'.$title.'</a>';
}
?>