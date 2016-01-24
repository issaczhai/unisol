<!DOCTYPE html>
<?php
session_start(); 

include_once("../Manager/ConnectionManager.php");
include_once("../Manager/StudentStatusManager.php");
include_once("../Manager/StudentManager.php");
$studentMgr = new StudentManager();

$studentList = $studentMgr->getStudentList();

function getAge($birthday) {  
    $birthday=getDate(strtotime($birthday));    
    $now=getDate();  
    $month=0;  
    if($now['month']>$birthday['month'])  
    $month=1;  
    if($now['month']==$birthday['month'])   
    if($now['mday']>=$birthday['mday'])  
    $month=1;  
    return $now['year']-$birthday['year']+$month;  
}  
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
                      <a class="active" href="user.php">
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
      <section id="main-content">
        <section class="wrapper site-min-height">
            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <table class="table table-striped table-advance table-hover">
                            <h4 style="padding-right: 10px"><i class="fa fa-angle-right"></i> User List </h4>
                            
                            <thead>
                                <tr>
                                    <th> #</th>
                                    <th> Student ID</th>
                                    <th> Username</th>
                                    <th> Nationality</th>
                                    <th> Age</th>
                                    <th> Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 0;
                                foreach($studentList as $student){
                                    $count+=1;
                                    
                                ?>
                                <tr>
                                    <td> <?=$count?></td>
                                    <td> <?=$student['studentID']?></td>
                                    <td> <?=$student['username']?></td>
                                    <td> <?=$student['nationality']?></td>
                                    <td> <?=getAge($student['dateOfBirth'])?></td>
                                    <td>
                                        <button class="btn btn-primary btn-xs" onclick="resetStudentPassword('<?=strval($student['studentID'])?>')">Reset Password</button>
                                        <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
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
    <script>
    function resetStudentPassword(studentID){
        var postData = { //Fetch form data
            'operation'     :'resetPassword',
            'courseID'     : studentID
        };
        $.ajax({
            type: 'post',
            url: '../process_student.php',
            data: postData,
            success: function(data){
                var pos = data.indexOf("{");
                var dataValid = data.substring(pos);
                var jsonData = eval("("+dataValid+")");
                if(jsonData.status === 'used'){
                    document.getElementById('submit').disabled=true;
                }else if(jsonData.status === 'available'){
                    document.getElementById('submit').disabled=false;
                }
            }
        });
    }    
    </script>
  </body>
</html>
