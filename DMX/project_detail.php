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
        
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="./public_html/css/carouselHome.css">
    <link rel="stylesheet" href="./public_html/css/main.css">
    <link rel="stylesheet" href="./public_html/css/dmx_style.css">
    <style>
        
        .col-xs-12, .col-xs-6{
            padding:0;
        }
        .wrapper{
            width:100%;
            padding-left: 0;
            padding-right: 0;
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
            height:453px;
            width:55%;
            background: none;
            z-index:1000;
            border:1px solid #fff;
            border-left:0;
            border-bottom:0;
        }
        /*
        .frame-thick{
            position: absolute;
            margin-top: 20px;
            height:470px;
            width:95%;
            margin-left: 5%;
            background: none;
            z-index:1001;
            border:3px solid #fff;
            border-right:0;
        }
        */
       .frame-thick{
            position:relative;
            margin-top: -500px;
            margin-right:0 !important;
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
            height:100%;
        }
        .detail-thumbnail{
            padding:10px;
            margin-bottom: 10px;
        }
        .inline-list{
            margin-top: 30px;
            margin-bottom: 20px;
            padding-left: 20px;
        }
        .inline-list li{
            list-style: none;
            margin-bottom: 15px;
        }
    </style>


    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    
    <meta charset="UTF-8">
    <title>Projects</title>
    </head>
    <body>
        <div class="container-fluid wrapper">
            <?php
            include_once("./templates/new_header.html");
            ?>
            <div class="top-overlay">
            </div>

            <div class="frame-thin">
            </div>

            <div class="row row-no-right-margin">
                <!-- Carousel -->
                
                <div class="col-md-9 content-info">

                    <div class="main-image">
                        <img class="detail-image" src="./public_html/img/detailImg/sample1.jpg">
                    </div>

                    <div class="project-overlay">
                        <h4><?= $project['project_name'] ?></h4>
                        <p><?= $project['description'] ?></p>
                    </div>
                </div>

                <div class="col-md-3 project-info">
                    <ul class="inline-list">
                        <li><?= $project['project_name'] ?></li>
                        <li>LOCATION: <?= $project['location'] ?></li>
                        <li>SIZE: <?= $project['size'] ?></li>
                        <li>COMPLETION DATE: <?= $project['completion_date'] ?></li>
                    </ul>
                    <div class="thumbnails">
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
                </div>

            </div>
            <div class="row frame-thick pull-right">
            </div>
            <!--
            <div class="row">
                <div class="col-md-10 thumbnails">
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-1">
                    </div>
                </div>
            </div>
            -->
        </div> 
    <?php
        //include_once("./templates/footer.php");
    ?>
    <script src="./public_html/js/main.js"></script>
    <script>
        $('.thumbnails').on('click','.thumbnail-link', function(){
            console.log('called');
            $('.main-image').src = $(this).attr('data-img');
        });
    </script>
    </body>
</html>
