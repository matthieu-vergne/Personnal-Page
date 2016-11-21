<?php
class BlogPage extends InternalPage {
	public function getId() {
		return 'blog';
	}
	
	public function getMenuTitle() {
		return 'Blog';
	}
	
	private function expandEntryLinks($content) {
		$content = preg_replace_callback('#href="entry:([0-9]+)"#', function($matches) {
			$localUrl = Url::getCurrentUrl();
			$localUrl->setQueryVar('entry', $matches[1]);
			return 'href="'.$localUrl.'"';
		}, $content);
		
		return $content;
	}
	
	public function getContent() {
		$url = Url::getCurrentUrl();
		$entry = $url->hasQueryVar('entry') ? $url->getQueryVar('entry') : null;
		$path = "blog/$entry.html";
		if ($entry != null && file_exists($path)) {
			$content = file_get_contents($path);
			$start = strpos($content, "<body>");
			$stop = strpos($content, "</body>");
			if ($start === false || $stop === false) {
				throw new Exception("Impossible to get the content of blog entry ".$entry);
			} else {
				$content = substr($content, $start+6, $stop-$start-6);
				$content = $this->expandEntryLinks($content);
				return "<div id='blog'>$content</div>";
			}
		} else {
			$content = '<p>Coming soon.</p>';
			return $content;
		}
	}
}
?>