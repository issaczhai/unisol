<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title> Projects </title>

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
                        <li><i class="fa fa-laptop"></i>Project</li>						  	
                    </ol>
                </div>
            </div>
              
            <!--page start-->
            <div class="row">
                 <div class="col-lg-12">
                    <section class="panel">
                          <header class="panel-heading tab-bg-info">
                              <ul class="nav nav-tabs">
                                  <li class="active">
                                      <a data-toggle="tab" href="#project-list">
                                          Project List
                                      </a>
                                  </li>
                                  <li class="">
                                      <a data-toggle="tab" href="#add-project">
                                          Add Project
                                      </a>
                                  </li>
                              </ul>
                          </header>
                          <div class="panel-body" style="padding: 0">
                              <div class="tab-content">
                                  <div id="project-list" class="tab-pane active">
                                      <table class="table table-striped table-advance table-hover">
                                          <tbody class="project-list">
                                              <tr>
                                                  <th> # </th>
                                                  <th> Project Name </th>
                                                  <th> End Date</th>
                                                  <th> Value </th>
                                                  <th> Scope of Work</th>
                                                  <th> Client </th>
                                                  <th> Status </th>
                                                  <th> Action </th>
                                              </tr>

                                              <tr class="project-row" style="display:none">
                                                  <td class="row-count"> 1 </td>
                                                  <td class="row-projectName"> Project I Love You</td>
                                                  <td class="row-endDate">2011-02-08</td>
                                                  <td class="row-value">$12,560,000</td>
                                                  <td class="row-scopeOfWork"> Ar</td>
                                                  <td class="row-client">Issac CHak Pte Ltd</td>
                                                  <td class="row-status">Completed</td>
                                                  <td>
                                                      <div class="btn-group">
                                                          <button class="btn btn-primary edit-project-info-btn" data-toggle="modal" data-target="#editInfoModal"><i class="icon_pencil_alt"></i></button>
                                                          <button class="btn btn-info edit-project-photo-btn" data-toggle="modal" data-target="#editPhotoModal"><i class="icon_image"></i></button>
                                                          <button class="btn btn-danger delete-project-btn" data-toggle="modal" data-target="#deleteProjectModal"><i class="icon_close_alt2"></i></button>
                                                      </div>
                                                  </td>
                                              </tr>                              
                                          </tbody>
                                      </table>
                                  </div>
                                  
                                  <!-- edit-profile -->
                                  <div id="add-project" class="tab-pane">
                                    <section class="panel">                                          
                                          <div class="panel-body bio-graph-info">
                                              <form class="form-horizontal" role="form" action="../process_project.php" method="post" enctype="multipart/form-data">                                                  
                                                  <input type="hidden" name="operation" value="addProject">
                                                  <br>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Project Name</label>
                                                      <div class="col-lg-6">
                                                          <input type="text" class="form-control" maxlength="100" id="projectName" name="projectName" required>
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Completion Date(Estimated)</label>
                                                      <div class="col-lg-6">
                                                          <input type="text" class="form-control" id="endDate" name="endDate" placeholder="eg. yyyy-mm" maxlength="20" required>
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Value (Not displayed)</label>
                                                      <div class="col-lg-6">
                                                          <input type="text" class="form-control" maxlength="16" id="value" name="value" required>
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Scope of Work</label>
                                                      <div class="col-lg-6">
                                                          <input type="text" class="form-control" maxlength="100" id="scopeOfWork" name="scopeOfWork" required>
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Contract</label>
                                                      <div class="col-lg-6">
                                                          <input type="text" class="form-control" id="contract" name="contract" required>
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Client</label>
                                                      <div class="col-lg-6">
                                                          <input type="text" class="form-control" maxlength="100" id="client" name="client" required>
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Photo</label>
                                                      <div class="col-lg-6">
                                                          <input type="file" class="form-control" id="photo" name="photo[]" multiple required>
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Status</label>
                                                      <div class="col-lg-6">
                                                            <select class="form-control m-bot15" id="status" name="status" required>
                                                                <option value="Upcoming">Upcoming</option>
                                                                <option value="Ongoing">Ongoing</option>
                                                                <option value="Completed">Completed</option>
                                                            </select>
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
        <script src="../js/projectsAdmin.js"></script>
  </body>
</html>
