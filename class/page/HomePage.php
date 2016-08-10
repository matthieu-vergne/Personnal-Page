<?php
class HomePage extends InternalPage {
	public function getId() {
		return 'home';
	}
	
	public function getMenuTitle() {
		return 'Home';
	}
	
	public function getContent() {
		$content = "";
		
		$url = Resource::getResource(0)->getFileUrl();
		$content .= "<img src='$url' alt='Photo' style='float: right; max-width: 15%; margin-left: 1em; margin-bottom: 1em; margin-top: 1.5em;'/>";
		
		$content .= "<h1>Contact Information</h1>";
		$data = array(
			"Surname" => "Matthieu",
			"Family name" => "Vergne",
			"Nationality" => "French",
			"Google+" => Format::toHtmlUrl("https://www.google.com/+MatthieuVergne"),
			"LinkedIn" => Format::toHtmlUrl("http://www.linkedin.com/pub/matthieu-vergne/41/832/bb8"),
			"GitHub" => Format::toHtmlUrl("https://github.com/matthieu-vergne"),
		);
		foreach($data as $type => $value) {
			$content .= "<b>$type:</b> $value<br/>";
		}
		
		$content .= "<p>You can contact me through my principal e-mail ".Format::toHtmlEmail("matthieu.vergne@gmail.com").". Other e-mails can be used, but they may be obsolete, so pay attention:</p>";
		$data = array(
			"vergne@fbk.eu" => true,
			
			"matthieu.vergne@unitn.it" => false,
			"matthieu.vergne@studenti.unitn.it" => false,
			"matthieu.vergne@ex-studenti.unitn.it" => false,
			"matthieu.vergne@alumni.unitn.it" => true,
			
			"matthieu.vergne@grenoble-inp.org" => true,
		);
		$list = "";
		ksort($data, SORT_NATURAL | SORT_FLAG_CASE);
		foreach($data as $email => $isValid) {
			if ($isValid) {
				$list .= "<li>$email</li>";
			} else {
				$list .= "<li style='color: gray'>$email (obsolete)</li>";
			}
		}
		$content .= "<ul id='otherMails'>$list</ul>";
		
		$content .= "<h1>Short Bio</h1>";
		$content .= "<div class='quotes'>";
		$content .= "<blockquote>Know yourself.</blockquote> <span class='source'><a href='https://en.wikipedia.org/wiki/Know_thyself'>Delphic maxim</a></span>";
		$content .= "<blockquote>If you want something done right, do it yourself.</blockquote> <span class='source'><a href='https://en.wikipedia.org/wiki/Charles-Guillaume_%C3%89tienne'>Charles-Guillaume Étienne</a></span>";
		$content .= "<blockquote>What you do not wish done to you, do not do to others.</blockquote> <span class='source'><a href='https://en.wiktionary.org/wiki/silver_rule'>Silver Rule</a></span>";
		$content .= "</div>";
		$content .= "<p>Philosophically speaking, I could be considered shortly as a <a href='https://en.wikipedia.org/wiki/Relativism'>relativist</a>, <a href='https://en.wikipedia.org/wiki/Philosophical_skepticism'>skeptical</a>, <a href='https://en.wikipedia.org/wiki/Perfectionism_(philosophy)'>perfectionist</a>, <a href='https://en.wikipedia.org/wiki/Individualism'>individualist</a>, <a href='https://en.wikipedia.org/wiki/Anarchism'>anarchist</a>, and in particular an <a href='https://en.wikipedia.org/wiki/Epistemological_anarchism'>epistemological anarchist</a>. If you understand that I am a disorganised and rebellious guy who spends his time complaining about everything, I strongly recommend you to carefully read the associated links. I am rather strict in my organisation and methods, seeking for perfection for myself, but extremely open to other perspectives people may have, including brand new or globally rejected ones. The three citations above illustrate well my thinking: the first aims at understanding one's own values and capacities, the second establishes incentives for acting towards fulfilling these values through these capacities, and the last one establishes limits to not impair fulfillment for other people. I consider self-improvement as a top ability and every experience and exchange as an opportunity to improve it. So feel free to contact me. {^_°}</p>";
		$content .= "<p>Regarding my main activity, I am a scientific researcher with a strong interest in intelligence, and in particular in artificial intelligence (A.I.) due to my cursus in Computer Science. Like many, one of my dreams is to implement an artificial agent able to achieve any kind of activities at best of its own resources. For the ones who wonder how a scientist can be a relativist, I would answer that relativism is not <em>against</em> science, but rather <em>includes</em> it: a relativist can take a scientific perspective to write a scientific paper, and keep unscientific positions for other activities. Being an epistemological anarchist also does not mean that I consider globally recognised methods as useless, only that I consider any method as still perfectible (this is consequential to my skeptical side) and that no method should be rejected on the sole behalf of not being a globally accepted one.</p>";
		$content .= "<p></p>";
		
		return $content;
	}
}
?>