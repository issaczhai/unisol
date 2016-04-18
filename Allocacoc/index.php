<?php
if (session_status()!=PHP_SESSION_ACTIVE) {
session_start();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
        <link rel="stylesheet" href="./public_html/css/carouselHome.css">
        <link rel="stylesheet" href="./public_html/css/main.css">
        <link rel="stylesheet" href="./public_html/css/webShop.css">
        <!-- Scripts -->        
        <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script src="./public_html/js/main.js"></script>
        <script src="./public_html/js/allocacoc.js"></script>
        <!-- full screen carousel style -->
        <style>
             html,body{height:100%;}
            .carousel,.item,.active{height:100%;}
            .carousel-inner{height:100%;}
            //transparent header and bring it z-index up to make full screen carousel, style only for home page
           #myNavbar{ background-color: transparent;
                    background: rgba(248, 248, 248,0.8);
                    border: none;
                    z-index: 100;
                    margin-bottom: 0;
                    border-radius: 0;
           }
           .badge{
               background-color:#AEAEAE;
           }
        </style>
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
        function OnProductBigImageLoad(evt) {
            var img = evt.currentTarget;

            // what's the size of this image and it's parent
            /* var w = $(this).width();
            var h = $(this).height(); */
            var w = img.naturalWidth;
            var h = img.naturalHeight;
            var tw = $(".productImgBig").width();
            var th = $(".productImgBig").height();

            // compute the new size and offsets
            var result = ScaleImage(w, h, tw, th, true);

            // adjust the image coordinates and size
            $(img).width(result.width);
            $(img).height(result.height);
            $(img).css("left", result.targetleft);
            $(img).css("top", result.targettop);
        }
        </script>
        <script>
        function OnProductSmallImageLoad(evt) {
            var img = evt.currentTarget;

            // what's the size of this image and it's parent
            var w = img.naturalWidth;
            var h = img.naturalHeight;
            var tw = $(".productImgSmall").width();
            var th = $(".productImgSmall").height();

            // compute the new size and offsets
            var result = ScaleImage(w, h, tw, th, true);

            // adjust the image coordinates and siz
            $(img).width(result.width);
            $(img).height(result.height);
            $(img).css("left", result.targetleft);
            $(img).css("top", result.targettop);
        }
        </script>
        <script>
        function OnCartImageLoad(evt) {
            var img = evt.currentTarget;

            // what's the size of this image and it's parent
            var w = img.naturalWidth;
            var h = img.naturalHeight;
            var tw = $(".cartImg").width();
            var th = $(".cartImg").height();

            // compute the new size and offsets
            var result = ScaleImage(w, h, tw, th, true);

            // adjust the image coordinates and size
            $(img).width(result.width);
            $(img).height(result.height);
            $(img).css("left", result.targetleft);
            $(img).css("top", result.targettop);
        }
        </script>
        <!-- Latest compiled and minified JavaScript -->
        
        <meta charset="UTF-8">
        <title>Allocacoc</title>
    </head>
<body>
    <script>
        window.fbAsyncInit = function() {
          FB.init({
            appId      : '387511714775185',
            xfbml      : true,
            version    : 'v2.3'
          });
        };

        (function(d, s, id){
           var js, fjs = d.getElementsByTagName(s)[0];
           if (d.getElementById(id)) {return;}
           js = d.createElement(s); js.id = id;
           js.src = "//connect.facebook.net/en_US/sdk.js";
           fjs.parentNode.insertBefore(js, fjs);
         }(document, 'script', 'facebook-jssdk'));
    </script>    
<?php
    include_once("./templates/header.php");
    include_once("./templates/modal.php");
    ?>
    
	<!--<div id="loaderID" style="display:none;position:absolute; top:50%; left:53%; z-index:10; opacity:1"><img src="./public_html/img/ajax-loader.gif" /></div>
        <div class="modal" id="product_detail_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content" id="product_detail_modal_content" style="width:800px">
                
            </div>
            </div>
        </div>-->
    	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Overlay 
                <div class="overlay"></div>-->
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                </ol>
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="./public_html/img/sfeer_Extended_USB.jpg" alt="First slide">
                        <div class="hero">
                            <hgroup>
                                <h1>Extended</h1>        
                                <h3>Get start your next awesome project</h3>
                            </hgroup>
                            <!--<button class="btn btn-hero btn-lg" role="button">See all features</button>-->
                        </div>
            <!-- Static Header -->

                    </div>
                    <div class="item">
                        <img src="./public_html/img/sfeer_Extended.jpg" alt="Second slide">
                        <div class="hero">
                            <hgroup>
                                <h1>Extended USB</h1>        
                                <h3>Get start your next awesome project</h3>
                            </hgroup>
                            <!--<button class="btn btn-hero btn-lg" role="button">See all features</button>-->
                        </div>

                    </div>
                    <div class="item">
                        <img src="./public_html/img/sfeer_ReWirable.jpg" alt="Third slide">
                        <div class="hero">
                            <hgroup>
                                <h1>ReWirable</h1>        
                                <h3>Get start your next awesome project</h3>
                            </hgroup>
                            <!--<button class="btn btn-hero btn-lg" role="button">See all features</button>-->
                        </div>

                    </div>
                    <div class="item">
                        <img src="./public_html/img/sfeer_ReWirable_USB.jpg" alt="Forth slide">
                        <div class="hero">
                            <hgroup>
                                <h1>ReWirable USB</h1>        
                                <h3>Get start your next awesome project</h3>
                            </hgroup>
                            <!--<button class="btn btn-hero btn-lg" role="button">See all features</button>-->
                        </div>

                    </div>
                </div>
                <!-- Controls
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                </a> -->
        </div><!-- /carousel -->


<!-- display product detail modal
<script>
    function getProductDetail(product_id){
        $('#product_detail_modal_content').hide();
        $('#product_detail_modal').modal('show');
        $('#loaderID').show();
        var customer_id = '';
        if(customer_id===null){
            customer_id = '';
        }
        var selected_product_id = 'selected_product_id=' + product_id + '&customer_id=' + customer_id;

        //event.preventDefault();
        $.ajax({ //Process the form using $.ajax()
            type      : 'POST', //Method type
            url       : './process_product_detail.php', //Your form processing file URL
            data      : selected_product_id,
            cache     : false,
            success   : function(html) {
                            $('#loaderID').hide();
                            $('#product_detail_modal_content').html(html);
                            $('#product_detail_modal_content').show();
                        }
        });
    }
</script>
-->
    