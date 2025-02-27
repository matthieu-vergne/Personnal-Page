<?php
class Toc {
	
	public static $root = "<toc>";
	
	private $id;
	private $title;
	private $children;
	
	public function __construct($id, $title) {
		$this->id = $id;
		$this->title = $title;
		$this->children = array();
	}
	
	public function from($id) {
		$remaining = array();
		$remaining = array_merge($remaining, $this->children);
		while(count($remaining) > 0) {
			$child = array_shift($remaining);
			if ($child->id === $id) {
				return $child;
			} else {
				$remaining = array_merge($remaining, $child->children);
			}
		}
		throw new Exception("Entry not found: ".$id);
	}
	
	public function formatEntries() {
		$content = "";
		foreach($this->children as $child) {
			$content .= '<li>';
			$content .= '<a href="#'.$child->id.'">'.$child->title.'</a>';
			$content .= $child->formatEntries();
			$content .= '</li>';
		}
		return "<ol>$content</ol>";
	}
	
	public static function extractFrom($content) {
		$root = new Toc(Toc::$root, "ToC");
		// TODO Extract all tocs
		$root->children["aaa"] = new Toc("aaa", "AAA");
		$root->from("aaa")->children["refactoring"] = new Toc("refactoring", "Refacto");
		$root->from("refactoring")->children["refA"] = new Toc("refA", "REFA");
		$root->from("refA")->children["refA1"] = new Toc("refA1", "REFA1");
		$root->from("refA")->children["refA2"] = new Toc("refA2", "REFA2");
		$root->from("refactoring")->children["refB"] = new Toc("refB", "REFB");
		$root->from("refB")->children["refB1"] = new Toc("refB1", "REFB1");
		$root->from("refB")->children["refB2"] = new Toc("refB2", "REFB2");
		return $root;
	}
}
?>
