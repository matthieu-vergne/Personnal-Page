<?php
class Format {
	public static function toHtmlUrl($url, $text = null) {
		$text = $text === null ? $url : $text;
		return "<a href='$url'>$text</a>";
	}
	
	public static function toHtmlEmail($mail, $text = null) {
		$text = $text === null ? $mail : $text;
		return Format::toHtmlUrl("mailto:$mail", $text);
	}
}
?>