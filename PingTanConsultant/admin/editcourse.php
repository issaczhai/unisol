<!DOCTYPE html>
<?php
session_start();
$courseID='';
if (isset($_GET['cID'])) {
    $courseID = $_GET['cID'];
}
$lang='';
if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
}

include_once("../Manager/ConnectionManager.php");
include_once("../Manager/CourseManager.php");
$courseMgr = new CourseManager();
$course = $courseMgr->getCourse($lang,$courseID);
if(!empty($course)){
    $syllabusArr = json_decode($course['syllabus']);
    $documentsArr = json_decode($course['documents']);
}
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Admin | Edit Course</title>

        
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
    
    <style>
        .col-sm-offset-right-12 {
  margin-right: 100%;
}
.col-sm-offset-right-11 {
  margin-right: 91.66666667%;
}
.col-sm-offset-right-10 {
  margin-right: 83.33333333%;
}
.col-sm-offset-right-9 {
  margin-right: 75%;
}
.col-sm-offset-right-8 {
  margin-right: 66.66666667%;
}
.col-sm-offset-right-7 {
  margin-right: 58.33333333%;
}
.col-sm-offset-right-6 {
  margin-right: 50%;
}
.col-sm-offset-right-5 {
  margin-right: 41.66666667%;
}
.col-sm-offset-right-4 {
  margin-right: 33.33333333%;
}
.col-sm-offset-right-3 {
  margin-right: 25%;
}
.col-sm-offset-right-2 {
  margin-right: 16.66666667%;
}
.col-sm-offset-right-1 {
  margin-right: 8.33333333%;
}
.col-sm-offset-right-0 {
  margin-right: 0;
}
    </style>
    
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
                      <h4 class="mb"><i class="fa fa-angle-right"></i> Edit Course</h4>
                      <form class="form-horizontal style-form" method="post" enctype='multipart/form-data' action='../process_course.php'>
                          
                          <?php
                          if(empty($course)){
                          ?>
                          <input type="hidden" id="operation" name="operation" value="add">
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Course ID</label>
                              <div class="col-sm-4">
                                  <p class="form-control-static"><?=$courseID?></p>
                                  <input type="hidden" id="courseID" name="courseID" class="form-control round-form" value="<?=$courseID?>">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Display Language</label>
                              <div class="col-sm-4">
                                    <p class="form-control-static"><?=$lang?></p>
                                    <input type="hidden" id="lang" name="lang" class="form-control round-form" value="<?=$lang?>">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Course Name</label>
                              <div class="col-sm-4">
                                  <input type="text" id="name" name="name" class="form-control round-form" value="" maxlength="100" required>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Instructor</label>
                              <div class="col-sm-4">
                                  <input type="text" id="instructor" name="instructor" class="form-control round-form" value="" maxlength="100" required>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Price ($)</label>
                              <div class="col-sm-4">
                                  <input type="text" id="price" name="price" class="form-control round-form" value="" maxlength="10" required>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Display Picture</label>
                              <div class="col-sm-1">
                                  <input type="file" id="displayPic" name="displayPic">
                                  <input type="hidden" id="currentDisplayPic" name="currentDisplayPic">
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
                                            <td width="30%"><input type="text" name="unit1" class="form-control" value="" id="unit1"></td>
                                            <td><input type="text" name="content1" class="form-control" value="" id="content1"></td>
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
                              <div class="col-sm-1 col-sm-offset-2">
                                  <input type="file" id="documents[]" name="documents[]" multiple="multiple">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Prerequisite Certificate</label>
                              <div class="col-sm-4">
                                  <input type="text" id="requiredCert" name="requiredCert" class="form-control round-form" value="" maxlength="100">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Prerequisite Course</label>
                              <div class="col-sm-4">
                                  <input type="text" id="prerequisite" name="prerequisite" class="form-control round-form" value="" maxlength="100">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Certificate Received Upon Finising Course</label>
                              <div class="col-sm-4">
                                  <input type="text" id="receivedCert" name="receivedCert" class="form-control round-form" value="" maxlength="100">
                              </div>
                          </div>
                          <?php
                          }else{
                          ?>
                          <input type="hidden" id="operation" name="operation" value="edit">
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Course ID</label>
                              <div class="col-sm-4">
                                  <p class="form-control-static"><?=$courseID?></p>
                                  <input type="hidden" id="courseID" name="courseID" class="form-control round-form" value="<?=$courseID?>">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Display Language</label>
                              <div class="col-sm-4">
                                    <p class="form-control-static"><?=$lang?></p>
                                    <input type="hidden" id="lang" name="lang" class="form-control round-form" value="<?=$lang?>">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Course Name</label>
                              <div class="col-sm-4">
                                  <input type="text" id="name" name="name" class="form-control round-form" value="<?=$course['name']?>" maxlength="100" required>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Instructor</label>
                              <div class="col-sm-4">
                                  <input type="text" id="instructor" name="instructor" class="form-control round-form" value="<?=$course['instructor']?>" maxlength="100" required>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Price ($)</label>
                              <div class="col-sm-4">
                                  <input type="text" id="price" name="price" class="form-control round-form" value="<?=$course['price']?>" maxlength="10" required>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Display Picture</label>
                              <div class="col-sm-1">
                                  <input type="file" id="displayPic" name="displayPic" onchange="removeThumb()">
                                  <img id="currentDisplayPicThumb" src="<?="../".$course['displayPic']?>" height="80" width="80">
                                  <input type="hidden" id="currentDisplayPic" name="currentDisplayPic" value="<?=$course['displayPic']?>">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Description</label>
                              <div class="col-sm-4">
                                  <textarea class="form-control" style="height: 200px;" id="description" name="description"><?=$course['description']?></textarea>
                              </div>
                          </div>
                          <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label" for="syllabus">Course Content</label>
                                <div class="col-sm-4">
                                    <table id="syllabusTable" class="table">
                                        <?php
                                        $count = 0;
                                        foreach ($syllabusArr as $k => $v) {
                                            $count++;
                                        ?>
                                        <tr>
                                            <td width="30%"><input type="text" name="unit<?=$count?>" class="form-control" value="<?=$k?>" id="unit<?=$count?>"></td>
                                            <td><input type="text" name="content<?=$count?>" class="form-control" value="<?=$v?>" id="content<?=$count?>"></td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                    <button type="button" onclick="addRow()">Add Content</button> 
                                    <button type="button" onclick="removeRow()">Remove Content</button>
                                </div>
                                <input type="hidden" id="syllabusRow" name="syllabusRow" value="<?=$count?>">
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label" for="objective">Course Content</label>
                              <div class="col-sm-4">
                                  <textarea class="form-control" style="height: 200px;" id="objective" name="objective"><?=$course['objective']?></textarea>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Documents</label>
                              <div class="col-sm-3 col-sm-offset-right-7">
                                  <table id="documentsTable" class="table">
                                      <?php
                                      $row = 0;
                                      foreach($documentsArr as $document){
                                          $row++;
                                          $documentName = substr($document,strrpos($document,"_")+1);
                                          $documentType = substr($document,strrpos($document,".")+1);
                                          if($documentType === 'png' or $documentType === 'jpg' or $documentType === 'jpeg'){
                                              $documentType = 'img';
                                          }
                                      ?>
                                      <tr id="documentsRow<?=strval($row)?>">
                                          <td width="85%"><?=$documentName?></td>
                                          <td>
                                              <img src="../public_html/img/file_extension_<?=$documentType?>.png">
                                              <input type="hidden" name="existingDocuments[]" value="<?=$document?>">
                                          </td>
                                          <td><button type="button" onclick="getFileInfo('<?=$document?>','<?=strval($row)?>')">x</button></td>
                                      </tr>
                                      <?php
                                      }
                                      ?>
                                  </table>
                              </div>
                              <div class="col-sm-1 col-sm-offset-2">
                                  <input type="file" id="documents[]" name="documents[]" multiple="multiple">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Prerequisite Certificate</label>
                              <div class="col-sm-4">
                                  <input type="text" id="requiredCert" name="requiredCert" class="form-control round-form" value="<?=$course['requiredCert']?>" maxlength="100">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Prerequisite Course</label>
                              <div class="col-sm-4">
                                  <input type="text" id="prerequisite" name="prerequisite" class="form-control round-form" value="<?=$course['prerequisite']?>" maxlength="100">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Certificate Received Upon Finising Course</label>
                              <div class="col-sm-4">
                                  <input type="text" id="receivedCert" name="receivedCert" class="form-control round-form" value="<?=$course['receivedCert']?>" maxlength="100">
                              </div>
                          </div>
                          <?php
                          }
                          ?>
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
    function addRow(){
        var row = parseInt(document.getElementById('syllabusRow').value);
        row = row + 1;
        $("#syllabusTable").append("<tr><td><input type='text' name='unit"+row.toString()+"'id='unit"+row.toString()+"' class='form-control' required></td><td><input type='text' name='content"+row.toString()+"'id='content"+row.toString()+"' class='form-control' required></td></tr>");
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
    
    function getFileInfo(documentPath,row){
        var courseID=document.getElementById('courseID').value;
        //delete row
        var row = document.getElementById('documentsRow'+row);
        row.parentNode.removeChild(row);
        var postData = { //Fetch form data
            'operation'     :'deleteDocument',
            'courseID'      :courseID,
            'documentPath'     : documentPath
        };
        //pass data to backend to delete with ajax
        $.ajax({
            type: 'post',
            url: '../process_course.php',
            data: postData,
            success: function(data){
                
            }
        });
    }
    
    function removeThumb(){
        //$('#currentDisplayPicThumb').remove();
        document.getElementById('currentDisplayPicThumb').src="";
        document.getElementById('currentDisplayPicThumb').height = "10px";
        document.getElementById('currentDisplayPicThumb').width = "10px";
    }
    </script>
    
  </body>
</html>
