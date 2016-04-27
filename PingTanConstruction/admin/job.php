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

    <title> Admin | Job </title>

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
include_once("template/header.php");
     
include_once("template/sidebar.php");
?>
      
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">            
              <!--overview start-->
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                            <li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
                            <li><i class="fa fa-bag"></i>Job</li>						  	
                    </ol>
                </div>
            </div>
              
             <div class="row">
                 <div class="col-lg-12">
                    <section class="panel">
                          <header class="panel-heading tab-bg-info">
                              <ul class="nav nav-tabs">
                                  <li class="active">
                                      <a data-toggle="tab" href="#job-list">
                                          Job List
                                      </a>
                                  </li>
                                  <li class="">
                                      <a data-toggle="tab" href="#post-job">
                                          Post Job
                                      </a>
                                  </li>
                              </ul>
                          </header>
                          <div class="panel-body" style="padding: 0">
                              <div class="tab-content">
                                  <div id="job-list" class="tab-pane active">
                                      <table class="table table-striped table-advance table-hover">
                                          <tbody class="job-list">
                                              <tr>
                                                  <th style="width:10%"> Job ID </th>
                                                  <th style="width:30%"> Position Name </th>
                                                  <th style="width:10%"> Type </th>
                                                  <th style="width:10%"> Category </th>
                                                  <th style="width:10%"> Post Date </th>
                                                  <th style="width:10%"> Last Edit </th>
                                                  <th style="width:20%"> Action </th>
                                              </tr>

                                              <tr class="job-row" style="display:none">
                                                  <td class="row-jobid"> 34521 </td>
                                                  <td class="row-jobname"> Architect Assurance</td>
                                                  <td class="row-type"> Full-Time </td>
                                                  <td class="row-category"> Assurance</td>
                                                  <td class="row-postdate"> 20-04-01</td>
                                                  <td class="row-lastedit"> 2016-04-25</td>
                                                  <td>
                                                      <div class="btn-group">
                                                          <button class="btn btn-primary edit-job-btn" data-toggle="modal" data-target="#editJobModal"><i class="icon_pencil_alt"></i></button>
                                                          <button class="btn btn-danger delete-job-btn" data-toggle="modal" data-target="#deleteJobModal"><i class="icon_close_alt2"></i></button>
                                                      </div>
                                                  </td>
                                              </tr>                              
                                          </tbody>
                                      </table>
                                  </div>
                                  
                                  <!-- edit-profile -->
                                  <div id="post-job" class="tab-pane">
                                    <section class="panel">                                          
                                          <div class="panel-body bio-graph-info">
                                              <form class="form-horizontal" role="form" action="../process_job.php" method="post" enctype="multipart/form-data">                                                  
                                                  <input type="hidden" name="operation" value="postjob">
                                                  <br>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Job Name</label>
                                                      <div class="col-lg-6">
                                                          <input type="text" class="form-control" maxlength="100" id="jobname" name="jobname" required>
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label"> Location </label>
                                                      <div class="col-lg-6">
                                                          <input type="text" class="form-control" id="location" name="location" maxlength="50" required>
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Type</label>
                                                      <div class="col-lg-6">
                                                            <select class="form-control m-bot15" id="type" name="type" required>
                                                                <option value="Full-Time">Full-Time</option>
                                                                <option value="Part-Time">Part-Time</option>
                                                            </select>
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label"> Category </label>
                                                      <div class="col-lg-6">
                                                          <input type="text" class="form-control" id="category" name="category" maxlength="50" required>
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label"> Job Description </label>
                                                      <div class="col-lg-6">
                                                          <textarea id="job_description" name="job_description" rows="4" cols="50" class="form-control" required></textarea>
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Qualification</label>
                                                      <div class="col-lg-6 qualification-div">
                                                          <input type="text" class="form-control" id="qualification" name="qualification[]" multiple required>
                                                      </div>
                                                      <div class="col-lg-2 add-qualification-btn-div">
                                                          <button class="btn btn-primary add-qualification-btn" type="button"><i class="icon_plus"></i></button>
                                                          <button class="btn btn-danger delete-qualification-btn" type="button"><i class="icon_minus-06"></i></button>
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Offer</label>
                                                      <div class="col-lg-6 offer-div">
                                                          <input type="text" class="form-control" id="offer" name="offer[]" multiple required>
                                                      </div>
                                                      <div class="col-lg-2 add-offer-btn-div">
                                                          <button class="btn btn-primary add-offer-btn" type="button"><i class="icon_plus"></i></button>
                                                          <button class="btn btn-danger delete-offer-btn" type="button"><i class="icon_minus-06"></i></button>
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label"> Contact Information </label>
                                                      <div class="col-lg-6">
                                                          <textarea id="contact" name="contact" rows="4" cols="50" class="form-control"></textarea>
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <div class="col-lg-offset-2 col-lg-10">
                                                          <button type="submit" class="btn btn-primary">Add</button>
                                                          <button type="reset" class="btn btn-warning">Reset</button>
                                                      </div>
                                                  </div>
                                              </form>
                                          </div>
                                      </section>
                                  </div>
                                  
                                  <?php
                                  include("template/editModal.php");
                                  ?>
                              </div>
                          </div>
                      </section>
                 </div>
              </div>
              
            

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
        <script src="../js/jobAdmin.js"></script>

  </body>
</html>