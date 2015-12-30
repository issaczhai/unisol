<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Admin | Add Course</title>

        
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
                <div class="col-lg-12">
                  <div class="form-panel">
                      <h4 class="mb"><i class="fa fa-angle-right"></i> Add Course</h4>
                      <form class="form-horizontal style-form" method="post" enctype='multipart/form-data' action='../process_course.php'>
                          <input type="hidden" id="operation" name="operation" value="add">
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Course ID (Unique)</label>
                              <div class="col-sm-4">
                                  <input type="text" id="courseID" name="courseID" class="form-control round-form" maxlength="20" required onchange="checkCourseID()">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Course Name</label>
                              <div class="col-sm-4">
                                  <input type="text" id="name" name="name" class="form-control round-form" maxlength="100" required>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Instructor</label>
                              <div class="col-sm-4">
                                  <input type="text" id="instructor" name="instructor" class="form-control round-form" maxlength="100" required>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Price ($)</label>
                              <div class="col-sm-4">
                                  <input type="text" id="price" name="price" class="form-control round-form" maxlength="10" required>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Description</label>
                              <div class="col-sm-4">
                                  <textarea class="form-control" style="height: 200px;" id="description" name="description"></textarea>
                              </div>
                          </div>
                          <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label" for="syllabus">Course Content</label>
                                <div class="col-sm-4">
                                    <table id="syllabusTable" class="table">
                                        <tr>
                                            <td width="30%"><input type="text" name="unit1" class="form-control" id="unit1"></td>
                                            <td><input type="text" name="content1" class="form-control" id="content1"></td>
                                        </tr>
                                    </table>
                                    <button type="button" onclick="addRow()">Add Content</button> 
                                    <button type="button" onclick="removeRow()">Remove Content</button>
                                </div>
                                <input type="hidden" id="syllabusRow" name="syllabusRow" value="1">
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label" for="objective">Course Content</label>
                              <div class="col-sm-4">
                                  <textarea class="form-control" style="height: 200px;" id="objective" name="objective"></textarea>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Documents</label>
                              <div class="col-sm-1">
                                  <input type="file" id="documents[]" name="documents[]" multiple="multiple">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Prerequisite Certificate</label>
                              <div class="col-sm-4">
                                  <input type="text" id="requiredCert" name="requiredCert" class="form-control round-form" maxlength="100">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Prerequisite Course</label>
                              <div class="col-sm-4">
                                  <input type="text" id="prerequisite" name="prerequisite" class="form-control round-form" maxlength="100">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Certificate Received Upon Finising Course</label>
                              <div class="col-sm-4">
                                  <input type="text" id="receivedCert" name="receivedCert" class="form-control round-form" maxlength="100">
                              </div>
                          </div>
                          <div class="form-group">
                              <button type="submit" id="submit" name="submit" class="btn btn-primary col-sm-2 col-sm-offset-2">Done</button>
                          </div>
                      </form>
                  </div>
                </div><!-- col-lg-12-->      	
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
    function checkCourseID(){
        var courseID = document.getElementById("courseID").value;
        var postData = { //Fetch form data
            'operation'     :'checkCourseID',
            'courseID'     : courseID
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
                    document.getElementById('submit').disabled=true;
                }else if(jsonData.status === 'available'){
                    document.getElementById('submit').disabled=false;
                }
            }
        });
    }
    
    function addRow(){
        var row = parseInt(document.getElementById('syllabusRow').value);
        row = row + 1;
        $("#syllabusTable").append("<tr><td><input type='text' name='unit"+row.toString()+"'id='unit"+row.toString()+"' class='form-control'></td><td><input type='text' name='content"+row.toString()+"'id='content"+row.toString()+"' class='form-control'></td></tr>");
        document.getElementById('syllabusRow').value = row;
    }
    
    function removeRow(){
        var row = parseInt(document.getElementById('syllabusRow').value);
        if(row > 1){
            row = row - 1;
            document.getElementById('syllabusRow').value = row;
            $("#syllabusTable").find("tr:last").remove();
        }
    }
    </script>
    
  </body>
</html>
