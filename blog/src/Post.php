<?php

$settings_file = "src/Config.php";
include($settings_file);
include('markdown.php');


define('POSTS_DIR', $posts_dir);
define('FILE_EXT', $post_file_extension);
define('IMG_FILE_EXT', $post_image_file_extension); 
//define('BLOG_EMAIL', $blog_email);


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
		
			if(is_dir("./..".POSTS_DIR)){
				$post_dir = "./..".POSTS_DIR;
			} else {
				$post_dir = ".".POSTS_DIR;
			}
			
			//Define the post image file.
			$filePrefix = $this->before('.', $fileName);
			$this->image = "..".POSTS_DIR.$filePrefix.IMG_FILE_EXT;
			
			if (!file_exists($this->image))
			{
				$this->image = ".".POSTS_DIR."template.jpg";
			}
			
			// Define the post file.
			$fcontents = null;
			$filePath = null;
			try {
				if (file_exists($post_dir.$fileName))
				{
					$filePath = $post_dir.$fileName;
					$fcontents = file($filePath);
				} else {
					$filePath = ".".POSTS_DIR."template.txt";
					$fcontents = file(".".POSTS_DIR."template.txt");
				}
			} catch (Exception $e) {
				error_log($e);
			}
			
			if($fcontents != null) {
				// Define the post title.
				$this->title = Markdown($fcontents[0]);
				
				// Define the post author.
				$this->authorName = str_replace(array("\n", '-'), '', $fcontents[1]);
	
				// Define the post author Twitter account.
				$this->authorTwitter = str_replace(array("\n", '- '), '', $fcontents[2]);
	
				// Define the published date.
				$this->date = str_replace('-', '', $fcontents[3]);
				
				$this->tags = explode(",", str_replace('-', '', $fcontents[4]));;
				
				// Define the post intro.
				$this->intro = Markdown($fcontents[6]);
				
				// Define the post content
				$this->content = Markdown(join('', array_slice($fcontents, 6, filesize($filePath) -1)));
			}
			return $this;
	}
	

	/*-----------------------------------------------------------------------------------*/
	/* Get All Posts Function
	/*-----------------------------------------------------------------------------------*/
	function getAllPosts() {
		
		if(is_dir("./..".POSTS_DIR)){
			$post_dir = "./..".POSTS_DIR;
		} else {	
			$post_dir = ".".POSTS_DIR;
		}
		
		if($handle = opendir($post_dir)) {
	
			$files = array();

			while (false !== ($entry = readdir($handle))) {
				if(substr(strrchr($entry,'.'),1)==ltrim(FILE_EXT, '.')) {
					error_log("file name: ".$entry, 0);
					
					$post = $this->getPostByName($entry);
					
					$files[] = array('fname' => $entry,'post_image' => $post->image, 'post_title' => $post->title, 'post_author' => $post->authorName, 'post_author_twitter' => $post->authorTwitter,
							'post_date' => $post->date, 'post_tags' => $post->tags, 'post_intro' => $post->intro, 'post_content' => $post->content);
					
					$date = new DateTime($post->date, new DateTimeZone('UTC'));
					$post_dates[] = date_format($date, 'Ydm');
				}
			}

			if(!empty($files)){
				array_multisort($post_dates, SORT_DESC, $files);
			}
			closedir($handle);
				
			return $files;
	
		} else {
			return false;
		}
	}
	
	function getPostsByTag($tag) {
		$files = array();
		
		$posts = $this->getAllPosts();
		foreach ($posts as $post) {
			foreach ($post['post_tags'] as $key=>$value) {
				
				if(strcasecmp($tag, trim($value)) == 0) {
					$files[] = $post; 
				}
			}
		}
			
		return $files;
	}
	
}
	
?> 
		