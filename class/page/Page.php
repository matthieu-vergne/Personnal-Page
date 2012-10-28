<?php
abstract class Page {
	public static function getAvailablePages() {
		$pages = array();
		foreach(glob('class/page/*.php') as $path) {
			$file = basename($path);
			$class = substr($file, 0, strlen($file)-4);
			if (is_subclass_of($class, get_class())) {
				$pages[] = new $class();
			} else {
				continue;
			}
		}
		return $pages;
	}
	
	public static function getDisplayedPage() {
		$url = Url::getCurrentUrl();
		try {
			$page = Page::getPage($url->hasQueryVar('page') ? $url->getQueryVar('page') : Page::getDefaultPageId());
		} catch(Exception $ex) {
			if (TEST_MODE_ACTIVATED) {
				throw $ex;
			} else {
				$page = Page::getPage(Page::getDefaultPageId());
			}
		}
		return $page;
	}
	
	public static function getDefaultPageId() {
		return 'home';
	}
	
	public static function getPage($id) {
		foreach(Page::getAvailablePages() as $page) {
			if ($page->getId() == $id) {
				return $page;
			} else {
				continue;
			}
		}
		throw new Exception("$id is not a known page.");
	}
	
	public abstract function getId();
	public abstract function getMenuTitle();
	public abstract function getContent();
	
	public function getLastUpdateTime() {
		$reflection = new ReflectionClass($this);
		return filemtime($reflection->getFileName());
	}
}
?> 
