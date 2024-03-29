<?php
class Resource {
	public static function getResource($resourceId) {
		$files = glob('resource/'.$resourceId.'-*');
		if (count($files) > 1) {
			throw new Exception("Several resources have the same ID $resourceId: ".array_reduce($files, function($result, $item) {
				$file = basename($item);
				return $result == null ? $file : $result.', '.$file;
			}));
		} else if (count($files) < 1) {
			throw new Exception("No resource have the ID $resourceId.");
		} else {
			return new Resource($files[0]);
		}
	}
	
	private $path;
	
	public function __construct($path) {
		$this->path = $path;
	}
	
	public function getId() {
		$name = basename($this->path);
		$limit = strpos($name, '-');
		return intval(substr($name, 0, $limit));
	}
	
	public function getFilePath() {
		return $this->path;
	}
	
	public function getFileUrl() {
		return new Url($this->path);
	}
}
?>