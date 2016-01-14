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
$documentsArr = [];
$documentsStr = $courseMgr->getDocumentsByCourse($lang,$courseID);
$documentsArr = json_decode($documentsStr);
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Admin | Edit Documents</title>

        
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
                      <form id="id" class="form-horizontal style-form" method="post" enctype='multipart/form-data' action='../process_course.php'>
                          <input type="hidden" id="operation" name="operation" value="editDocument">
                          <input type="hidden" id="lang" name="lang" value="<?=$lang?>">
                          <input type="hidden" id="courseID" name="courseID" value="<?=$courseID?>">
                          <div id="reference"></div>
                                     <?php
                                      $catRow = 0;
                                      if($documentsArr === null){
                                        ?>
                          
                                        <?php
                                      }else{
                                        foreach($documentsArr as $k => $v){
                                            $catRow++;
                                            //$documentName = substr($document,strrpos($document,"_")+1);
                                            //$documentType = substr($document,strrpos($document,".")+1);

                                        ?>
                                        <div class="form-group" id="cat<?=$catRow?>Div">
                                          <label class="col-sm-2 col-sm-2 control-label"><input type="text" id="cat<?=$catRow?>" name="cat<?=$catRow?>" value="<?=$k?>" required></label>
                                          <div class="col-sm-4">
                                              <table class="table">
                                                  <?php
                                                  $documentRow=0;
                                                  foreach($v as $document => $path){
                                                      $documentRow++;
                                                      $documentType = substr($path,strrpos($path,".")+1);
                                                      if($documentType === 'png' or $documentType === 'jpg' or $documentType === 'jpeg'){
                                                          $documentType = 'img';
                                                      }
                                                  ?>
                                                  <tr id="Cat<?=$catRow?>Row<?=strval($documentRow)?>">
                                                      <td width="85%"><?=$document?></td>
                                                      <td>
                                                          <img src="../public_html/img/file_extension_<?=$documentType?>.png">
                                                          <input type="hidden" name="cat<?=$catRow?>Documents[]" class="cat<?=$catRow?>Documents" value="<?=$path?>">
                                                      </td>
                                                      <td><button type="button" onclick="removeDocument('<?=$path?>','<?=$catRow?>','<?=$documentRow?>')">x</button></td>
                                                  </tr>
                                                  <?php
                                                  }
                                                  ?>
                                                  <td><input type="file" name="cat<?=$catRow?>Upload[]" multiple="multiple"></td>
                                              </table>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                      }
                                     ?>
                          <input type="hidden" id="catRowNo" name="catRowNo" value="<?=$catRow?>">
                            <div class="form-group">
                                <div class="col-sm-2 col-sm-offset-2">
                                    <button type="button" class="btn btn-success" onclick="addCat()">Add Category</button>
                                </div>    
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-default" onclick="removeCat()">Remove Category</button>
                                </div>
                            </div>
                          <div class="form-group">
                              <div class="col-sm-2 col-sm-offset-2">
                                <button type="submit" id="submit" name="submit" class="btn btn-primary">Done</button>
                              </div>
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
    function removeDocument(documentPath, catRow, documentRow){
        var courseID=document.getElementById('courseID').value;
        //delete row
        var row = document.getElementById('Cat'+catRow+'Row'+documentRow);
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
    
    function addCat(){
        var catRowNo = parseInt(document.getElementById('catRowNo').value);
        if(catRowNo===0){
            catRowNo = catRowNo + 1;
            var catRowNoStr = catRowNo.toString();
            $('#reference').after('<div class="form-group" id="cat'+catRowNoStr+'Div">'
                    +'<label class="col-sm-2 col-sm-2 control-label">'
                    +'<input type="text" id="cat'+catRowNoStr+'" name="cat'+catRowNoStr+'" required></label>'
                    +'<div class="col-sm-4"><input type="file" name="cat'+catRowNoStr+'Upload[]" multiple="multiple"></div></div>');
                           
        }else{
            var currentCatRowNoStr = catRowNo.toString();
            catRowNo = catRowNo + 1;
            var catRowNoStr = catRowNo.toString();
            $('#cat'+currentCatRowNoStr+'Div').after('<div class="form-group" id="cat'+catRowNoStr+'Div">'
                    +'<label class="col-sm-2 col-sm-2 control-label">'
                    +'<input type="text" id="cat'+catRowNoStr+'" name="cat'+catRowNoStr+'" required></label>'
                    +'<div class="col-sm-4"><input type="file" name="cat'+catRowNoStr+'Upload[]" multiple="multiple"></div></div>');
                           
        }
        document.getElementById('catRowNo').value = catRowNo;
    }
    
    function removeCat(){
        var courseID=document.getElementById('courseID').value;
        var catRowNo = parseInt(document.getElementById('catRowNo').value);
        if(catRowNo > 0){
            var arr = [];            
            $('input[name^=cat'+catRowNo.toString()+'Documents]').each(function(){
                arr.push($(this).val());
            });
            $("#cat"+catRowNo.toString()+"Div").remove();
            console.log(JSON.stringify(arr));
            var postData = { //Fetch form data
                'operation'     :'deleteDocumentByCategory',
                'courseID'      :courseID,
                'pathArr'     :  JSON.stringify(arr)
            };
            //pass data to backend to delete with ajax
            $.ajax({
                type: 'post',
                url: '../process_course.php',
                data: postData,
                success: function(data){

                }
            });
            
            
            catRowNo = catRowNo - 1;
            document.getElementById('catRowNo').value = catRowNo;
        }
    }
    </script>
    
  </body>
</html>
