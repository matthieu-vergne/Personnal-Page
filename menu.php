<?php
$pages = array(
	'home' => 'Home',
	'papers' => 'Papers',
	'thinking' => 'Personal Thinking',
);
$url = Url::getCurrentUrl();
$askedPage = $url->hasQueryVar('page')
		? $url->getQueryVar('page')
		: 'home';
foreach($pages as $page => $title) {
	$url = new Url();
	$url->setQueryVar('page', $page);
	echo '<a '.($askedPage == $page ? 'class="selected"' : '').' href="'.$url.'">'.$title.'</a>';
}
?>