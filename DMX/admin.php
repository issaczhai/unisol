
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<?php
session_start(); 

include_once("./Manager/ConnectionManager.php");
include_once("./Manager/ProjectManager.php");
include_once("./Manager/PhotoManager.php");

if (isset($_GET['message'])) {
    print '<script type="text/javascript">alert("' . $_GET['message'] . '");</script>';
}

$projectMgr = new ProjectManager();
$photoMgr = new PhotoManager();

$projectList = $projectMgr->getAllProjects();
$photoListJson = $photoMgr->getAllPhotosInJson();
?>
<head>
    <title>Admin | Issac</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Responsive HTML5 Website landing Page for Developers">
    <meta name="author" content="3rd Wave Media">    
    <link rel="shortcut icon" href="favicon.ico">  
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'> 
    <script type="text/javascript" src="public_html/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="public_html/js/jquery-1.11.0.js"></script>
    <link rel="stylesheet" type="text/css" href="public_html/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="public_html/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="http://www.prepbootstrap.com/Content/css/developer/styles.css" />

    <!-- github acitivity css -->
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/octicons/2.0.2/octicons.min.css">
    <link rel="stylesheet" href="http://caseyscarborough.github.io/github-activity/github-activity-0.1.0.min.css">
    <style>
		.btn-file {
			position: relative;
			overflow: hidden;
		}
		.btn-file input[type=file] {
			position: absolute;
			top: 0;
			right: 0;
			min-width: 100%;
			min-height: 100%;
			font-size: 100px;
			text-align: right;
			filter: alpha(opacity=0);
			opacity: 0;
			outline: none;
			background: white;
			cursor: inherit;
			display: block;
		}
	</style>
</head> 

