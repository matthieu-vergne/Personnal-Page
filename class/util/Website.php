<?php
/*
	Global features for influencing other parts of the website.
*/

class Website {
	private static $title = null;
	
	public static function setTitle($title) {
		if (Website::$title === null) {
			Website::$title  = $title;
		} else {
			throw new Exception("The title has already been set to: ".Website::$title);
		}
	}
	
	public static function getTitle() {
		return Website::$title;
	}
	
	public static function hasTitle() {
		return Website::$title !== null;
	}
}
?>