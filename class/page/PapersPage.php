<?php
class PapersPage extends ExternalPage {
	public function getId() {
		return 'papers';
	}
	
	public function getMenuTitle() {
		return 'Papers';
	}
	
	public function getUrl() {
		return 'http://scholar.google.it/citations?user=qpUf7jQAAAAJ';
	}
}
?>