<?php
abstract class Page {
	public static function getAvailablePages() {
		$pages = array();
		foreach(glob('class/page/*.php') as $path) {
			$file = basename($path);
			$className = substr($file, 0, strlen($file)-4);
			$class = new ReflectionClass($className);
			
			if ($class->isSubclassOf(get_class()) && $class->isInstantiable()) {
				$pages[] = new $className();
			} else {
				continue;
			}
		}
		
		usort($pages, function(Page $a, Page $b) {
			if (strcmp($a->getId(), Page::getDefaultPageId()) == 0) {
				return -1;
			} else if (strcmp($b->getId(), Page::getDefaultPageId()) == 0) {
				return 1;
			} else {
				return strcmp($a->getMenuTitle(), $b->getMenuTitle());
			}
		});
		
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
	
	public function getLastUpdateTime() {
		$reflection = new ReflectionClass($this);
		return filemtime($reflection->getFileName());
	}
}
?> 
