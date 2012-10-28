<?php
$url = Url::getCurrentUrl();
$askedPage = $url->hasQueryVar('page')
		? $url->getQueryVar('page')
		: Page::getDefaultPageId();
$displayedPage = Page::getDisplayedPage();
foreach(Page::getAvailablePages() as $page) {
	$url = new Url();
	$url->setQueryVar('page', $page->getId());
	echo '<a '.($displayedPage == $page ? 'class="selected"' : '').' href="'.$url.'">'.$page->getMenuTitle().'</a>';
}
?>