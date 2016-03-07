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
    include_once("./template/header.html");
?>

<!--===================content====================-->

<div id="content" class="txt2">

 <section class="bg2 pad2">
        <div class="container_12">
            <div class="grid_12">
                <h4 class="mrg5">DIRECTOR PROFILE：Mr.Lin Cai</h4>
            </div>
            <div class="grid_4">
                <figure class="img1 mrg6">
                    <img class="img6" src="images/director.jpg" alt="">
                </figure>
            </div>
            <div class="grid_8">
                <p class="p4"><span class="p5">As the key person in the business organisation, Mr. Lin Cai has more than fifteen years of experience and is expert in wide engineering, construction projects and business development.</span><br>Having first begun his apprenticeship in 2000, the only director of the company now leads a capable team in the building and construction field.He is well-respected in the building industry, demonstrated through the strong relationships he has established with architects and with his satisfied clients. </p>
                <p class="p4">He is a proven leader, having worked and learnt under strong mentors himself, and his success lies in his commitment to taking a ‘hands-on’ management approach. This allows him to not only guarantee that the highest standard of workmanship and materials is delivered for each project, but also to ensure the best experience for each client through honest and efficient communication and project adaptability. He takes the time to understand the goals and expectations of each client, and works closely with them in generating solutions that will not only look good, but will be functional and durable.</p>
                <p class="p4">His commitment to quality and his well-known industry reputation for honesty and integrity ensure every project is carried out with the upmost professionalism.</p>
            </div>
        </div>
    </section>

    <section class="bg1 pad1">
        <div class="container_12">
            <div class="grid_12">
                <h4 class="mrg8">Our Team</h4>
                <div class="grid_4 alpha">
                    <figure class="mrg10">
                        <img class="img2 img4" src="images/managementteam.jpg" alt="">
                    </figure>
                    <p class="p4 mrg2"><span class="p5">Management Team</span></p>
                </div>
                <div class="grid_4 omega">
                    <figure class="mrg10">
                        <img class="img2 img4" src="images/contractteam.jpg" alt="">
                    </figure>
                    <p class="p4 mrg2"><span class="p5">Contract Team</span>
                    </p>
                </div>
                <div class="grid_4 omega">
                    <figure class="mrg10">
                        <img class="img2 img4" src="images/admin.jpg" alt="">
                    </figure>
                    <p class="p4 mrg2"><span class="p5">Admin/Finance Team</span>
                    </p>
                </div>
            </div>
            <div class="grid_12">
                <div class="grid_4 alpha">
                    <figure class="mrg10">
                        <img class="img2 img4" src="images/SAFETYTEAM.jpg" alt="">
                    </figure>
                    <p class="p4 mrg2"><span class="p5">Site Operation/Safety Team</span></p>
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