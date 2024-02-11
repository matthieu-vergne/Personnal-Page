<?php
class HomePage extends InternalPage {
	public function getId() {
		return 'home';
	}
	
	public function getMenuTitle() {
		return 'Home';
	}
	
	public function getContent() {
		$formatter = new HtmlFormatter();
		$formatUrl = function($url) use($formatter) { return $formatter->toHtmlUrl($url); };
		$formatEmail = function($email) use($formatter) { return $formatter->toHtmlEmail($email); };
	
		$content = "";
		
		$url = Resource::getResource(0)->getFileUrl();
		$content .= "<img src='$url' alt='Photo' id='photo'/>";
		
		$content .= "<h1>Contact Information</h1>";
		$data = array(
			"Surname" => "Matthieu",
			"Family name" => "Vergne",
			"Nationality" => "French",
			"LinkedIn" => $formatUrl("http://www.linkedin.com/pub/matthieu-vergne/41/832/bb8"),
			"ResearchGate" => $formatUrl("https://www.researchgate.net/profile/Matthieu_Vergne"),
			"Google Scholar" => $formatUrl("https://scholar.google.com/citations?user=qpUf7jQAAAAJ"),
			"OrcidID" => $formatUrl("https://orcid.org/0000-0003-3740-7851"),
			"GitHub" => $formatUrl("https://github.com/matthieu-vergne"),
		);
		
		foreach($data as $type => $value) {
			$content .= "<b>$type:</b> $value<br/>";
		}
		
		$isEffective = true;
		$isObsolete = false;
		$data = array(// Don't share professional e-mails out of research ones
			// NAIST
			"vergne@is.naist.jp" => $isObsolete,
			
			// FBK
			"vergne@fbk.eu" => $isObsolete,
			
			// UNITN
			"matthieu.vergne@unitn.it" => $isObsolete,
			"matthieu.vergne@studenti.unitn.it" => $isObsolete,
			"matthieu.vergne@ex-studenti.unitn.it" => $isObsolete,
			"matthieu.vergne@alumni.unitn.it" => $isObsolete,
			
			// G-INP
			"matthieu.vergne@grenoble-inp.org" => $isEffective,
		);
		$listEffective = "";
		$listObsolete = "";
		ksort($data, SORT_NATURAL | SORT_FLAG_CASE);
		foreach($data as $email => $isEffective) {
			if ($isEffective) {
				$list = & $listEffective;
			} else {
				$list = & $listObsolete;
			}
			$list .= "<li>$email</li>";
		}
		$buttonClass = "toggleButton";
		$buttonFunction = "toggle(\"obsoleteMails\", \"obsoleteMailsOn\", \"obsoleteMailsOff\")";
		$content .= "<p>You can contact me through my principal e-mail ".$formatEmail("matthieu.vergne@gmail.com").". Other e-mails which are currently valid:</p>";
		$content .= "<ul id='otherMails'>$listEffective</ul>";
		$content .= "<p>If you know me through another e-mail address, it is probably obsolete.</p>";
		$content .= "<div class='$buttonClass' onclick='$buttonFunction' id='obsoleteMailsOn'>Show obsolete e-mails</div>";
		$content .= "<div class='$buttonClass' onclick='$buttonFunction' id='obsoleteMailsOff'>Hide obsolete e-mails</div><script>toggle('obsoleteMailsOff');</script>";
		$content .= "<br/>";
		$content .= "<ul id='obsoleteMails'>$listObsolete</ul><script>toggle('obsoleteMails');</script>";
		
		$content .= "<h1>Short Bio</h1>";
		$content .= "<div class='quotes'>";
		$content .= "<blockquote>Know thyself.</blockquote> <span class='source'><a href='https://en.wikipedia.org/wiki/Know_thyself'>Delphic maxim</a></span>";
		$content .= "<blockquote>If you want something done right, do it yourself.</blockquote> <span class='source'><a href='https://en.wikipedia.org/wiki/Charles-Guillaume_%C3%89tienne'>Charles-Guillaume Étienne</a></span>";
		$content .= "<blockquote>What you do not wish done to you, do not do to others.</blockquote> <span class='source'><a href='https://en.wiktionary.org/wiki/silver_rule'>Silver Rule</a></span>";
		$content .= "</div>";
		$content .= "<p>Philosophically speaking, I could be considered shortly as a <a href='https://en.wikipedia.org/wiki/Relativism'>relativist</a>, <a href='https://en.wikipedia.org/wiki/Philosophical_skepticism'>skeptical</a>, <a href='https://en.wikipedia.org/wiki/Perfectionism_(philosophy)'>perfectionist</a>, <a href='https://en.wikipedia.org/wiki/Individualism'>individualist</a>, <a href='https://en.wikipedia.org/wiki/Anarchism'>anarchist</a>, and in particular an <a href='https://en.wikipedia.org/wiki/Epistemological_anarchism'>epistemological anarchist</a>. If you understand that I am a disorganised and rebellious guy who spends his time complaining about everything, I strongly recommend you to carefully read the associated links. I am rather strict in my organisation and methods, seeking for perfection for myself, but extremely open to other perspectives people may have, including brand new or globally rejected ones. The three citations above illustrate well my thinking: the first aims at understanding one's own values and capacities, the second establishes incentives for acting towards fulfilling these values through these capacities, and the last one establishes limits to not impair fulfillment for other people. I consider self-improvement as a top ability and every experience and exchange as an opportunity to improve it. So feel free to contact me. {^_°}</p>";
		$content .= "<p>Regarding my main activities, I am double-hatted: as a software developer &mdash;particularly in Java&mdash; and as a scientific researcher.</p>";
		$content .= "<p>As a software developer I am particularly interested in automation, with a strong emphasis on good designs. More precisely, I am a proponent of the triplet <q>Make it work, make it right, make it fast.</q> In my interpretation: make it pass the tests in a way or another, then improve it for easy maintainance (especially by other people), and finally optimize it to improve the user experience. Methodologically, the first step is the minimum, and stopping there is justified only if (1) we are in an emergency and (2) we dedicate some time later to reach the next step. The next step should be the target for any nominal delivery. The last step should be done only when you do have the metrics to do so (no premature optimization) and the requirements motivate it.</p>";
		$content .= "<p>As a scientific researcher I have a strong interest in intelligence, particularly in artificial intelligence (A.I.) due to my cursus in Computer Science. Like many, one of my dreams is to implement an artificial agent able to achieve any kind of activities at best of its own resources. For the ones who wonder how a scientist can be a relativist, I would answer that relativism is not <em>against</em> science, but rather <em>includes</em> it: a relativist can take a scientific perspective to write a scientific paper, and keep unscientific positions for other activities. Being an epistemological anarchist also does not mean that I consider globally recognised methods as useless, only that I consider any method as still perfectible (this is consequential to my skeptical side) and that no method should be rejected on the sole behalf of not being a globally accepted one.</p>";
		$content .= "<p></p>";
		
		return $content;
	}
}
?>
