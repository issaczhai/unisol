<!DOCTYPE html>
<?php
session_start(); 

include_once("../Manager/ConnectionManager.php");
include_once("../Manager/CourseManager.php");
//include_once("../Manager/SessionManager.php");
$courseMgr = new CourseManager();
//$sessionMgr = new SessionManager();
$lang = "en";
$courseList = $courseMgr->getCourseList($lang);
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Admin | Document</title>

        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    
    
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
<!--    <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">    -->
    
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <script src="assets/js/chart-master/Chart.js"></script>
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      
      <?php
      include("header.php");
      include("addsession_modal.php");
      
      ?>
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a href="profile.html"><img src="assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
              	  <h5 class="centered">Admin Name</h5>
              	  	
                  <li class="mt">
                      <a href="index.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="course.php">
                          <i class="fa fa-desktop"></i>
                          <span>Courses</span>
                      </a>
                  </li>
                  
                  <li class="sub-menu">
                      <a class="active" href="document.php">
                          <i class="fa fa-desktop"></i>
                          <span>Documents</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="user.php">
                          <i class="fa fa-user"></i>
                          <span>Users</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="company.php">
                          <i class="fa fa-users"></i>
                          <span>Company</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-asterisk"></i>
                          <span>Function</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="blank.php">Blank Page</a></li>
                          <li><a  href="lock_screen.php">Lock Screen</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="certify.php">
                          <i class="fa fa-desktop"></i>
                          <span>Certifying</span>
                      </a>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
    <section id="main-content">
        <section class="wrapper site-min-height">
            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <table class="table table-striped table-advance table-hover">
                            <h4 style="padding-right: 10px"><i class="fa fa-angle-right"></i> Course List </h4>
                            
                            <thead>
                                <tr>
                                    <th> #</th>
                                    <th> Course ID</th>
                                    <th> Name</th>
                                    <th> Manage Course Documents</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 0;
                                foreach($courseList as $course){
                                    $count++;
                                ?>
                                <tr>
                                    <td><?=$count?></td>
                                    <td><?=$course['courseID']?></td>
                                    <td><?=$course['name']?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" onclick="location.href='./editdocuments.php?cID=<?=strval($course['courseID'])?>&lang=en'" data-toggle="modal" data-target="#addSessionModal"> English Version </button>
                                        <button type="button" class="btn btn-primary btn-sm" onclick="location.href='./editdocuments.php?cID=<?=strval($course['courseID'])?>&lang=cn'" data-toggle="modal" data-target="#addSessionModal"> Chinese Version </button>
                                    </td>
                                </tr>
                                 <?php
                                }
                                ?>
                                
                            </tbody>
                        </table>
                    </div><!-- /content-panel -->
                </div><!-- /col-md-12 -->
            </div><!-- /row -->

        </section><!--/wrapper -->
    </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      
      <?php
      include("footer.php");
      ?>
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="assets/js/jquery.ui.touch-punch.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>
    
  </body>
</html>
