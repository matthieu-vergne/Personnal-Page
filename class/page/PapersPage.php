<?php
class PapersPage extends Page {
	public function getId() {
		return 'papers';
	}
	
	public function getMenuTitle() {
		return 'Papers';
	}
	
	public function getContent() {
		$content = '<p>Coming soon.</p>';
		return $content;
	}
}
?>