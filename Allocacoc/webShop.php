<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
        <link rel="stylesheet" href="./public_html/css/main.css">
        <link href="//vjs.zencdn.net/4.12/video-js.css" rel="stylesheet">
        <style>
            body{
                background-color:#EBEBEB;
            }
            #carousel-bounding-box{
                float:none;
                margin:0 auto;
            }
            .carousel-inner{
                height:424px;
            }
            .item{
                height:424px;
                padding-left:0px;
            }
            .mainPic{
                margin-bottom:10px
            }
            #slider-thumbs, #video_gallary{
                float:none;
                margin:0 auto;
                    
            }
            .thumbnail{
                padding:10px;
                border:none;
                background:none;
            }
            .active{
                padding-left: 0;
            }
            .allocacocLogo{
                position:absolute;
                margin-left:30px;
                margin-top:-426px;
                z-index:1000;
            }
            .logoText{
                position:absolute;
                margin-left:-100px;
                margin-top:40px;
                color: #8F006B;
            }
            .overlay-carousel{
                background-color: #fff;
                height:50px;
                margin-top:-50px;
                padding-top:16.5px;
                opacity:0.6
            }
            .overlay-nav-item{
                display: inline;
                margin-top:17px
            }
            .overlay-nav > li:nth-child(2){
                margin-left:20px
            }
            .overlay-text{
                color: #626262;
                font-weight: 400;
                font-size: 16px;
            }
            
            .vjs-default-skin .vjs-big-play-button{
                width:2.6em;
                border-radius: 50%;
            }
            .vjs-default-skin.vjs-big-play-centered .vjs-big-play-button{
                margin-left: -1.3em;
                margin-top:-1.0000000000000001em;
            }
        </style>
        <meta charset="UTF-8">
        <title>Allocacoc Webshop</title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
    <div class="container">
        <div id="main_area">
            <!-- Slider -->
            <!-- Top part of the slider -->
            <div class="row mainPic">
                <div class="col-sm-10" id="carousel-bounding-box">
                    
                    <div class="carousel slide" id="myCarousel">
                        <!-- Carousel items -->
                        <div class="carousel-inner">
                            <div class="active item" data-slide-number="0">
                                <img src="./public_html/img/carouselMainPic/Banner Fr.312.png">
                            </div>

                            <div class="item" data-slide-number="1">
                                <img src="./public_html/img/carouselMainPic/D3.jpg">
                            </div>

                            <div class="item" data-slide-number="2">
                                <img src="./public_html/img/carouselMainPic/PowerCube UK.png">
                            </div>

                            <div class="item" data-slide-number="3">
                                <img src="./public_html/img/carouselMainPic/PowerCube.png">
                            </div>
                        </div>
                        <div class='allocacocLogo'>
                            <img src='public_html/img/allocacoc.png'><span class='logoText'>Webshop</span>
                        </div>
                        <div class="overlay-carousel">
                            <ul class="overlay-nav">
                                <li class="overlay-nav-item">
                                    <a class='overlay-text' href="#"><span></span>shop</a>
                                </li>
                                <li class="overlay-nav-item">
                                    <a class='overlay-text' href="#"><i class="fa fa-shopping-cart fa-lg"></i> cart</a>
                                </li>
                            </ul>
                        </div>
                        <!-- Carousel nav 
                        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>                                       
                        </a>
                        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>                                       
                        </a>   
                        -->
                    </div>
                </div>
            </div>    
            <div class="row">
                <div class="col-sm-7" id="slider-thumbs">
                    <!-- Bottom switcher of slider -->
                    
                    
                    <div class="col-sm-3 thumbnail">
                        <a id="carousel-selector-0"><img src="./public_html/img/carouselThumb/Banner Fr.312.png"></a>
                    </div>
                    
                    <div class="col-sm-3 thumbnail">
                        <a id="carousel-selector-1"><img src="./public_html/img/carouselThumb/D3.jpg"></a>
                    </div>
                    
                    <div class="col-sm-3 thumbnail">
                        <a id="carousel-selector-2"><img src="./public_html/img/carouselThumb/PowerCube UK.png"></a>
                    </div>
                    
                    <div class="col-sm-3 thumbnail">
                        <a id="carousel-selector-3"><img src="./public_html/img/carouselThumb/PowerCube.png"></a>
                    </div>
                </div>
            </div>
            <div class='row'>
                <div id='video_gallary' class='col-sm-8' style='height:350px;'>
                    <video id="example_video_1" class="video-js vjs-default-skin vjs-big-play-centered"
                        controls preload="auto" width="100%" height="100%"
                        src="https://s3-ap-southeast-1.amazonaws.com/allocacocvideo/Allocacoc+PowerCube+Remote+double+click+-+YouTube+%5B360p%5D.mp4"
                        poster="https://s3-ap-southeast-1.amazonaws.com/allocacocvideo/Remote+Double+Click.png"
                        data-setup='{"example_option":true}'>

                    </video>
                </div>
            </div>
        </div><!--/Slider-->
            <!-- 
            <div class="row hidden-xs" id="slider-thumbs">
                                   
            </div>
            -->
        </div>

        <?php
        include_once("./templates/footer.php");
        ?>
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>    
    <script src="//vjs.zencdn.net/4.12/video.js"></script>   
    <!-- Carousel -->
    <script>
    jQuery(document).ready(function($) {
 
        $('#myCarousel').carousel({
                interval: 5000
        });

        //Handles the carousel thumbnails
       $('[id^=carousel-selector-]').click( function(){
            var id = this.id.substr(this.id.lastIndexOf("-") + 1);
            var id = parseInt(id);
            $('#myCarousel').carousel(id);
        });
    });
    </script>
    </body>
</html>
