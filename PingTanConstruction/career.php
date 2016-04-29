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
    $current = 'career';
    include_once("./template/header.php");
?>

<!--===================content====================-->

<div id="content" class="txt1">
    <section class="bg2 pad4">
        <div class="container_12 career-content">
            <div class="grid_12">
                <h3 class="mrg5 title-career">Careers at Ping Tan</h3>
                <h5 class="info-career">Thank you for your interest about working at Ping Tan, we don't have any opening position yet! Visit our website frequently to know lastest updates! </h5>
            </div>
            <div class="grid_6 career-category career-category-template">
                <h5 class="mrg5">Business Administration</h5>
                
            </div>
            <article class="article-job job-template">
                <div class="extra_wrapper">
                    <p class="p5 mrg7">Business Administrator</p>
                    <p class="p4 mrg3">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed dia nonummy nibh euismod. tincidut laoreet dolore magna aliquam erat volutpat wisi enim ad miniLorem ipsum.</p>
                    <a class="a3" href="./job_detail.php"><span></span>read more</a>
                </div><div class="clear"></div>
            </article>
        </div> 
    </section>
    <section class="bg2 pad2">
        <div class="container_12">
            <div class="grid_12">
                <h4 class="mrg9">Spontaneous Application</h4>
            </div>
            <div class="grid_12omega">
                    <p class="p4 middle-font-family">You do not see an open position that matches your specific skill-set? 
                    Ping Tan is always looking for the most passionate and talented professionals to strengthen our ambitious team. 
                    If you are interested to work at Ping Tan, get in touch with us! Submit a general application via hr@pingtan.sg.</p>
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