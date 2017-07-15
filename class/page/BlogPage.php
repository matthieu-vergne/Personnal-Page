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
	
	private function expandLocalLinks($content) {
		$content = preg_replace_callback('/(src|href)="([^"?#]+)([?#][^"]*)?"/', function($matches) {
			$tag = $matches[1];
			$url = $matches[2];
			$localUrl = "blog/".$url;
			if (file_exists($localUrl)) {
				$url = $localUrl;
			} else {
				// keep current URL
			}
			$query = isset($matches[3]) ? $matches[3] : "";
			return $tag.'="'.$url.$query.'"';
		}, $content);
		
		return $content;
	}
	
	public function getContent() {
		$path = $this->getCurrentEntryFile();
		if ($path != null && file_exists($path)) {
			$content = file_get_contents($path);
			$start = strpos($content, "<body");
			$stop = strrpos($content, "</body>");
			if ($start === false || $stop === false) {
				throw new Exception("Impossible to get the content of blog entry ".$path);
			} else {
				$start = strpos($content, ">", $start)+1;
				$content = substr($content, $start, $stop-$start);
				$content = $this->expandEntryLinks($content);
				$content = $this->expandLocalLinks($content);
				Website::setTitle(preg_replace("#(.*<h1>)|(</h1>.*)#is", "", $content));
				return "<div id='blog'>$content</div>";
			}
		} else {
			$content = '
			<p>
			I program in Java since 2009, and as a generalist I like to develop libraries which can be reused in many places, as my <a href="https://github.com/matthieu-vergne?tab=repositories">GitHub repositories</a> may show.
			Since October 2014, I use all my experience to help improving the architecture of <a href="https://github.com/jMetal/jMetal">jMetal</a>, a participation that lead some people to suggest me to write a book, which I found to be a good idea for better sharing.
			Consequently, I am writing a series of posts about <a href="entry:10">Advanced Generic Programming in Java</a>, an activity well suited for library developers but which is different from programming with Java generics.
			These posts are still drafts, but I make them available for interested people to check them out and suggest improvements or additions, so feel free to contact me directly if you feel concerned.
			I try not to restrict to my own perspective, but really to produce a reference on the topic, so feel free to send me some e-mails for any feedback you may have (fix, addition, disagreements, etc.).
			Maybe a physical book will be produced out of it, it depends on how it turns out and the feedback I will get.
			</p>
			
			<p>
			Putting aside this series, this blog is mainly a place where I centralize questions of interest to me.
			Some might have proved answers, others not, some might be already published, others not.
			I will see later if some structure would be helpful, but for now each blog entry is expected to focus on a single question and to link to other entries focusing on related questions, a bit like Wikipedia but with question-driven links:
			</p>
			<ul>
			<li><a href="entry:0">Can we use accuracy with unbalanced datasets?</a></li>
			<li><a href="entry:13">How to formalise generic/specific?</a></li>
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