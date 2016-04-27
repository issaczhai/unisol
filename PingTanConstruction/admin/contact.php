<?php
session_start();
include("template/protect.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title> Contact </title>

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
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
                        <li><i class="fa fa-phone"></i>Contact</li>						  	
                    </ol>
                </div>
            </div>
              
            <div class="row">
                <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             Contact Info
                          </header>
                          <div class="panel-body">
                              <form class="form-horizontal " method="post" action="../process_contact.php">
                                  <input type="hidden" class="form-control" name="operation" value="update">
                                  <div class="form-group">
                                      <label class="col-sm-1 control-label">Address</label>
                                      <div class="col-sm-7">
                                          <input type="text" class="form-control" id="address" name="address">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-1 control-label">Freephone</label>
                                      <div class="col-sm-7">
                                          <input type="text" class="form-control" id="freephone" name="freephone">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-1 control-label">Telephone</label>
                                      <div class="col-sm-7">
                                          <input type="text" class="form-control" id="telephone" name="telephone">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-1 control-label">Fax</label>
                                      <div class="col-sm-7">
                                          <input type="text" class="form-control" id="fax" name="fax">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-1 control-label">Email</label>
                                      <div class="col-sm-7">
                                          <input type="text" class="form-control" id="email" name="email">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-1 control-label"></label>
                                      <div class="col-sm-7">
                                          <button type="submit" class="btn btn-primary">Update</button>
                                      </div>
                                  
                                  </div>
                              </form>
                          </div>
                      </section>
                  </div>	
            </div><!--/.row-->
	
              
            

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
        <script src="../js/cookie.js"></script>
        <script src="../js/pingtan.js"></script>
        <script src="../js/request.js"></script>
        <script src="../js/service.js"></script>

  </body>
</html>