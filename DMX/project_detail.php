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
        include_once("./Manager/PhotoManager.php");
        $project_id = filter_input(INPUT_GET, 'project_id');
        $projectMgr = new ProjectManager();
        $photoMgr = new PhotoManager();
        $hdImages = $photoMgr->getHDPhotosByid($project_id);
        $detailImage = $hdImages[0];
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
        .wrapper{
            margin-bottom: 30px;
        }
        /**** change the divider width as the side scroll bar existence ****/
        .navbar-dmx .divider{
            width: 75.7%;
        }
        .detail-thumbnail{
            cursor: pointer;
            z-index: 1029;
            width: 100px;
            height:100px;
            padding:10px;
        }
        .blur{
            opacity: 0.4;
            filter: alpha(opacity=40);
        }
        .detail-thumbnail img{
            width: 80px;
            height: 80px;
        }
        .search_box .form-control:focus{
            border-color: #cccccc;
            -webkit-box-shadow: none;
            box-shadow: none;
        }
        .content-info{
            background-color: rgb(221, 221, 221);
            padding-left: 0;
            padding-right: 0;
        }
        .main-image{
            position:relative;
            height:509px;
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
            width:50%;
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
            position:absolute;
           /* opacity: 0.4;
            filter: alpha(opacity=40); /* For IE8 and earlier */
        }
        .detail-thumbnail:hover, .active-thumbnail-link{
            opacity: 1;
            filter: alpha(opacity=100); /* For IE8 and earlier */
        }
        /*#thumbnails .detail-thumbnail:first-child{
            opacity: 1;
            filter: alpha(opacity=100); 
        }*/
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
        .inline-list li h4{
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
        .pagination li a:hover{
            background-color: rgb(192, 192, 186) !important;
        }
        .not-active {
            pointer-events: none;
            cursor: default;
            background-color:#fff !important;
        }
        footer{
            bottom: auto;
        }
    </style>

    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script>
        function ScaleImage(srcwidth, srcheight, targetwidth, targetheight, fLetterBox) {

            var result = { width: 0, height: 0, fScaleToTargetWidth: true };

            if ((srcwidth <= 0) || (srcheight <= 0) || (targetwidth <= 0) || (targetheight <= 0)) {
                return result;
            }

            // scale to the target width
            var scaleX1 = targetwidth;
            var scaleY1 = (srcheight * targetwidth) / srcwidth;

            // scale to the target height
            var scaleX2 = (srcwidth * targetheight) / srcheight;
            var scaleY2 = targetheight;

            // now figure out which one we should use
            var fScaleOnWidth = (scaleX2 > targetwidth);
            if (fScaleOnWidth) {
                fScaleOnWidth = fLetterBox;
            }
            else {
               fScaleOnWidth = !fLetterBox;
            }

            if (fScaleOnWidth===true) {
                result.width = Math.floor(scaleX1);
                result.height = Math.floor(scaleY1);
                result.fScaleToTargetWidth = true;
            }
            else {
                result.width = Math.floor(scaleX2);
                result.height = Math.floor(scaleY2);
                result.fScaleToTargetWidth = false;
            }
            result.targetleft = Math.floor((targetwidth - result.width) / 2);
            result.targettop = Math.floor((targetheight - result.height) / 2);

            return result;
        }
        </script>
        <script>
        function OnThumbnailImageLoad(evt) {
            var img = evt.currentTarget,
                viewportHeight = window.innerHeight,
                viewportWidth = window.innerWidth;

            // what's the size of this image and it's parent
            var w = img.naturalWidth;
            var h = img.naturalHeight;
            var tw = $(".detail-thumbnail").width();
            var th = $(".detail-thumbnail").height();

            // compute the new size and offsets
            var result = ScaleImage(w, h, tw, th, true);

            // adjust the image coordinates and size
            $(img).width(result.width);
            $(img).height(result.height);
            $(img).css("left", result.targetleft);
            $(img).css("top", result.targettop);
        }

        function OnMainImageLoad(evt) {
            var img = evt.currentTarget;

            // what's the size of this image and it's parent
            var w = img.naturalWidth;
            var h = img.naturalHeight;
            var tw = $(".content-info").width();
            var th = $(".main-image").height();
            if(w - 400 < h){
                // compute the new size and offsets
                $(img).css('position', 'absolute');
                var result = ScaleImage(w, h, tw, th, true);

                // adjust the image coordinates and size
                $(img).width(result.width);
                $(img).height(result.height);
                $(img).css("left", result.targetleft);
                $(img).css("top", result.targettop);
            }else{
                $(img).css('left', '0');
                $(img).width(tw);
                $(img).height(th);
                $(img).css('width', '100%');
                $(img).css('height', '100%');
            }
            
        }
        </script>
    <meta charset="UTF-8">
    <title>Projects</title>
    </head>
    <body>
        <div class="modal fade confirmSubscribeModal" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Subscription</h4>
              </div>
              <div class="modal-body">
                <p>Congradulations! You have successfully subscribed to our newsletter!</p>
              </div>
            </div>
          </div>
        </div>
        <div class="wrapper">
            <?php
            include_once("./templates/new_header.html");
            ?>
            <div class="container-fluid content">
                <div class="above-header-bg">
                </div>
                <div class="below-header-bg">
                </div>
                <div class="row top-overlay">
                </div>

                <!-- <div class="row frame-thin">
                </div> -->

                <div class="row">
                    <!-- Carousel -->
                    
                    <div class="col-md-9 content-info">

                        <div class="main-image">
                            <img class="detail-image" src="<?= $detailImage ?>" onload="OnMainImageLoad(event)">
                        </div>

                        <div class="project-overlay">
                            <h4><?= $project['project_name'] ?></h4>
                            <p><?= $project['description'] ?></p>
                        </div>
                    </div>

                    <div class="col-md-3 project-info">
                        <ul class="inline-list">
                            <li><h4><?= $project['project_name'] ?></h4></li>
                            <li>LOCATION: <?= $project['size'] ?></li>
                            <li>SIZE: <?= $project['location'] ?></li>
                            <li>COMPLETION DATE: <?= date_format($completionDate, 'Y') ?></li>
                        </ul>
                        <div id="loaderID" style="display:none;position:absolute; top:50%; left:50%; z-index:1030; opacity:1"><img src="./public_html/img/ajax-loader.gif" /></div>
                        <div id="results">
                            <!-- <div class="thumbnails">
                                <div class="col-xs-6 col-md-4 detail-thumbnail">
                                        <img class="thumbnail-link active-thumbnail-link" data-img="./public_html/img/AET2/aet2_2.jpg" src="./public_html/img/AET2/aet2_2.jpg">
                                    
                                </div>
                                <div class="col-xs-6 col-md-4 detail-thumbnail">
                                        <img class="thumbnail-link" data-img="./public_html/img/Anacle/ANACLE_2.jpg" src="./public_html/img/Anacle/ANACLE_2.jpg">
                                    
                                </div>
                                <div class="col-xs-6 col-md-4 detail-thumbnail">
                                    <img class="thumbnail-link" data-img="./public_html/img/Anacle/ANACLE_3.jpg" src="./public_html/img/Anacle/ANACLE_3.jpg">
                                    
                                </div>
                                <div class="col-xs-6 col-md-4 detail-thumbnail">
                                    <img class="thumbnail-link" data-img="./public_html/img/detailImg/sample5.jpg" src="./public_html/img/Anacle/ANACLE_4.jpg">
                                    
                                </div>
                                <div class="col-xs-6 col-md-4 detail-thumbnail">
                                    <img class="thumbnail-link" data-img="./public_html/img/detailImg/sample6.jpg" src="./public_html/img/Anacle/ANACLE_5.jpg">
                                    
                                </div>
                                <div class="col-xs-6 col-md-4 detail-thumbnail">
                                    <img class="thumbnail-link" data-img="./public_html/img/detailImg/sample1.jpg" src="./public_html/img/Anacle/ANACLE_6.jpg">
                               
                                </div>
                                <div class="col-xs-6 col-md-4 detail-thumbnail">
                                    <img class="thumbnail-link" data-img="./public_html/img/detailImg/sample2.jpg" src="./public_html/img/Anacle/ANACLE_7.jpg">
                                   
                                </div>
                                <div class="col-xs-6 col-md-4 detail-thumbnail">
                                    <img class="thumbnail-link" data-img="./public_html/img/detailImg/sample4.jpg" src="./public_html/img/Anacle/ANACLE_8.jpg">
                                  
                                </div>
                                <div class="col-xs-6 col-md-4 detail-thumbnail">
                                    <img class="thumbnail-link" data-img="./public_html/img/detailImg/sample5.jpg" src="./public_html/img/Anacle/ANACLE_9.jpg">
                                   
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
                        </div> -->
                    </div>

                </div>
                <div class="frame-thick pull-right">
                </div>
            </div>
        </div>
    </div> 
    <?php
        include_once("./templates/footer.php");
    ?>

    <script src="./public_html/js/jquery.paginate.js"></script>
    <script src="./public_html/js/main.js"></script>
    <script src="./public_html/js/dmx.js"></script>
    <script>
        $(document).ready(function() {
            // kill the filter results session when the page is reloaded
            $("#loaderID").show();
            var project_id = '<?= $project_id ?>';
            var data = 'project_id=' + project_id; //get page number from link
            $.ajax({ //Process the form using $.ajax()
                type      : 'POST', //Method type
                url       : './process_detail_pagination.php', //processing file URL
                data      : data,
                cache     : false,
                success   : function(html) {
                                $('#loaderID').hide();
                                $('#results').html(html);
                                $('#thumbnails .detail-thumbnail:first-child').addClass('active-thumbnail-link');
                                $('#results').show();
                                
                            }
            });

            //executes code below when user click on pagination links
            $("#results").on( "click", ".pagination a", function (e){
                e.preventDefault();
                $('#results').hide();
                $("#loaderID").show(); //show loading element
                var page = $(this).attr("data-page"),
                    data = 'page=' + page, //get page number from link
                    hdImages = $.parseJSON('<?= json_encode($hdImages) ?>');
                $.ajax({ //Process the form using $.ajax()
                    type      : 'POST', //Method type
                    url       : './process_detail_pagination.php', //processing file URL
                    data      : data, 
                    cache     : false,
                    success   : function(html) {
                                    $('#loaderID').hide();
                                    $('#results').html(html);
                                    $('.detail-image').attr('src', hdImages[(page-1)*9]);
                                    $('#thumbnails .detail-thumbnail:first-child').addClass('active-thumbnail-link');
                                    $('#results').show();
                                }
                });

            });
        });
        // add event handler to the future thumbnail-link class
        $("body").delegate('.detail-thumbnail', 'click', function(){
            $('.detail-image').attr('src', $(this).children('.thumbnail-link').attr('data-img'));
            $(".detail-thumbnail").removeClass('active-thumbnail-link');
            $(this).addClass('active-thumbnail-link');
        });
    </script>
    </body>
</html>
