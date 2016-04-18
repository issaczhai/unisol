<?php
    if (session_status()!=PHP_SESSION_ACTIVE) {
        session_start();
    }
    include_once("./Manager/ConnectionManager.php");
    include_once("./Manager/ProductManager.php");
    include_once("./Manager/PhotoManager.php");
    $productMgr = new ProductManager();
    $photoMgr = new PhotoManager();
    $userid = null;
    $username = null;
    
    if(isset($_SESSION["userid"]) && !empty($_SESSION["userid"])){
        // $userid is customer email address
        $userid = $_SESSION["userid"];
        $pos = strpos($userid, "@");
        // $username is displayed in the header
        $username = substr($userid, 0, $pos);
        $cart_items = $productMgr->retrieveFromShoppingCart($userid);
        $cart_total_qty = $productMgr->retrieveTotalNumberOfItemsInShoppingCart($userid);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
        <link rel="stylesheet" href="./public_html/css/main.css">
        <link rel="stylesheet" href="./public_html/css/webShop.css">
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
                margin-left:10px;
                margin-top:23px;
                color: #0087A0;
                font-family: "Century Gothic";
                font-weight: bold;
            }
            .overlay-carousel{
                position:relative;
                background: rgba(0, 0, 0, 0.6);
                height:50px;
                margin-top:-50px;
                padding-top:16.5px;
                z-index:10000;
            }
            .overlay-text{
                color: #fff;
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
        
        <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script> 
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
        <meta charset="UTF-8">
        <title>Allocacoc Webshop</title>
    </head>
    <body>
        <?php
        include_once("./templates/modal.php");
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
                            <a href='./index.php'><img src='public_html/img/allocacoc_NoText.png'></a>
                        </div>
                        <div class="overlay-carousel">
                            <ul class="overlay-nav">
                                <li class="overlay-nav-item item-shop">
                                    <a class='overlay-text' href="./shop.php"><span></span>shop</a>
                                </li>
                                <?php
                                if(empty($cart_items)){
                                ?>
                                <li class="overlay-nav-item item-cart" >
                                    <a class='overlay-text' href="./cart.php"><i class="fa fa-shopping-cart fa-lg"></i> Cart </a>
                                </li>
                                <?php
                                }else{
                                ?>
                                
                                <li class="cart-dropdown overlay-nav-item item-cart" >
                                    
                                    <a class='overlay-text' href="./cart.php"><i class="fa fa-shopping-cart fa-lg"></i> Cart <span class="cart-qty"> ( <?=$cart_total_qty?> ) </span></a>
                                    
                                    <ul role="menu" class="sub-menu">
                                    <?php
                                    if(!empty($cart_items)){
                                        for($x=0;$x<min(4,count($cart_items));$x++){
                                            $each_cart_item = $cart_items[$x];
                                            $each_product_id = $each_cart_item['product_id'];
                                            $each_product_color = $each_cart_item['color'];
                                            $cart_item_id = 'cartItem'.$each_product_id.$each_product_color;
                                            $each_product_quantity = $each_cart_item['quantity'];
                                            $each_product_name = $productMgr->getProductName($each_product_id);
                                            $photoList = $photoMgr->getPhotos($each_product_id);
                                            $photo_url = $photoList[$each_product_color];
                                    ?>
                                            <li class="notification" data-itemid = '<?= $cart_item_id ?>' >
                                                <div class="cartImg">
                                                   <a href="./product_detail.php?selected_product_id=<?=$each_product_id ?>&customer_id=<?=$userid ?>&color=<?=$each_product_color ?>"><img class="cart-image" style="position:absolute !important;" src="<?=$photo_url?>" alt="" onload="OnCartImageLoad(event);" /></a>                             
                                                </div>
                                                <div class="cart-text-wrap">
                                                    <span class="cart-item-text">&nbsp;<a href="./product_detail.php?selected_product_id=<?=$each_product_id ?>&customer_id=<?=$userid ?>&color=<?=$each_product_color ?>" style='font-size:12px'><?=$each_product_name ?></a></span>
                                                
                                                    <span class='item-qty' style='font-size:12px'>&nbsp;Quantity:&nbsp;<?=$each_product_quantity ?></span>
                                                </div>
                                                
                                            </li>
                                    <?php
                                        }
                                    }else{
                                    ?>
                                        <li class="notification empty-cart">
                                            <span style='font-size:12px'>&nbsp;Start Shopping by Adding Product</span>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                        <li class="notification last-notification">
                                            <div class="btn-group-justified">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default" onclick="location.href = './cart.php';">
                                                            Checkout <span class="cart-qty">(<?=$cart_total_qty ?>)</span>
                                                    </button>
                                                </div>
                                            </div> 
                                        </li>
                                        
                                    </ul>
                                </li> 
                                <?php
                                }
                                if(empty($userid)){
                                ?>
                                <li id="sign_in_element" class="overlay-nav-item">
                                    <a class='overlay-text' href="#signup" data-toggle="modal" data-target=".bs-modal-sm">sign in</a>
                                </li>
                                <?php
                                }else{
                                ?>
                                <li id="user_element" class="overlay-nav-item">
                                    <a class='overlay-text' href="./account.php" ><?= $username ?></a>
                                </li>
                                <li class="overlay-nav-item">
                                    <a class='overlay-text' href="./logout.php" >logout</a>
                                </li>
                                <?php
                                }
                                ?> 
                            </ul>
                        </div>
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
            </div><!--/Slider-->
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
        </div>
    </div>
    <?php
    $currentPage = "";
    include_once("./templates/footer.php");
    ?>   
    <script src="//vjs.zencdn.net/4.12/video.js"></script>   
    <script src="./public_html/js/main.js"></script>
    <script src="./public_html/js/allocacoc.js"></script>
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
