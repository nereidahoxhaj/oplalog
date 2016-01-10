<!DOCTYPE html>
<html lang="en">

<?php
include('src/Config.php');
include('src/Post.php');
include('src/Bio.php');
include('src/Blog.php');
include('src/Header.php');

$blog = new Blog;
$bio = $blog->getBio(); 
$header = $blog->getHeader();

?>


<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
	<?php include 'mainNav.php';?>
    <section role="blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 " >
					<div class="row post" role="post" >
							<div class="col-lg-12  no-padding" >
								<img src="blog-config/post/upload.png" class="img-responsive post-image" alt="" >
							</div>	
							<div class="col-lg-12 ">					
								<div class=" spacer-20 separator"></div>

								<h2 class="section-heading padding-top-20">Upload Post</h2>
								<hr class="light">
								<p >Upload here your new post</p>
								
								<div class="spacer-20">
									<div class="row">
										<div class="col-lg-6 " >
											<form action="src/upload.php" method="post" enctype="multipart/form-data">
												<input type="file" name="fileToUpload" id="fileToUpload" >
												<br>
												<input type="submit" value="Upload" name="submit" class="btn btn-primary btn-xl ">
											</form>
										</div>
										
									</div>
								</div>	
								<div class="spacer-20 "></div>
							</div>	
					</div>	
						
					<div class="spacer-40" ></div>               
				</div>	
				<?php include 'bio.php';?>	
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