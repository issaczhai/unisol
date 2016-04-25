<!DOCTYPE html>
<html lang="en">
<head>
    <title>Services</title>
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
    $current = 'services';
    include_once("./template/header.php");
?>

<!--===================content====================-->

<!--<div id="content" class="txt2">
    <section class="bg1 pad1">
        <div class="container_12">
            <div class="grid_4">
                <h4>Main Services</h4>
                <ul class="list1">
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
            </div>
            <div class="grid_8">
                <h4 class="mrg8">Architecture Services</h4>
                <div class="grid_4 alpha">
                    <figure class="mrg10">
                        <img class="img2 img4" src="images/page3_img1.jpg" alt="">
                    </figure>
                    <p class="p4 mrg2"><span class="p5">Lorem ipsum dolor situm ast</span><br>Set, consectetuer adipiscing elit, sed dia nonummy nibh euismod tincidutum laoreet dolore magna aliquamedes erat volutpat.</p>
                    <a class="a3" href="#"><span></span>read more</a>
                </div>
                <div class="grid_4 omega">
                    <figure class="mrg10">
                        <img class="img2 img4" src="images/page3_img2.jpg" alt="">
                    </figure>
                    <p class="p4 mrg2"><span class="p5">Lorem ipsum dolor situm ast</span><br>Set, consectetuer adipiscing elit, sed dia nonummy nibh euismod tincidutum laoreet dolore magna aliquamedes erat volutpat.</p>
                    <a class="a3" href="#"><span></span>read more</a>
                </div>
            </div>
        </div>
    </section>-->

    <section class="bg2 pad2">
        <div class="container_12">
            <div class="grid_12">
                <h4 class="mrg5">Specialized Services</h4>
            </div>
            <div class="grid_12">
                <p class="p4 default-font-family"><span class="p5 custom-p5">Ping Tan Construction Pte Ltd has a history of completing projects within an agreed time frame. Our experienced management and administration staff have the ability to plan and complete projects within the cost/time constraints on any project.</span>
                <br><br>Whether a project comprises construction, from scratch, renovation, repairing, restoration or minor demolition, the company will to adhere to deadlines – which in turn affect time cost scheduling. With that, clearly defined structural measures have been mapped out to ensure smooth processes that ultimately achieve our final target.</p>
                <p class="p4 default-font-family">Ping Tan involved in providing basic and complex construction work such as:</p>
                <ul class="list list-service">
                    <li> Sub-Contracting Works </li>
                    <li>
                        <ul class="list-service-detail">
                            <li>Reinforced Concrete Works</li>
                            <li>Wet Architectural Works i.e. Brickwork, Wall Panel, Plastering, Tiling Works etc</li>
                            <li>Drywall Partition and Ceiling Works</li>
                        </ul>
                    </li>
                    <li> Main Contract works</li>
                    <li>
                        <ul class="list-service-detail">
                            <li>Conventional Building Works for Industrial Factory / Warehouse, Commercial Building, Residential</li>
                            <li>A & A Works to Existing Building</li>
                            <li>Design & Build Construction Projects</li>
                        </ul>
                    </li>
                </ul>
                <!--<a class="a3" href="#"><span></span>read more</a>-->
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