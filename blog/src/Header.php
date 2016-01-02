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
 	private $blogURL;
 	private $blogEmail;
 	
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
 		
 		// Define the header file.
 		//$fcontents = file("./..".HEADER_DIR.HEADER_TXT);
 		if (file_exists("./..".HEADER_DIR.HEADER_TXT))
		{
			$fcontents = file("./..".HEADER_DIR.HEADER_TXT);
		} else {
			$fcontents = file("./".HEADER_DIR.HEADER_TXT);
		}
 		
 		// Define the header title.
 		$this->companyName = $fcontents[0];
 		
 		// Define the slogan 
 		$this->slogan = $fcontents[1];
 		
 		$this->blogURL = $fcontents[2];
 		
 		$this->blogEmail = $fcontents[3];
 		
 		// Define the logo
 		$this->logo = "./..".HEADER_DIR.HEADER_LOGO;
 		if (!file_exists($this->logo))
 		{
 			$this->logo = "./".HEADER_DIR.HEADER_LOGO;
 		}
 		
 		return $this;
 	}
 }
 
 ?>