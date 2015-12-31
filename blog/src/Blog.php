<?php
class Blog{
	private $bio;
	private $header;
	private $posts;
	private $categories;
	
	
	public function __get($property) {
		if (property_exists($this, $property)) {
			return $this->$property;
		}
	}
	
	public function __set($property, $value) {
		if (property_exists($this, $property)) {
			$this->$property = $value;
		}
	
		return $this;
	}
	
	public function getPosts() {
		$post = new Post;
		return $post->getAllPosts();
		
	}
	
	public function getBio() {
		$bio = new Bio;
		return $bio->getBio();
	
	}
	
	public function getHeader() {
		$header = new Header;
		return $header->getHeader();
	
	}
}

?>