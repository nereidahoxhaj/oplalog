<?php
session_start();

$settings_file = "Config.php";
include($settings_file);

define('POSTS_DIR', "../../".$posts_dir);

$target_dir = POSTS_DIR;
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "txt") {
	echo "Sorry, only JPG & txt files are allowed.";
	$uploadOk = 0;
}

// Check if image file is a actual image or fake image
/*if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
*/
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
	if ($_SESSION['valid']) {
	    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file) ) {
	        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
	        header('Refresh: 1; URL = ../admin.php');
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }
	} else {
		header('Refresh: 1; URL = ../login.php');
		echo "Sorry, your session is no longer valid.";
	}
}
?>