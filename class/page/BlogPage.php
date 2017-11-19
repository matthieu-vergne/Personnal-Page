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
			I like teaching, I like research, and I like Java, so this blog is a bit of all of that.
			I mainly write technical posts, which might serve as material for research papers or Java projects, in a style which tries to be accessible to most people.
			I consider clarity and rigour as top priority requirements, so if you feel like something is hard to understand or not well proven/sourced, don\'t hesitate to contact me.
			</p>
			
			<h2>Java</h2>
			
			<p>
			I program in Java since 2009, and as a generalist I like to develop libraries which can be reused in many places.
			Consequently, I have some interest in general structures and methods, leading me to develop several projects (often small, but not always) that you can find on my <a href="https://github.com/matthieu-vergne?tab=repositories">GitHub account</a>.
			Now, the best way to make generic stuff is to ensure that it is usable everywhere, which is why I program in Open Source, and more precisely with the CC0 license (as much as possible).
			Additionally, if I find a project interesting enough, or if I think a lot about some concepts or methods that I use in these projects, I may write posts about them to share the idea in a less technical way than pure code.
			This is what the following list is about:
			</p>
			<ul>
			<li><a href="entry:18">When to instantiate/throw an exception in Java?</a></li>
			</ul>
			
			<p>
			Due to my deep interest in genericity, I am also writing a series of posts about <!--a href="entry:10"-->Advanced Generic Programming in Java<!--/a-->, an activity well suited for library developers but which is different from simply programming with Java generics.
			To some extents, this series started in October 2014, when I started to help improving the architecture of <a href="https://github.com/jMetal/jMetal">jMetal</a>, a project about metaheuristics (aka optimization algorithms, like hill climbing, genetic algorithms, and so on).
			Because I tend to write a lot of details (and because it is interesting, I guess) I received the suggestion of writing a book about it, which I found to be a good idea for better sharing.
			I am still participating in this project, but now I think it is time to gather all what I said in a proper compilation that other people can reuse for their own projects.
			These series is still a set of drafts only, so I don\'t give acces to it now (although hackers may easily find it {^_°}) but I already have some material and I would like to publish some stuff soon.
			I want to produce a reference on the topic, so feel free to send me an e-mail for any suggestion/feedback that you may have, whether it is about fixes, additions, disagreements, or anything else.
			Maybe a physical book will be produced out of it, it depends on how it turns out and the feedback I will get.
			</p>
			
			<h2>Research</h2>
			
			<p>
			Beside Java-related stuff, this blog is mainly a place where I centralize questions of interest to me, with a style that I think fits well with research (context-question-method-answer).
			Some might have proved answers, others not, some might be already published elsewhere (I cite them), others not.
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
		$entryID = $url->hasQueryVar('entry') ? $url->getQueryVar('entry') : null;
		if ($entryID === null) {
			return null;
		} else {
			$entries = glob("blog/$entryID-*.html");
			if (count($entries) == 0) {
				throw new Exception("No entry found for ID $entryID");
			} else if (count($entries) > 1) {
				throw new Exception("More than one entry found for ID $entryID: ".print_r($entries, true));
			} else {
				return $entries[0];
			}
		}
	}
}
?>