<?php
class ThinkingPage extends Page {
	public function getId() {
		return 'thinking';
	}
	
	public function getMenuTitle() {
		return 'Personal Thinking';
	}
	
	public function getContent() {
		$content = '<p>Coming soon.</p>';
		return $content;
	}
}
?>