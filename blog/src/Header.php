<?php
$settings_file = "src/Config.php";
include($settings_file);

define('HEADER_DIR', $header_dir);
define('HEADER_TXT', $header_txt);

 class Header {
 	
 	private $logo;
 	private $slogan;
 	private $image;
 	
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
 	
 	function getHeader() {
 		
 		error_log("getHeader ", 0);
 		
 		// Define the post file.
 		$fcontents = file(".".HEADER_DIR.HEADER_TXT);
 		
 		
 		// Define the post title.
 		$this->logo = str_replace(array("\n", '#'), '', $fcontents[0]);
 		
 		
 		// Define the post content
 		$this->slogan = Markdown($fcontents[1]);
 		
 		return $this;
 	}
 }
 
 ?>