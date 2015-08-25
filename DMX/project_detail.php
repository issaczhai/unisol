<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
    <?php 
        if (session_status()!=PHP_SESSION_ACTIVE) {
                session_start();
        }
        include_once("./Manager/ConnectionManager.php");
        include_once("./Manager/ProjectManager.php");
        $project_id = filter_input(INPUT_GET, 'project_id');
        $projectMgr = new ProjectManager();

        $project = $projectMgr->getProject($project_id);    
        $completionDate = date_create_from_format('Y-m-d H:i:s', $project['completion_date']);
        
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="./public_html/css/carouselHome.css">
    <link rel="stylesheet" href="./public_html/css/main.css">
    <link rel="stylesheet" href="./public_html/css/dmx_style.css">
    <style>
        body{
            padding-top: 106px;
        }
        /**** change the divider width as the side scroll bar existence ****/
        .navbar-dmx .divider{
            width: 75.7%;
        }
        .detail-thumbnail{
            padding:0;
            box-shadow: 1px 1px 1px #888888;
        }
        .search_box .form-control:focus{
            border-color: #cccccc;
            -webkit-box-shadow: none;
            box-shadow: none;
        }
        .content-info{
            padding-left: 0;
            padding-right: 0;
        }
        
        .main-image .detail-image{
            width:100%;
        }
        .top-overlay{
            position:absolute;
            width:100%;
            height:50px;
            z-index:1000;
            background-color: rgba(90, 90, 90, 0.5);
        }
        .frame-thin{
            position: absolute;
            margin-top: 67px;
            height:442px;
            width:55%;
            background: none;
            z-index:1000;
            border:1px solid #fff;
            border-left:0;
            border-bottom:0;
        }
        
       .frame-thick{
            position:relative;
            margin-top: -500px;
            height:480px;
            padding-left:95%;
            z-index:1001;
            background: none;
            border:3px solid #fff;
            border-right:0;
        }
        .project-info{
            padding-left: 0;   
            padding-right:0; 
            height:509px;
        }
        .thumbnail-link{
            opacity: 0.4;
            filter: alpha(opacity=40); /* For IE8 and earlier */
        }
        .thumbnail-link:hover, .active-thumbnail-link{
            opacity: 1;
            filter: alpha(opacity=100); /* For IE8 and earlier */
        }
        .detail-thumbnail{
            cursor: pointer;
            padding:10px;
            margin-bottom: 10px;
            z-index: 1029;
        }
        .inline-list{
            position:relative;
            margin-top: 30px;
            margin-bottom: 10px;
            padding-left: 10px;
            z-index:1029;
        }
        .inline-list li{
            list-style: none;
            margin-bottom: 10px;
        }
        .inline-list li h5{
            text-align: left;
        }
        .inline-list li:first-child{
            color: #fff;
        }
        .pagination{
            position: absolute;
            z-index:1029;
            left: 10%;
            bottom: 0;
            margin-bottom: 0px;
        }
        footer{
            margin-top: 30px;
            bottom: auto;
        }
    </style>

    <meta charset="UTF-8">
    <title>Projects</title>
    </head>
    <body>
        <div class="wrapper">
            <?php
            include_once("./templates/new_header.html");
            ?>
            <div class="container-fluid content">
                <div class="row top-overlay">
                </div>

                <div class="row frame-thin">
                </div>

                <div class="row">
                    <!-- Carousel -->
                    
                    <div class="col-md-9 content-info">

                        <div class="main-image">
                            <img class="detail-image" src="./public_html/img/detailImg/sample1.jpg">
                        </div>

                        <div class="project-overlay">
                            <h5><?= $project['project_name'] ?></h5>
                            <p><?= $project['description'] ?></p>
                        </div>
                    </div>

                    <div class="col-md-3 project-info">
                        <ul class="inline-list">
                            <li><h5><?= $project['project_name'] ?></h5></li>
                            <li>LOCATION: <?= $project['location'] ?></li>
                            <li>SIZE: <?= $project['size'] ?></li>
                            <li>COMPLETION DATE: <?= date_format($completionDate, 'M Y') ?></li>
                        </ul>
                        <div id="loaderID" style="display:none;position:absolute; top:50%; left:50%; z-index:1030; opacity:1"><img src="./public_html/img/ajax-loader.gif" /></div>
                        <div class="thumbnails">
                            <div class="col-xs-6 col-md-4 detail-thumbnail">
                                <img class="thumbnail-link active-thumbnail-link" data-img="./public_html/img/detailImg/sample1.jpg" src="./public_html/img/thumbnailImg/sample1.jpg">
                            </div>
                            <div class="col-xs-6 col-md-4 detail-thumbnail">
                                <img class="thumbnail-link" data-img="./public_html/img/detailImg/sample2.jpg" src="./public_html/img/thumbnailImg/sample2.jpg">
                            </div>
                            <div class="col-xs-6 col-md-4 detail-thumbnail">
                                <img class="thumbnail-link" data-img="./public_html/img/detailImg/sample4.jpg" src="./public_html/img/thumbnailImg/sample4.jpg">
                            </div>
                            <div class="col-xs-6 col-md-4 detail-thumbnail">
                                <img class="thumbnail-link" data-img="./public_html/img/detailImg/sample5.jpg" src="./public_html/img/thumbnailImg/sample5.jpg">
                            </div>
                            <div class="col-xs-6 col-md-4 detail-thumbnail">
                                <img class="thumbnail-link" data-img="./public_html/img/detailImg/sample6.jpg" src="./public_html/img/thumbnailImg/sample6.jpg">
                            </div>
                            <div class="col-xs-6 col-md-4 detail-thumbnail">
                                <img class="thumbnail-link" data-img="./public_html/img/detailImg/sample1.jpg" src="./public_html/img/thumbnailImg/sample1.jpg">
                            </div>
                            <div class="col-xs-6 col-md-4 detail-thumbnail">
                                <img class="thumbnail-link" data-img="./public_html/img/detailImg/sample2.jpg" src="./public_html/img/thumbnailImg/sample2.jpg">
                            </div>
                            <div class="col-xs-6 col-md-4 detail-thumbnail">
                                <img class="thumbnail-link" data-img="./public_html/img/detailImg/sample4.jpg" src="./public_html/img/thumbnailImg/sample4.jpg">
                            </div>
                            <div class="col-xs-6 col-md-4 detail-thumbnail">
                                <img class="thumbnail-link" data-img="./public_html/img/detailImg/sample5.jpg" src="./public_html/img/thumbnailImg/sample5.jpg">
                            </div>
                        </div>
                        <ul class='pagination'>
                            <li class='first'><a href="#" data-page="1" title="First">&laquo;</a></li>
                            <li><a href="#" title="Previous">&lt;</a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#" data-page="4" title="Next">&gt;</a></li>
                            <li class='last'><a href="#" data-page="5" title="Last">&raquo;</a></li>
                        </ul>
                    </div>

                </div>
                <div class="row frame-thick pull-right">
                </div>
            </div>
        </div> 
    <?php
        include_once("./templates/footer.php");
    ?>

    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="./public_html/js/jquery.paginate.js"></script>
    <script src="./public_html/js/main.js"></script>
    <script>
        $('.detail-thumbnail').on('click','.thumbnail-link', function(){
            $('.detail-image').attr('src', $(this).attr('data-img'));
            $('.thumbnail-link').removeClass('active-thumbnail-link');
            $(this).addClass('active-thumbnail-link');
        });
    </script>
    </body>
</html>
