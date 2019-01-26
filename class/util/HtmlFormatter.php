<?php
class HtmlFormatter {
	public function toHtmlUrl($url, $text = null) {
		$text = $text === null ? $url : $text;
		return "<a href='$url'>$text</a>";
	}
	
	public function toHtmlEmail($mail, $text = null) {
		$text = $text === null ? $mail : $text;
		return $this->toHtmlUrl("mailto:$mail", $text);
	}
}
?>