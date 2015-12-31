<?php
$settings_file = "src/Config.php";
include($settings_file);

define('BIO_DIR', $bio_dir);
define('BIO_TXT', $bio_txt);
define('BIO_HEADER', $bio_header);
define('BIO_FOTO', $bio_foto);


class Bio {
	private $image;
	private $foto;
	private $title;
	private $content;
	
	
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
	
	function getBio() {
	
		error_log("getBio ", 0);
	
		// Define the post file.
		$fcontents = file(".".BIO_DIR.BIO_TXT);
	
		//Define the bio image header file.
		$this->image = ".".BIO_DIR.BIO_HEADER;
	
		//Define the bio foto header file.
		$this->foto = ".".BIO_DIR.BIO_FOTO;
		
		// Define the post title.
		$this->title = str_replace(array("\n", '#'), '', $fcontents[0]);
	

		// Define the post content
		$this->content = Markdown($fcontents[1]);
	
		return $this;
	}
}

?>
