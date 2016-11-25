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
		$path = $this->getCurrentEntryFile();
		if ($path != null && file_exists($path)) {
			$content = file_get_contents($path);
			$start = strpos($content, "<body");
			$stop = strpos($content, "</body>");
			if ($start === false || $stop === false) {
				throw new Exception("Impossible to get the content of blog entry ".$path);
			} else {
				$content = preg_replace("#.*<body[^>]*>(.*)</body>.*#is", "$1", $content);
				$content = $this->expandEntryLinks($content);
				Website::setTitle(preg_replace("#(.*<h1>)|(</h1>.*)#is", "", $content));
				return "<div id='blog'>$content</div>";
			}
		} else {
			$content = '<p>For the moment, this blog is mainly a place where I centralize questions of interest to me. Some might have proved answers, others not, some might be already published, others not. I will see later if some structure would be helpful, but for now each blog entry is expected to focus on a single question and to link to other entries focusing on related questions, a bit like Wikipedia but with question-driven links.</p>
			
			<p>Questions of interest:</p>
			<ul>
			<li><a href="entry:0">Can we use accuracy with unbalanced datasets?</a></li>
			</ul>';
			$content = $this->expandEntryLinks($content);
			return $content;
		}
	}
	
	public function getLastUpdateTime() {
		$file = $this->getCurrentEntryFile();
		if ($file === null) {
			return parent::getLastUpdateTime();
		} else {
			return filemtime($file);
		}
	}
	
	private function getCurrentEntryFile() {
		$url = Url::getCurrentUrl();
		$entry = $url->hasQueryVar('entry') ? $url->getQueryVar('entry') : null;
		if ($entry === null) {
			return null;
		} else {
			return "blog/$entry.html";
		}
	}
}
?>