<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name = "format-detection" content = "telephone=no" />
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/camera.css">
    <link rel="stylesheet" href="css/custom_style.css">
    <script src="js/jquery.js"></script>
    <script src="js/jquery-migrate-1.1.1.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
	<script src="js/script.js"></script>
    <script src="js/superfish.js"></script>
    <script src="js/jquery.ui.totop.js"></script>
    <script src="js/jquery.mobilemenu.js"></script>
    <script src="js/jquery.equalheights.js"></script>
    <script src="js/camera.js"></script>
     <!--[if (gt IE 9)|!(IE)]><!-->
    <script src="js/jquery.mobile.customized.min.js"></script>
     <!--<![endif]-->
    <script>
        $(document).ready(function(){
            jQuery('#camera_wrap').camera({
            loader: false,
            pagination: false,
            minHeight: '250',
            thumbnails: false,
            height: '36%',
            caption: true,
            navigation: true,
            fx: 'mosaic'
            });

      	$().UItoTop({ easingType: 'easeOutQuart' });
        }); 

    </script>
    <!--[if lt IE 8]>
        <div style=' clear: both; text-align:center; position: relative;'>
            <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
            <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
            </a>
      </div>
    <![endif]-->
    <!--[if lt IE 9]>
   		<script src="js/html5shiv.js"></script>
    	<link rel="stylesheet" type="text/css" media="screen" href="css/ie.css">
    <![endif]-->
</head>
<body>

<!--==============================header=================================-->
<?php
    $current = 'home';
    include_once("./template/header.php");
?>

<!--===================content====================-->

<div id="content">
    <div id="camera_wrap">
        <div data-src="images/slide1.jpg">
            <div class="caption fadeIn">
                <p class="p9"><span>committed</span><br>to quality</p>
            </div>
        </div>
        <div data-src="images/slide2.jpg">
            <div class="caption fadeIn">
                <p class="p9"><span>risk</span><br>prevention</p>
            </div>
        </div>
        <div data-src="images/slide3.jpg">
            <div class="caption fadeIn">
                <p class="p9"><span>commitment</span></p>
            </div>
        </div>
    </div>
    <section class="bg1">
        <div class="container_12">
            <div class="grid_12">
                <div class="line"><h2>quality deliverable</h2><br><h2 class="mrg1">is our utmost priority</h2></div>
                <div class="grid_4 alpha">
                    <div class="maxheight block2">
                        <div class="box_inner">
                            <figure class="img1">
                                <img class="img5" src="images/page1_img1.jpg" alt="">
                            </figure>
                            <!-- <a class="a1" href="#"></a> -->
                            <h3>Wet Architectural<br>Work</h3>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="grid_4">
                    <div class="maxheight block2">
                        <div class="box_inner">
                            <figure class="img1">
                                <img class="img5" src="images/page1_img2.jpg" alt="">
                            </figure>
                            <!-- <a class="a1" href="#"></a> -->
                            <h3>Wet Architectural<br>Work</h3>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="grid_4 omega">
                    <div class="maxheight block2">
                        <div class="box_inner">
                            <figure class="img1">
                                <img class="img5" src="images/page1_img3.jpg" alt="">
                            </figure>
                            <!-- <a class="a1" href="#"></a> -->
                            <h3>Design &amp;<br> Build </h3>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg2 txt2">
        <div class="container_12">
            <div class="grid_12">
                <h4 class="txt">featured projects</h4>
            </div>
            <div class="grid_4">
                <div class="block1">
                    <figure>
                        <img class="img2" src="images/ntuc.png" alt="">
                        <div class="image_hover">
                            <!-- <a class="a2" href="#"><img src="images/icon7.png" alt=""></a> -->
                            <span class="p1">Project name:</span><br>NTUC Fairprice
                        </div>
                    </figure>     
                </div>
            </div>
            <div class="grid_4">
                <div class="block1">
                    <figure>
                        <img class="img2" src="images/westbuild.jpg" alt="">
                        <div class="image_hover">
                            <!-- <a class="a2" href="#"><img src="images/icon7.png" alt=""></a> -->
                            <span class="p1">Project name:</span><br>Westbuild
                        </div>
                    </figure>     
                </div>
            </div>
            <div class="grid_4">
                <div class="block1">
                    <figure>
                        <img class="img2" src="images/seagate.jpg" alt="">
                        <div class="image_hover">
                            <!-- <a class="a2" href="#"><img src="images/icon7.png" alt=""></a> -->
                            <span class="p1">Project name:</span><br>Seagate
                        </div>
                    </figure>     
                </div>
            </div>
        </div>
    </section>
</div>

<!--===================footer=====================-->
<?php
    include_once("./template/footer.html");
?>

</body>
</html>