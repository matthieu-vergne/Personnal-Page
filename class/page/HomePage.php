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
		$content .= "<img src='$url' alt='Photo' id='photo'/>";
		
		$content .= "<h1>Contact Information</h1>";
		$data = array(
			"Surname" => "Matthieu",
			"Family name" => "Vergne",
			"Nationality" => "French",
			"LinkedIn" => Format::toHtmlUrl("http://www.linkedin.com/pub/matthieu-vergne/41/832/bb8"),
			"ResearchGate" => Format::toHtmlUrl("https://www.researchgate.net/profile/Matthieu_Vergne"),
			"OrcidID" => Format::toHtmlUrl("https://orcid.org/0000-0003-3740-7851"),
			"GitHub" => Format::toHtmlUrl("https://github.com/matthieu-vergne"),
			"Google+" => Format::toHtmlUrl("https://www.google.com/+MatthieuVergne"),
		);
		
		foreach($data as $type => $value) {
			$content .= "<b>$type:</b> $value<br/>";
		}
		
		$data = array(
			// Orange
			"matthieu.vergne@orange.com" => true,
			
			// Meritis
			"matthieu.vergne@meritis.fr" => true,
			
			// SII
			"mvergne@sophia.sii.fr" => false,
			"mvergne@sii.fr" => false,
			
			// NAIST
			"vergne@is.naist.jp" => false,
			
			// FBK
			"vergne@fbk.eu" => false,
			
			// UNITN
			"matthieu.vergne@unitn.it" => false,
			"matthieu.vergne@studenti.unitn.it" => false,
			"matthieu.vergne@ex-studenti.unitn.it" => false,
			"matthieu.vergne@alumni.unitn.it" => true,
			
			// G-INP
			"matthieu.vergne@grenoble-inp.org" => true,
		);
		$listValid = "";
		$listObsolete = "";
		ksort($data, SORT_NATURAL | SORT_FLAG_CASE);
		foreach($data as $email => $isValid) {
			if ($isValid) {
				$list = & $listValid;
			} else {
				$list = & $listObsolete;
			}
			$list .= "<li>$email</li>";
		}
		$buttonClass = "toggleButton";
		$buttonFunction = "toggle(\"obsoleteMails\", \"obsoleteMailsOn\", \"obsoleteMailsOff\")";
		$content .= "<p>You can contact me through my principal e-mail ".Format::toHtmlEmail("matthieu.vergne@gmail.com").". Other e-mails which are currently valid:</p>";
		$content .= "<ul id='otherMails'>$listValid</ul>";
		$content .= "<p>If you know me through another e-mail address, it is probably obsolete.</p>";
		$content .= "<div class='$buttonClass' onclick='$buttonFunction' id='obsoleteMailsOn'>Show obsolete e-mails</div>";
		$content .= "<div class='$buttonClass' onclick='$buttonFunction' id='obsoleteMailsOff' style='display: none'>Hide obsolete e-mails</div>";
		$content .= "<br/>";
		$content .= "<ul id='obsoleteMails' style='display: none'>$listObsolete</ul>";
		
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
