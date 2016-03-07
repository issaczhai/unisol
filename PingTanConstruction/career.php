<!DOCTYPE html>
<html lang="en">
<head>
    <title>Blog</title>
    <meta charset="utf-8">
    <meta name = "format-detection" content = "telephone=no" />
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/custom_style.css">
    <script src="js/jquery.js"></script>
    <script src="js/jquery-migrate-1.1.1.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
	<script src="js/script.js"></script>
    <script src="js/superfish.js"></script>
    <script src="js/jquery.ui.totop.js"></script>
    <script src="js/jquery.mobilemenu.js"></script>

    <script>
        $(document).ready(function(){

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
    $current = 'career';
    include_once("./template/header.php");
?>

<!--===================content====================-->

<div id="content" class="txt1">
    <section class="bg2 pad4">
        <div class="container_12">
            <div class="grid_8">
                <h4 class="mrg5">blog</h4>
                <article>
                    <figure class="img3">
                        <img class="img5" src="images/page5_img1.jpg" alt="">
                    </figure>
                    <div class="extra_wrapper">
                        <p class="p5 mrg7">Lorem ipsum dolor situm ast  consectetuer adipiscing</p>
                        <div class="p7">
                            <time class="page4" datetime="2013-01-01">10.22.2013</time> &nbsp;|&nbsp; posted by: <a class="a5" href="#">admin</a> &nbsp;&nbsp;|&nbsp;&nbsp; <a class="a5" href="#">comments: 7</a>
                        </div>
                        <p class="p4 mrg3">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed dia nonummy nibh euismod. tincidut laoreet dolore magna aliquam erat volutpat wisi enim ad miniLorem ipsum.</p>
                        <p class="p4 mrg3">Vestibulum tincidunt pulvinar sapien, non lacinia leo elementum quis.Duis dolor metus, euismod in quam sedaugue.</p>
                        <a class="a3" href="#"><span></span>read more</a>
                    </div><div class="clear"></div>
                </article>
                <article>
                    <figure class="img3">
                        <img class="img5" src="images/page5_img2.jpg" alt="">
                    </figure>
                    <div class="extra_wrapper">
                        <p class="p5 mrg7">Lorem ipsum dolor situm ast  consectetuer adipiscing</p>
                        <div class="p7">
                            <time class="page4" datetime="2013-01-01">10.22.2013</time> &nbsp;|&nbsp; posted by: <a class="a5" href="#">admin</a> &nbsp;&nbsp;|&nbsp;&nbsp; <a class="a5" href="#">comments: 7</a>
                        </div>
                        <p class="p4 mrg3">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed dia nonummy nibh euismod. tincidut laoreet dolore magna aliquam erat volutpat wisi enim ad miniLorem ipsum.</p>
                        <p class="p4 mrg3">Vestibulum tincidunt pulvinar sapien, non lacinia leo elementum quis.Duis dolor metus, euismod in quam sedaugue.</p>
                        <a class="a3" href="#"><span></span>read more</a>
                    </div><div class="clear"></div>
                </article>
                <article>
                    <figure class="img3">
                        <img class="img5" src="images/page5_img3.jpg" alt="">
                    </figure>
                    <div class="extra_wrapper">
                        <p class="p5 mrg7">Lorem ipsum dolor situm ast  consectetuer adipiscing</p>
                        <div class="p7">
                            <time class="page4" datetime="2013-01-01">10.22.2013</time> &nbsp;|&nbsp; posted by: <a class="a5" href="#">admin</a> &nbsp;&nbsp;|&nbsp;&nbsp; <a class="a5" href="#">comments: 7</a>
                        </div>
                        <p class="p4 mrg3">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed dia nonummy nibh euismod. tincidut laoreet dolore magna aliquam erat volutpat wisi enim ad miniLorem ipsum.</p>
                        <p class="p4 mrg3">Vestibulum tincidunt pulvinar sapien, non lacinia leo elementum quis.Duis dolor metus, euismod in quam sedaugue.</p>
                        <a class="a3" href="#"><span></span>read more</a>
                    </div><div class="clear"></div>
                </article>
            </div>
            <div class="grid_4">
                <h4>Categories</h4>
                <ul class="list1 brd">
                    <li><a href="#">Lorem ipsum dolor sit amet conse</a></li>
                    <li><a href="#">Adipiscing elit sed dia nonummy nibh</a></li>
                    <li><a href="#">Esmod tincidut laoreet dolore magna</a></li>
                    <li><a href="#">Aiquam erat volutpatwisi enim ad minim</a></li>
                    <li><a href="#">Wniamquis nostrud exercita</a></li>
                    <li><a href="#">Ullamcorper suscipit lobortis</a></li>
                    <li><a href="#">Et aliq Lorem ipsum dolor sit amet</a></li>
                    <li><a href="#">Ensectetuer adipiscing elit sed</a></li>
                    <li><a href="#">Sonummy nibh euismod tincidut</a></li>
                </ul>
                <h4>archives</h4>
                <ul class="list1">
                    <li><a href="#">November - 2013</a></li>
                    <li><a href="#">October - 2013</a></li>
                    <li><a href="#">September - 2013</a></li>
                    <li><a href="#">August - 2013</a></li>
                    <li><a href="#">July - 2013</a></li>
                    <li><a href="#">June - 2013</a></li>
                </ul>
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