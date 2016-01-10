<?php
include('src/Config.php');
include('src/Post.php');
include('src/Bio.php');
include('src/Blog.php');
include('src/Header.php');

$blog = new Blog;
$header = $blog->getHeader();

define('LOGIN', $login);
define('PASSWORD', $password);

   ob_start();

   // error_reporting(E_ALL);
   // ini_set("display_errors", 1);
?>

<html lang = "en">
   
	<head>
          <title><?php echo $header->companyName.' | '.$header->slogan  ?></title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
	
	<!-- oplalog CSS -->
	<link rel="stylesheet" href="css/oplalog.css" type="text/css">

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="css/animate.min.css" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/creative.css" type="text/css">
      
      
   </head>
	
   <body>
   	<?php include 'mainNav.php';?>
    <section role="blog">
        <div class="container  form-signin">
            <div class="row">
                <div class="col-lg-12 " >      
				      
				      
				         <?php
				            $msg = '';
				            
				            if (isset($_POST['login']) && !empty($_POST['username']) 
				               && !empty($_POST['password'])) {
								
				               if ($_POST['username'] == LOGIN && 
				                  $_POST['password'] == PASSWORD) {
				                  $_SESSION['valid'] = true;
				                  $_SESSION['timeout'] = time();
				                  $_SESSION['username'] = LOGIN;
				                  
				                  echo 'Login successful';
				                  
				                  header('Refresh: 1; URL = admin.php');
				               }else {
				                  $msg = 'Wrong username or password';
				               }
				            }
				         ?>
				     
				         <form class = "form-signin" role = "form" 
				            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
				            ?>" method = "post">
				            <h2>Login</h2> 
				            <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
				            <input type = "text" class = "form-control" 
				               name = "username" placeholder = "username" 
				               required autofocus></br>
				            <input type = "password" class = "form-control"
				               name = "password" placeholder = "password" required>
				            <div class=" spacer-20 "></div>
				            <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
				               name = "login">Login</button>
				         </form>
							
   				 </div>	
			</div>
		</div>
	
    </section>
      
	<?php include 'footer.php';?>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/jquery.fittext.js"></script>
    <script src="js/wow.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/creative.js"></script>

	<link rel="stylesheet/less" type="text/css" href="less/creative.less" />
	<link rel="stylesheet/less" type="text/css" href="less/oplalog.less" />
	<script src="js/less.min.js" type="text/javascript"></script>      
   </body>
</html>