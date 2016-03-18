<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title> Home </title>

    <!-- Bootstrap CSS -->    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />    

    <!-- Custom styles -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />	
	<link href="css/jquery-ui-1.10.4.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
      <script src="js/lte-ie7.js"></script>
    <![endif]-->
  </head>

  <body>
  <!-- container section start -->
  <section id="container" class="">
     <?php
     include("template/protect.php");
     
     include("template/header.php");
     
     include("template/sidebar.php");
     ?>
      
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">            
              <!--overview start-->
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
                    <ol class="breadcrumb">
                            <li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
                            <li><i class="fa fa-laptop"></i>Dashboard</li>						  	
                    </ol>
                </div>
            </div>
              
            <div class="row">
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box blue-bg">
						<i class="fa fa-cloud-download"></i>
						<div class="count">6.674</div>
						<div class="title">Download</div>						
					</div><!--/.info-box-->			
				</div><!--/.col-->
				
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box brown-bg">
						<i class="fa fa-shopping-cart"></i>
						<div class="count">7.538</div>
						<div class="title">Purchased</div>						
					</div><!--/.info-box-->			
				</div><!--/.col-->	
				
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box dark-bg">
						<i class="fa fa-thumbs-o-up"></i>
						<div class="count">4.362</div>
						<div class="title">Order</div>						
					</div><!--/.info-box-->			
				</div><!--/.col-->
				
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box green-bg">
						<i class="fa fa-cubes"></i>
						<div class="count">1.426</div>
						<div class="title">Stock</div>						
					</div><!--/.info-box-->			
				</div><!--/.col-->
				
            </div><!--/.row-->
		
            
		  
		  <!-- Today status end -->
			
              
				
			<div class="row">
               	
                            <div class="col-md-3">

                                    <div class="social-box facebook">
                                            <i class="fa fa-facebook"></i>
                                            <ul>
                                                    <li>
                                                            <strong>256k</strong>
                                                            <span>friends</span>
                                                    </li>
                                                    <li>
                                                            <strong>359</strong>
                                                            <span>feeds</span>
                                                    </li>
                                            </ul>
                                    </div><!--/social-box-->
                            </div>
				
              </div>

                    
                   
                <!-- statics end -->
              
            

          </section>
      </section>
      <!--main content end-->
  </section>
  <!-- container section start -->

    <!-- javascripts -->
    <script src="js/jquery.js"></script>
	<script src="js/jquery-ui-1.10.4.min.js"></script>
    <script src="js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
    <!-- bootstrap -->
    <script src="js/bootstrap.min.js"></script>
    <!-- nice scroll -->
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>

    
   
    <!--custome script for all page-->
    <script src="js/scripts.js"></script>
    <!-- custom script for this page-->
	<script src="js/jquery.autosize.min.js"></script>
	<script src="js/jquery.placeholder.min.js"></script>
	<script src="js/morris.min.js"></script>
	<script src="js/jquery.slimscroll.min.js"></script>
 

  </body>
</html>
