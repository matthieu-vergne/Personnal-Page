<?php
class HomePage extends InternalPage {
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
			'Google+' => Format::toHtmlUrl('https://www.google.com/+MatthieuVergne'),
			'LinkedIn' => Format::toHtmlUrl('http://www.linkedin.com/pub/matthieu-vergne/41/832/bb8'),
			'GitHub' => Format::toHtmlUrl('https://github.com/matthieu-vergne'),
		);
		foreach($data as $type => $value) {
			$content .= "<b>$type:</b> $value<br/>";
		}
		return $content;
	}
}
?>