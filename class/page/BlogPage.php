<?php
define('ENTRY_SEP', '/');
class BlogPage extends InternalPage {
	public function getId() {
		return 'blog';
	}
	
	public function getMenuTitle() {
		return 'Blog';
	}
	
	private function expandEntryLinks($content) {
		// Relative to absolute entries
		$currentIDs = $this->getCurrentEntryIDs();
		if (count($currentIDs) == 0) {
			$resolver = function($matches) {
				throw new Exception("Cannot resolve relative entry on single entry: *-".$matches[1]);
			};
		} else {
			array_pop($currentIDs);
			$resolver = function($matches) use($currentIDs) {
				$absoluteIDs = implode(ENTRY_SEP, array_merge($currentIDs, array($matches[1])));
				if (sizeof($matches) > 2) {
					$absoluteIDs .= $matches[2];
				}
				return "href=\"entry:$absoluteIDs\"";
			};
		}
		$content = preg_replace_callback('~href="entry:\\.'.preg_quote(ENTRY_SEP).'(s?[0-9'.preg_quote(ENTRY_SEP).']+)(?:#([^"]*))?"~', $resolver, $content);
		
		// Absolute entries to valid links
		$content = preg_replace_callback('~href="entry:(s?[0-9'.preg_quote(ENTRY_SEP).']+)(?:#([^"]*))?"~', function($matches) {
			$localUrl = Url::getCurrentUrl();
			$localUrl->setQueryVar('entry', $matches[1]);
			if (sizeof($matches) > 2) {
				$localUrl->set(URL_FRAGMENT, $matches[2]);
			} else {
				// No fragment
			}
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
				return "<div id='blog' class='language-java'>$content</div>";
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
				<li><a href="entry:20">Proxy, decorator, adapter, façade, ... How to test a wrapper?</a></li>
				<li><a href="entry:s0/0">How to resolve the God object issue?</a></li>
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
			</ul>
			
			<h2>A.I.</h2>
			
			<p>
				I am also interested in Artificial Intelligence since a long time, more precisely high school, although I only had the opportunity to work seriously on it way later.
				Briefly, as I was doing research in a different field, I gathered information and participated in seminars related to A.I. in order to build my expertise on the topic.
				I was frustrated of how A.I. was going, especially with the presentation of Watson from IBM, which is basically a bunch of tools put together with a great amount of human tuning to make it work.
				For me, A.I. was not about "making artificial beings in an intelligent way", but about "making artificial beings which are intelligent".
			</p>
			<p>
				This frustration lead me to focus on the definition of intelligence which, as experts know, is far to reach a broad agreement.
				This seems to be the reason why people go their own way without caring much.
				But this lack of definition, for someone as rigorous as me, is just a no-go: I cannot work seriously on a topic without having a clear idea of the goal it is supposed to achieve.
				This feeling is reinforced daily by seeing how far away are the comprehension of A.I. from the general public and the actual tools made in the field.
				In order to fix that, I read about several stuff to try to figure out a definition that could bring everyone together.
				This research lead to my publication <quote>Artificial Intelligence and Expertise: the Two Faces of the Same Artificial Performance Coin</quote>, which you can find on my <a href="?page=papers">papers page</a>.
			</p>
			<p>
				As a summary, the point is that we know well what expertise is about, and research about intelligence is basically the same thing with one fundamental difference.
				Where expertise is all about specialization for high performance, intelligence is usually interpreted as a generic ability, a capacity to perform well in any domain.
				In order to have a reliable definition of intelligence, I took the definition of expertise and replaced its specialized aspect by a generic one.
				It lead me to interpret intelligence as <quote>having or showing domain-generic skill or knowledge because of what you have been taught or what you have experienced</quote>.
			</p>
			<p>
				With this basis, I could define an artificial intelligence as <quote>having or showing domain-generic processes or data which have been transferred to or generated by it</quote>.
				The main goal was then to understand well what genericity was about, since it was the main difference with expertise.
				Indeed, the overwhelming majority of what we produce in the A.I. field are artificial experts: highly specialized tools that perform very well in a single task at once.
				My thinking about genericity in a forma way is detailed in <a href="entry:13">one of my blog entries</a>.
				But since I am more familiar with genericity in terms of programming, I decided to give some focus on generic programming, as mentionned in the previous sections.
			</p>
			<p>
				Currently, I would design an artificial intelligence, or an artificial general intelligence (AGI) to use the current vocabulary, as the following:
			</p>
			<ul>
				<li>It has a knowledge graph of concepts and their relationships, where concepts and relationships are defined based on their own relationships with other concepts (with basic concepts to avoid the infinite regression) ;</li>
				<li>by interacting with its environment, the A.I. shall discover new concepts and relationships to represent its environment and itself ;</li>
				<li>by reasoning on this knowledge graph, the A.I. shall infer courses of actions to achieve specific goals ;</li>
				<li>by the cycle of reasoning and interacting, the A.I. shall validate or fix its knowledge graph ;</li>
			</ul>
			<p>
				The presence of the knowledge graph is a way to support explainability: it allows to use graph mapping techniques to understand the knowledge graph based on itss imilarity with other, human-made graphs.
				Machine learning, which is all the current hype, appears to me only as a good way to improve performance by driving (or replacing) familiar searches in the knowledge graph.
				Their should have processes to complete, clean, and optimize the knowledge graph, whether on the fly or through dedicated sessions (hey, machines can sleep too!).
				These processes include, among other things, the capacity to factor similar subgraphs, abstract subgraphs (core of the genericity), fix inconsistencies, and so on.
				I have a lot of resources on all of that, and I would like to gradually share them here.
				I still have a lot to work on, but if you know relevant works to consider or people to work with, feel free to suggest.
			</p>
			';
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
	
	private function getCurrentEntryIDs() {
		$url = Url::getCurrentUrl();
		$entryID = $url->hasQueryVar('entry') ? $url->getQueryVar('entry') : null;
		if ($entryID === null) {
			return array();
		} else {
			return explode(ENTRY_SEP, $entryID);
		}
	}
	
	private function getCurrentEntryFile() {
		$childIDs = $this->getCurrentEntryIDs();
		if (count($childIDs) == 0) {
			return null;
		} else {
			$path = "blog";
			$parentIDs = array();
			while (count($childIDs) > 0) {
				$currentID = array_shift($childIDs);
				$ext = preg_match("/^s/", $currentID) ? "" : ".html";
				$entries = glob("$path/$currentID-*$ext");
				if (count($entries) == 1) {
					$path = $entries[0];
					array_push($parentIDs, $currentID);
				} else {
					$logIDs = implode(ENTRY_SEP, array_merge($parentIDs, array($currentID)));
					if (count($entries) > 1) {
						throw new Exception("More than one entry found for ID $logIDs: ".print_r($entries, true));
					} else {
						throw new Exception("No entry found for ID $logIDs");
					}
				}
			}
			return $path;
		}
	}
}
?>