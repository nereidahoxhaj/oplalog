<?php
$settings_file = "src/Config.php";
include($settings_file);

define('HEADER_DIR', $header_dir);
define('HEADER_TXT', $header_txt);
define('HEADER_LOGO', $header_logo);

 class Header {
 	
 	private $logo;
 	private $slogan;
 	private $companyName;
 	
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
 		$this->companyName = str_replace(array("\n", '#'), '', $fcontents[0]);
 		
 		
 		// Define the post content
 		$this->slogan = $fcontents[1];
 		
 		// Define the post content
 		$this->logo = HEADER_DIR.HEADER_LOGO;
 		return $this;
 	}
 }
 
 ?>