<!DOCTYPE html>
<html lang="en">
<head>
    <title>Projects</title>
    <meta charset="utf-8">
    <meta name = "format-detection" content = "telephone=no" />
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/touchTouch.css">
    <link rel="stylesheet" href="css/custom_style.css">
    <link rel="stylesheet" href="css/style_construction.css">
    
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
    include_once("./template/header.html");
?>

<!--===================content====================-->

<div id="content">
    <section class="bg2 pad1">
        <div class="container_12">
            <div class="grid_12">
                <h4 class="mrg8">our projects</h4>
            </div>
            <ul class="gallery list3">
                <li class="grid_4 maxheight">
                    <div class="box_inner">
                        <a class="lightbox img2" href="images/page4_big1.jpg"><img src="images/page4_img1.jpg" alt=""><span></span></a>
                        <div class="block3"><span class="p6">Project name:</span><br><span class="description">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent vestibulum molestie lacus. Aenean nonummy</span>
                            <!-- <a class="a3 pad3" href="#"><span></span>read more</a> -->
                        </div>
                    </div>
                </li> 
            </ul>
        </div>
    </section>

<div class="project-detail-template">
    <ul class="list-detail">
        <li><span class="title-detail">Contracts: </span><span class="detail-font detail-contract">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent vestibulum molestie lacus. Aenean nonummy</span>
        </li>
        <li><span class="title-detail">Scope of Work: </span><span class="detail-font detail-scope">Web Architecture</span>
        </li>
        <li><span class="title-detail">Value: $</span><span class="detail-font detail-value">1000000</span>
        </li>
        <li><span class="title-detail">Period: </span><span class="detail-font detail-period">1-1-2016 to 12-12-2016</span>
        </li>
        <li><span class="title-detail">Client: </span><span class="detail-font detail-client">Unisol Infotech Pte Ltd</span>
        </li>
    </ul>
</div>
</div>

<!--===================footer=====================-->
<?php
    include_once("./template/footer.html");
?>


<script src="js/jquery.js"></script>
<script src="js/jquery-migrate-1.1.1.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/script.js"></script>
<script src="js/superfish.js"></script>
<script src="js/jquery.ui.totop.js"></script>
<script src="js/jquery.mobilemenu.js"></script>
<script src="js/touchTouch.jquery.js"></script>
<script src="js/jquery.equalheights.js"></script>
<script src="js/pingtan.js"></script>
<script src="js/request.js"></script>
<script src="js/service.js"></script>
<script>
    $(document).ready(function(){
        
        $().UItoTop({ easingType: 'easeOutQuart' });
    }); 

</script>
</body>
</html>