<!DOCTYPE html>
<?php
session_start(); 

include_once("../Manager/ConnectionManager.php");
include_once("../Manager/CourseManager.php");
include_once("../Manager/SessionManager.php");
$courseMgr = new CourseManager();
$sessionMgr = new SessionManager();

$courseList = $courseMgr->getCourseList();
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Admin | Course</title>

        
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
                      <a class="active" href="course.php">
                          <i class="fa fa-desktop"></i>
                          <span>Courses</span>
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
                            <h4 style="padding-right: 10px"><i class="fa fa-angle-right"></i> Course List <button class="btn btn-success btn-sm pull-right" onclick='window.location="addcourse.php"'> Add Course</button></h4>
                            
                            <thead>
                                <tr>
                                    <th> #</th>
                                    <th> Course ID</th>
                                    <th> Name</th>
                                    <th> Manage Course</th>
                                    <th colspan="2"> Session</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 0;
                                foreach($courseList as $course){
                                    $count+=1;
                                    $sessionList = $sessionMgr->getSessionListByCourse($course['courseID']);
                                    $sessionIDList=[];
                                    foreach($sessionList as $session){
                                        array_push($sessionIDList,$session['sessionID']);
                                    }
                                    $sessionIDString = implode(",",$sessionIDList);
                                ?>
                                <tr>
                                    <td> <?=$count?></td>
                                    <td> <?=$course['courseID']?></td>
                                    <td> <?=$course['name']?></td>
                                    <td>
                                        <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                                        <button class="btn btn-danger btn-xs" onclick="deletePhoto('<?=strval($course['courseID'])?>')"><i class="fa fa-trash-o "></i></button>
                                    </td>
                                    <td><?=$sessionIDString?></td>
                                    <td style="width: 10%">
                                        <button id="showBtn<?=strval($course['courseID'])?>" class="btn btn-primary btn-xs" onclick="showSession('<?=strval($course['courseID'])?>')"><i class="fa fa-edit"></i> Manage Session</button>
                                        <button id="closeBtn<?=strval($course['courseID'])?>" class="btn btn-info btn-xs" onclick="closeSession('<?=strval($course['courseID'])?>')" style="display:none"><i class="fa fa-check"></i> Done</button>
                                    </td>
                                </tr>
                                <tr id="sectionRow<?=strval($course['courseID'])?>" style="display:none">
                                    <td colspan="5">
                                        <table style="width: 100%">
                                            <tr>
                                                <th>Session ID</th>
                                                <th>Venue</th>
                                                <th>Time</th>
                                                <th>Language</th>
                                                <th>Vacancy</th>
                                                <th></th>
                                            </tr>
                                            <?php
                                            foreach($sessionList as $session){
                                            ?>
                                            <tr>
                                                 <td><?=$session['sessionID']?></td>
                                                 <td><?=$session['venue']?></td>
                                                 <?php
                                                 if($session['fulltime'] === ""){
                                                 ?>
                                                    <td><?=$session['parttime']?></td>
                                                 <?php
                                                 }else{
                                                 ?>
                                                    <td><?=$session['fulltime']?></td>
                                                    <?php
                                                 }
                                                    ?>
                                                 
                                                 <td><?=$session['languages']?></td>
                                                 <td><?=$session['vacancy']?></td>
                                                 <td>
                                                     <button class="btn btn-theme02 btn-xs" data-toggle="modal" data-target="<?=$session['sessionID']?>SessionModal"><i class="fa fa-edit"></i> Edit</button>
                                                 </td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                            <tr style="width:1px;height:10px;">
                                            </tr>
                                            <tr>
                                                <td colspan="6">
                                                    <button type="button" class="btn btn-primary btn-sm" onclick="populateAddModal('<?=$course['courseID']?>')" data-toggle="modal" data-target="#addSessionModal"> Add Session </button>
                                                </td>
                                            </tr>
                                        </table>
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
    function deletePhoto(cID){
        var courseID = cID;
        var postData = {'operation': 'delete','courseID':cID};
        $.ajax({ //Process the form using $.ajax()
            type      : 'POST', //Method type
            url       : '../process_course.php', //Your form processing file URL
            data      : postData, //Forms name
            success   : function(data) {
    //            var pos = data.indexOf("{");
    //            var dataValid = data.substring(pos);
    //            var jsonData = eval("("+dataValid+")");
                location.reload();
            }
        });
        event.preventDefault(); //Prevent the default submit
    }
    
    function showSession(cID){
        var courseID = cID;
        $("#sectionRow"+courseID).css('display','');
        $("#showBtn"+courseID).css('display','none');
        $("#closeBtn"+courseID).css('display','');
    }
    
    function closeSession(cID){
        var courseID = cID;
        $("#sectionRow"+courseID).css('display','none');
        $("#showBtn"+courseID).css('display','');
        $("#closeBtn"+courseID).css('display','none');
    }
    
    function populateAddModal(cID){
        var courseID = cID;
        document.getElementById('addSessionCourseID').value = courseID;
    }
    
    function checkSession(){
        var courseID=document.getElementById('addSessionCourseID').value;
        var sessionID=document.getElementById('addSessionSessionID').value;
        var postData = { //Fetch form data
            'operation'     :'checkSession',
            'courseID'     : courseID,
            'sessionID'     : sessionID
        };
        $.ajax({
            type: 'post',
            url: '../process_course.php',
            data: postData,
            success: function(data){
                var pos = data.indexOf("{");
                var dataValid = data.substring(pos);
                var jsonData = eval("("+dataValid+")");
                if(jsonData.status === 'used'){
                    document.getElementById('addSessionBtn').disabled=true;
                    console.log("used");
                }else if(jsonData.status === 'available'){
                    document.getElementById('addSessionBtn').disabled=false;
                    console.log("available");
                }
            }
        });
    }
    </script>
  </body>
</html>
