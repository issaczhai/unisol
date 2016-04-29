<!DOCTYPE html>
<html lang="en">
<head>
    <title>Career</title>
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
    <script src="js/pingtan.js"></script>
    <script src="js/request.js"></script>   
    <script src="js/service.js"></script>
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
    $current = 'job detail';
    include_once("./template/header.php");
?>

<!--===================content====================-->

<div id="content" class="txt1">
    <section class="bg2 pad4">
        <div class="container_12">
            <div class="grid_12">
                <h3 id="job-title">Junior JavaScript Developer</h3>
            </div>
            <div class="grid_12">
                <p id="job-location">Singapore</p>
                <p id="job-type">Full-time</p>
            </div>
            <div class="grid_12">
                <h5 class="career-category">Company Description</h5>
                <p class="career-category">PING TAN started their building construction activities in Singapore in 2012. The company has grown in strength to over 300 skilled professionals, who are committed to delivering quality products and services to meet the growing demands of major contractors and developers in the fast-changing world. With these strengths, we have been certified for general construction, professional contractor for building renovation works and professional contractor for RC Structural and Wet & Masonry works.</p>
                <h5 class="career-category">Job Description</h5>
                <p class="career-category" id="job-description">As a business developer, you will work directly with the OpenTelly management team on the development and implementation of the business and expansion strategies for THEOplayer, and will play a strategic role in the further growth of the company.</p>
                <h5>Qualification</h5>
                <ul class="list-qualification">
                    <li>A Master degree in economics, management, finance, law, engineering or computer science with a very strong interest in business developmen</li>
                    <li>Willing to work in an international environment</li>
                </ul>
                <h5>What do we offer?</h5>
                <ul class="list-offer">
                    <li>A competitive salary with plenty of extra benefits.</li>
                    <li>The opportunity to work for an exciting start-up conquering the world.</li>
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