<!DOCTYPE html>
<?php
session_start(); 

include_once("../Manager/ConnectionManager.php");
include_once("../Manager/CourseManager.php");
include_once("../Manager/SessionManager.php");
include_once("../Manager/StudentManager.php");
$courseMgr = new CourseManager();
$sessionMgr = new SessionManager();
$lang = "en";
$sessionList=$sessionMgr->getCompletedSessions($lang);
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Admin | User</title>

        
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
                      <a href="document.php">
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
                      <a class="active" href="certify.php">
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
      <section id="main-content">
        <section class="wrapper site-min-height">
            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <table class="table table-striped table-advance table-hover">
                            <h4 style="padding-right: 10px"><i class="fa fa-angle-right"></i> Pending for Certifying </h4>
                            <h6>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Here is a list of sessions that had completed and yet to certify students </h6>
                            <thead>
                                <tr>
                                    <th> Course ID</th>
                                    <th> Course Name </th>
                                    <th> Session ID</th>
                                    <th> Certificate</th>
                                    <th> Show Classlist</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($sessionList as $session) {
                            ?>
                                <tr>
                                    <td><?=$session['courseID']?></td>
                                    <td><?=$session['courseName']?></td>
                                    <td><?=$session['sessionID']?></td>
                                    <td><?=$session['certificate']?></td>
                                    <td>
                                        <button class="btn btn-primary btn-xs" onclick="displayStudentList('<?=$session['courseID']?>','<?=$session['sessionID']?>')"> Show </button>
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

    
    <div class="modal fade" id="certifyModal">
        <div class="modal-dialog">
            <div class="modal-content" id="login_modal_content">
                <div class="modal-body">
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade active in">
                       <!-- <div class="tab-pane fade active in" id="add_address">-->
                            <fieldset>
                                <form class="form-horizontal style-form" id="certifyForm" action="../process_student.php" enctype="multipart/form-data" method="post">
                                    
                                </form>
                            </fieldset>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
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
    <script type="text/javascript" src="assets/js/certify.js"></script>
  </body>
</html>
