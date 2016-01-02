<!DOCTYPE html>
<html lang="en">

<?php 
include('src/Config.php');
include('src/Post.php');
include('src/Blog.php');
include('src/Header.php');
include('src/Bio.php');

$blog = new Blog;
$header = $blog->getHeader();

$post = new Post;
$post = $post->getPostByName($_GET["goto"]);

$bio = $blog->getBio();

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $header->companyName ?> | <?php echo $header->slogan ?></title>

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

<body id="page-top">

	<?php include 'mainNav.php';?>

    <section role="blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 " >
					<div class="row post" role="post" >
						<div class="col-lg-12  no-padding" >
							<img src="<?php echo $blog_url.$post->image ?>" class="img-responsive post-image" alt="">
						</div>	
						<div class="col-lg-12 ">					
							<div class="row spacer-20 meta" >
								<div class="col-lg-2">
									<img src="<?php echo $bio->foto?>" class="img-responsive author-image" alt="">
								</div>
								<div class="col-lg-3 col-lg-pull-1 spacer-20" >
									<span class=" "><?php echo $post->authorName ?></span>
								</div>
								<div class="col-lg-3 col-lg-pull-1 spacer-20 text-right" >
									<i class="fa fa-calendar "></i>
									<span ><?php echo $post->date  ?></span>
								</div>
								<div class="col-lg-4 col-lg-pull-1 spacer-20 text-right" >
									<i class="fa fa-comments "></i>
									<span>comments</span>
								</div>								
							</div>
								
							<div class=" spacer-20 separator"></div>
							<h2 class="section-heading padding-top-20"><?php echo $post->title ?></h2>
							<hr class="light">
							<p ><?php echo $post->intro ?></p>
							<p ><?php echo $post->content ?></p>
							<div class="spacer-20">
								<div class="row">
									<div class="col-lg-6 " >
										<a href="<?php echo $blog_url?>" class="btn btn-primary btn-xl page-scroll">Go Back</a>
									</div>
									<div class="col-lg-6 spacer-10 text-right" >
											<a href="https://plus.google.com/share?url=<?php echo $actual_link.'RenderPost.php?goto='.$post->fileName?>"><i class="fa fa-google-plus-square fa-2x"></i></a>
											<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $actual_link.'RenderPost.php?goto='.$post->fileName?>&title=Check%20this%20out!&summary=Interesting%20post&source="><i class="fa fa-linkedin-square fa-2x"></i></a>
											<a href="http://twitter.com/intent/tweet?url=<?php echo $actual_link.'RenderPost.php?goto='.$post->fileName?>&via=<?php echo $post->authorTwitter?>&text=check this out" ><i class="fa fa-twitter-square   fa-2x"></i></a>
											<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $actual_link.'RenderPost.php?goto='.$post->fileName?>"><i class="fa fa-facebook-square  fa-2x"></i></a>
											<a href="https://pinterest.com/pin/create/button/?url=<?php echo $actual_link.'RenderPost.php?goto='.$post->fileName?>&media=<?php echo $blog_url.$post->image?>&description=Interesting%20post"><i class="fa fa-pinterest-square fa-2x"></i></a>
									</div>
									
								</div>
							</div>	
							<div class="spacer-20 "></div>
						</div>	
					</div>	
					
					<div class="spacer-40" ></div>
									
	               </div>
				
				<?php include 'bio.php';?>
				<?php include 'categories.php';?>
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

</body>

</html>
