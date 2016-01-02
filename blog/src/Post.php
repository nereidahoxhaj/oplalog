<?php

$settings_file = "src/Config.php";
include($settings_file);
include('markdown.php');


define('POSTS_DIR', $posts_dir);
define('FILE_EXT', $post_file_extension);
define('IMG_FILE_EXT', $post_image_file_extension); 
define('BLOG_EMAIL', $blog_email);
define('BLOG_TWITTER', $blog_twitter);

class Post {
	private $fileName;
	private $image;
	private $authorName;
	private $authorTwitter;
	private $date;
	private $title;
	private $intro;
	private $content;
	private $comments;
	
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
	
	function before ($that, $inthat)
	{
		return substr($inthat, 0, strpos($inthat, $that));
	}
	

	
	/*-----------------------------------------------------------------------------------*/
	/* Get Post by name
	 * 
	 * e.g. welcome.txt
	 */
	 /*-----------------------------------------------------------------------------------*/
	
	function getPostByName($fileName) {

			error_log("getPostByName: reading file name: ".$fileName, 0);
		
			// Define the post file.
			$fcontents = file(".".POSTS_DIR.$fileName);

			//Define the post image file.
			$filePrefix = $this->before('.', $fileName);
			$this->image = POSTS_DIR.$filePrefix.IMG_FILE_EXT;
			//var_dump($this->image);
			// Define the post title.
			//$this->title = str_replace(array("\n", '#'), '', $fcontents[0]);
			$this->title = Markdown($fcontents[0]);

			// Define the post author.
			$this->authorName = str_replace(array("\n", '-'), '', $fcontents[1]);

			// Define the post author Twitter account.
			$this->authorTwitter = str_replace(array("\n", '- '), '', $fcontents[2]);

			// Define the published date.
			$this->date = str_replace('-', '', $fcontents[3]);

			// Define the post intro.
			$this->intro = Markdown($fcontents[5]);
			
			
			// Define the post content
			//$this->content = Markdown($fcontents[8]);
			$this->content = Markdown(join('', array_slice($fcontents, 6, filesize(".".POSTS_DIR.$fileName) -1)));
			
			return $this;
	}
	

	/*-----------------------------------------------------------------------------------*/
	/* Get All Posts Function
	/*-----------------------------------------------------------------------------------*/
	function getAllPosts() {
	
		if($handle = opendir(".".POSTS_DIR)) {
	
			$files = array();
	
			while (false !== ($entry = readdir($handle))) {
				if(substr(strrchr($entry,'.'),1)==ltrim(FILE_EXT, '.')) {
					error_log("file name: ".$entry, 0);
					
					$post = $this->getPostByName($entry);
					
					$files[] = array('fname' => $entry,'post_image' => $post->image, 'post_title' => $post->title, 'post_author' => $post->authorName, 'post_author_twitter' => $post->authorTwitter,
							'post_date' => $post->date, 'post_intro' => $post->intro, 'post_content' => $post->content);
					
					$date = new DateTime($post->date, new DateTimeZone('UTC'));
					$post_dates[] = date_format($date, 'Ydm');
				}
			}
			
			array_multisort($post_dates, SORT_DESC, $files);
			
			closedir($handle);
				
			return $files;
	
		} else {
			return false;
		}
	}
	
	
}
	
?> 
		