<body>
    <!-- ******HEADER****** -->         
    <header class="header">
        <div class="container">                       
            <img class="profile-image img-responsive pull-left" src="https://s3-ap-southeast-1.amazonaws.com/issacpersonal/10414598_724454527623203_1602275701447036911_n.jpg" alt="James Lee" />
            <div class="profile-content pull-left">
                <h1 class="name">Issac Zhai</h1>
                <h2 class="desc">Famous Footballer</h2>   
                <ul class="social list-inline">
                    <li><a href="https://www.facebook.com/issac.zhai"><i class="fa fa-facebook"></i></a></li>                   
                    <li><a href="https://plus.google.com/u/0/114808512401158224397"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="https://sg.linkedin.com/pub/haoxian-zhai/86/a2b/57a"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="http://www.weibo.com/issac45l18"><i class="fa fa-github-alt"></i></a></li>                                  
                </ul> 
            </div><!--//profile-->
            <a class="btn btn-cta-primary pull-right" href="mailto:hx.zhai.2012@sis.smu.edu.sg" target="_blank"><i class="fa fa-paper-plane"></i> Contact Me</a>              
        </div><!--//container-->
    </header><!--//header-->
    
    <div class="container sections-wrapper">
        <div class="row">
            <div class="primary col-md-7 col-sm-12 col-xs-12">
                <section class="about section">
                    <div class="section-inner">
                        <h2 class="heading">New Project</h2>
                        <div class="content">
                            <form id="upload_project" method="post" enctype="multipart/form-data" action="process_project.php">
                            <input type="hidden" name="operation" id="operation" value="create">
                            <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="form-group">
                                <label for="type">Type:</label>
                                <select class="form-control" name="type" id="type">
                                    <option value="Corporate">Corporate</option>
                                    <option value="Commercial">Commercial</option>
                                    <option value="Residential">Residential</option>
                                    <option value="Architecture">Architecture</option>
                                </select>
                            </div>
                            <div class="form-group">
                                    <label for="year">Year:</label>
                                    <input type="text" class="form-control" name="year" id="year">
                            </div>
                            <div class="form-group">
                                    <label for="country">Country:</label>
                                    <input type="text" class="form-control" name="country" id="country" placeholder="e.g China, Singapore">
                            </div>
                            <div class="form-group">
                                    <label for="location">Location:</label>
                                    <input type="text" class="form-control" name="location" id="location">
                            </div>
                            <div class="form-group">
                                    <label for="size">Size:</label>
                                    <input type="text" class="form-control" name="size" id="size" placeholder="e.g 527 sqft OR 2 Rooms 807 sqft">
                            </div>
                            <div class="form-group">
                                    <label for="completion_date">Completion Date:</label>
                                    <input type="text" class="form-control" name="completion_date" id="completion_date" placeholder="dd-mm-yyyy">
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea class="form-control" rows="5" cols="55" id="description" name="description"></textarea>
                            </div>
                            <?php
                            $noOfButton = 20;
                            for ($x = 1; $x <= $noOfButton; $x++) {
                                $hdId = "hd".strval($x)."_input";
                                $remainder = $x%5;
                                if($remainder == 1){
                                   ?>
                                    <div class="form-group">
                                        
                                        <span class="btn btn-default btn-file" id="hd<?=strval($x)?>_span">
                                            HD <?=$x?> 
                                            <input type="file" id="<?=$hdId?>" name="<?=$hdId?>" onchange="checkHD('<?=strval($x)?>')">
                                        </span>
                                    <?php 
                                }elseif($remainder == 0){
                                        ?>  
                                            <span class="btn btn-default btn-file" id="hd<?=strval($x)?>_span">
                                                HD <?=$x?> 
                                                <input type="file" id="<?=$hdId?>" name="<?=$hdId?>" onchange="checkHD('<?=strval($x)?>')">
                                            </span>
                                        </div>
                                    <?php 
                                }else{
                                    ?>  
                                        <span class="btn btn-default btn-file" id="hd<?=strval($x)?>_span">
                                            HD <?=$x?> 
                                            <input type="file" id="<?=$hdId?>" name="<?=$hdId?>" onchange="checkHD('<?=strval($x)?>')">
                                        </span>
                                    <?php
                                }
                            }
                            
                            
                            for ($x = 1; $x <= $noOfButton; $x++) {
                                $thumbnailId = "thumbnail".strval($x)."_input";
                                $remainder = $x%5;
                                if($remainder == 1){
                                   ?>
                                    <div class="form-group">
                                        
                                        <span class="btn btn-info btn-file" id="thumbnail<?=strval($x)?>_span">
                                            Small <?=$x?> 
                                            <input type="file" id="<?=$thumbnailId?>" name="<?=$thumbnailId?>" onchange="checkThumbnail('<?=strval($x)?>')">
                                        </span>
                                    <?php 
                                }elseif($remainder == 0){
                                        ?>  
                                            <span class="btn btn-info btn-file" id="thumbnail<?=strval($x)?>_span">
                                                Small <?=$x?> 
                                                <input type="file" id="<?=$thumbnailId?>" name="<?=$thumbnailId?>" onchange="checkThumbnail('<?=strval($x)?>')">
                                            </span>
                                        </div>
                                    <?php 
                                }else{
                                    ?>  
                                        <span class="btn btn-info btn-file" id="thumbnail<?=strval($x)?>_span">
                                            Small <?=$x?> 
                                            <input type="file" id="<?=$thumbnailId?>" name="<?=$thumbnailId?>" onchange="checkThumbnail('<?=strval($x)?>')">
                                        </span>
                                    <?php
                                }
                            }
                            ?>
                            <input type="submit" class="btn btn-primary" value="Create">
                            </form>
                        </div><!--//content-->
                    </div><!--//section-inner-->                 
                </section><!--//section-->
			</div><!--//primary-->
            
            <div class="secondary col-md-5 col-sm-12 col-xs-12">
                 <aside class="languages aside section">
                    <div class="section-inner">
                        <h2 class="heading" style="margin-bottom: 0px;">Current Project List</h2>
                        <div class="content">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped" id="display_product">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Project ID</th>
                                                <th>Name</th>
                                                <th>Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($projectList as $project){
                                        ?>
                                            <tr>
                                                <td><input type="checkbox" class="projectList_id" value="<?=$project["project_id"]?>"></td>
                                                <td><?=$project["project_id"]?></td>
                                                <td><?=$project["project_name"]?></td>
                                                <td>Edit</td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                            <tr><td colspan="4"><button class="btn btn-danger" onclick="DeleteProject()">Delete Selected Project</button></td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div><!--//content-->
                    </div><!--//section-inner-->
                </aside><!--//section-->
                
                <aside class="testimonials aside section">
                    <div class="section-inner">
                        <h2 class="heading">Testimonials</h2>
                        <div class="content">
                            <div class="item">
                                <blockquote class="quote">                                  
                                    <p><i class="fa fa-quote-left"></i>Issac is an excellent soccer player and he is passionate about what he can do on the pitch. You can totally trust on him to deliver assist to teammates as well as score himself!</p>
                                </blockquote>                
                                <p class="source"><span class="name">Sir Alex Ferguson</span><br /><span class="title">Former Head Coach of Manchester United</span></p>                                                             
                            </div><!--//item-->
                            
                        </div><!--//content-->
                    </div><!--//section-inner-->
                </aside><!--//section-->
                
                <aside class="list music aside section">
                    <div class="section-inner">
                        <h2 class="heading">Favourite coding music</h2>
                        <div class="content">
                            <ul class="list-unstyled">
                                <li><i class="fa fa-headphones"></i> <a href="https://www.youtube.com/watch?v=HaBIQ7TRYbs">That's why you go away</a></li>
                                <li><i class="fa fa-headphones"></i> <a href="https://www.youtube.com/watch?v=tTAsGY5fgOI">Ocean Deep</a></li>
                                <li><i class="fa fa-headphones"></i> <a href="https://www.youtube.com/watch?v=xRZP_7a27nk">Greatest Love of All</a></li>
                            </ul>
                        </div><!--//content-->
                    </div><!--//section-inner-->
                </aside><!--//section-->
                
            </div><!--//secondary-->    
        </div><!--//row-->
    </div><!--//masonry-->
    
    <!-- ******FOOTER****** --> 
    <footer class="footer">
        <div class="container text-center">
                <small class="copyright">Designed with <i class="fa fa-heart"></i> by <a href="#" target="_blank">Issac</a> himself</small>
        </div><!--//container-->
    </footer><!--//footer-->
<script>
$(document).on('change', '.btn-file :file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
});
$(document).ready( function() {
    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
        console.log(numFiles);
        console.log(label);
    });
});

function checkThumbnail(id){
    var i = document.createElement("i");
    i.setAttribute('class',"fa fa-check");
    document.getElementById("thumbnail"+id+'_span').appendChild(i);
}

function checkHD(id){
    var i = document.createElement("i");
    i.setAttribute('class',"fa fa-check");
    document.getElementById("hd"+id+'_span').appendChild(i);
}

function DeleteProject(){
    var projectId_array = [];
    $('.projectList_id:checked').each(function () {
        var e = $(this);
        projectId_array.push(e.val());
    });
    
    if(projectId_array.length != 0){
        var projectId_str = projectId_array.toString();
        var operation = 'delete';
        var redirect_path= './process_project.php?operation='+operation+'&projectIdList='+projectId_str;
        console.log(redirect_path);
        document.location.href =redirect_path;
    }else{
        alert("You have not selected any projects to delete");
    }
}
</script>
   
</body>
</html> 

