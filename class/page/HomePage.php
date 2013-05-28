<?php
class HomePage extends Page {
	public function getId() {
		return 'home';
	}
	
	public function getMenuTitle() {
		return 'Home';
	}
	
	public function getContent() {
		$url = Resource::getResource(0)->getFileUrl();
		$content = '<img src="'.$url.'" alt="Photo" style="float: left; max-width: 15%; margin-right: 1em; margin-bottom: 1em;"/>';
		$data = array(
			'Surname' => 'Matthieu',
			'Family name' => 'Vergne',
			'Nationality' => 'French',
			'E-mail' => Format::toHtmlEmail('matthieu.vergne@gmail.com'),
			'Google+' => Format::toHtmlUrl('https://plus.google.com/113987650579242368833'),
			'LinkedIn' => Format::toHtmlUrl('http://www.linkedin.com/pub/matthieu-vergne/41/832/bb8'),
			'ArnetMiner' => Format::toHtmlUrl('http://arnetminer.org/person/matthieu-vergne-14332114.html'),
			'GitHub' => Format::toHtmlUrl('https://github.com/matthieu-vergne'),
			'Interests' => 'programming, optimization, AI, mathematics, japanese animation',
			'Skills' => 'Object Oriented programming, optimization techniques, project management',
			'Current work' => 'PhD. student in Requirements Engineering, Fondazione Bruno Kessler (Trento, Italy)',
		);
		foreach($data as $type => $value) {
			$content .= "<b>$type:</b> $value<br/>";
		}
		return $content;
	}
}
?>