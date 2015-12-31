<?php

$settings_file = "src/Config.php";
include($settings_file);
include('markdown.php');


define('POSTS_DIR', $posts_dir);
define('FILE_EXT', $post_file_extension);
define('IMG_FILE_EXT', $post_image_file_extension); 
define('BLOG_EMAIL', $blog_email);
define('BLOG_TWITTER', $blog_twitter);
define('BLOG_URL', $blog_url);
define('BLOG_TITLE', $blog_title);
define('META_DESCRIPTION', $meta_description);
define('INTRO_TITLE', $intro_title);
define('INTRO_TEXT', $intro_text);

class Post {
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
	/* Get All Posts Function
	 /*-----------------------------------------------------------------------------------*/
/*	
	function get_all_posts($options = array()) {
	
		if($handle = opendir(".".POSTS_DIR)) {
	
			$files = array();
			$filetimes = array();
	
			while (false !== ($entry = readdir($handle))) {
				if(substr(strrchr($entry,'.'),1)==ltrim(FILE_EXT, '.')) {
	
					// Define the post file.
					$fcontents = file(".".POSTS_DIR.$entry);
	
					// Define the post title.
					$post_title = $fcontents[0];//Markdown($fcontents[0]);
	
					$file_name = $this->before('.', $entry);
	
					$post_link = BLOG_URL.POSTS_DIR.$file_name.".html";
	
					// Define the post author.
					$post_author = str_replace(array("\n", '-'), '', $fcontents[1]);
	
					// Define the post author Twitter account.
					$post_author_twitter = str_replace(array("\n", '- '), '', $fcontents[2]);
	
					// Define the published date.
					$post_date = str_replace('-', '', $fcontents[3]);
	
					// Define the post category.
					$post_category = str_replace(array("\n", '-'), '', $fcontents[4]);
	
					// Early return if we only want posts from a certain category
					
					// Define the post status.
					$post_status = str_replace(array("\n", '- '), '', $fcontents[5]);
	
					// Define the post intro.
					$post_intro = Markdown($fcontents[7]);
	
					// Define the post content
					$post_content = Markdown($fcontents[8]);
	
					// Pull everything together for the loop.
					$files[] = array('fname' => $file_name, 'post_link' => $post_link, 'post_title' => $post_title, 'post_author' => $post_author, 'post_author_twitter' => $post_author_twitter, 'post_date' => $post_date, 'post_category' => $post_category, 'post_status' => $post_status, 'post_intro' => $post_intro, 'post_content' => $post_content);
					$post_dates[] = $post_date;
					$post_titles[] = $post_title;
					$post_authors[] = $post_author;
					$post_authors_twitter[] = $post_author_twitter;
					$post_categories[] = $post_category;
					$post_statuses[] = $post_status;
					$post_intros[] = $post_intro;
					$post_contents[] = $post_content;
				}
			}
	
			array_multisort($post_dates, SORT_DESC, $files);
			
			closedir($handle);
			
			return $files;
	
		} else {
			return false;
		}
	}
	
		function get_posts_for_category($category) {
		$category = trim(strtolower($category));
		//return $this->get_all_posts(array("category" => $category));
		return $this->getAllPosts();
	}
	
	public function getPosts() {
		$category = "Posting";
		return $this->get_posts_for_category($category);
	}
	*/
	
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
			$this->image = ".".POSTS_DIR.$filePrefix.IMG_FILE_EXT;

			// Define the post title.
			$this->title = str_replace(array("\n", '#'), '', $fcontents[0]);

			// Define the post author.
			$this->authorName = str_replace(array("\n", '-'), '', $fcontents[1]);

			// Define the post author Twitter account.
			$this->authorTwitter = str_replace(array("\n", '- '), '', $fcontents[2]);

			// Define the published date.
			$this->date = str_replace('-', '', $fcontents[3]);

			// Define the post intro.
			$this->intro = Markdown($fcontents[7]);

			// Define the post content
			$this->content = Markdown($fcontents[8]);
	
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
		