<?php
session_start();
?>
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top"  >
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header" >
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="<?php echo $header->blogURL?>">
                <img src="<?php echo $header->logo ?>" alt="" width="100">
            </div>
			
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse " >
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
						<?php if($_SESSION['valid']){ ?>                    
                        	<a href="logout.php" ><i class="fa fa-sign-out"></i> logout</a>
	                     <?php } else { ?>    
                        	<a href="login.php" ><i class="fa fa-sign-in"></i> login</a>
	                     <?php } ?>
                    </li>
                </ul>
				
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>