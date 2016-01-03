<?php

class Blog{
	private $bio;
	private $header;
	private $posts;
	private $tags;
	
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
	
	public function getTags() {
		if (empty($this->posts)) {
			$post = new Post;
			$this->posts = $post->getAllPosts();
		}
		foreach($this->posts as $p) {
			foreach ($p['post_tags'] as $tag) {
				$tagsArray[] = trim($tag);
			}
		}
		
		$this->tags = array_count_values($tagsArray);
		return $this->tags;
	}
}

?>