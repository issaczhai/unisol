<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contacts</title>
    <meta charset="utf-8">
    <meta name = "format-detection" content = "telephone=no" />
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/custom_style.css">
    <script src="js/jquery.js"></script>
    <script src="js/jquery-migrate-1.1.1.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
	<script src="js/script.js"></script>
    <script src="js/superfish.js"></script>
    <script src="js/jquery.ui.totop.js"></script>
    <script src="js/jquery.mobilemenu.js"></script>
    <script src="js/TMForm.js"></script>
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
    $current = 'contacts';
    include_once("./template/header.php");
?>

<!--===================content====================-->

<div id="content">
    <section class="bg2 pad5">
        <div class="container_12">
            <div class="grid_5">
                <h4 class="mrg8">Postal Address</h4>
                <div class="map">
                    <figure class="img2 box-shadow">
                        <iframe src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=LHK+3+BUILDING,Singapore&amp;aq=0&amp;sll=1.342054,103.885598&amp;ie=UTF8&amp;hq=&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe>
                    </figure>
                    <address>
                        <dl> 
                            <dt>8 New Industrial Road, Singapore 536200 LHK 3 Building #06-04</dt>
                            <dd><span>Telephone:</span><span id="telephone">+65 6747 6711</span></dd>
                            <dd><span>Fax:</span><span id="fax">+65 6747 6711</span></dd>
                            <dd><span>Email:</span><span id="email">info@pingtan.com</span></dd>
                        </dl>
                   </address>
                </div>
            </div>
            <div class="grid_7">
                <h4 class="mrg8">Contact Form</h4>
                <form id="form">    
                    <div class="success_wrapper">
                        <div class="success-message">Contact form submitted</div>
                    </div>
                    <label class="name">
                        <input type="text" placeholder="Name:" data-constraints="@Required @JustLetters" />
                        <span class="empty-message">*This field is required.</span>
                        <span class="error-message">*This is not a valid name.</span>
                    </label>
                    <label class="email">
                        <input type="text" placeholder="E-mail:" data-constraints="@Required @Email" />
                        <span class="empty-message">*This field is required.</span>
                        <span class="error-message">*This is not a valid email.</span>
                    </label>
                    <label class="phone">
                        <input type="text" placeholder="Phone:" data-constraints="@Required @JustNumbers"/>
                        <span class="empty-message">*This field is required.</span>
                        <span class="error-message">*This is not a valid phone.</span>
                    </label>
                    <label class="message">
                        <textarea placeholder="Message:" data-constraints='@Required @Length(min=20,max=999999)'></textarea>
                        <span class="empty-message">*This field is required.</span>
                        <span class="error-message">*The message is too short.</span>
                    </label>
                    <div>
                        <div class="clear"></div>
                        <div class="btns">
                            <a class="btn" href="#" data-type="reset">Clear<span></span></a>
                            <a class="btn" href="#" data-type="submit">Send<span></span></a>
                        </div>
                    </div>
                </form>
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