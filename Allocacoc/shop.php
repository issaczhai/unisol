<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
/*
$filter_type = '';
$sort_type = '';
if(isset($_SESSION["filter_type"]) && !empty($_SESSION["filter_type"])){
    $filter_type = $_SESSION["filter_type"];
}
if(isset($_SESSION["sort_type"]) && !empty($_SESSION["sort_type"])){
    $sort_type = $_SESSION["sort_type"];
}

 */
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
        <link rel="stylesheet" href="./public_html/css/main.css">
        <link rel="stylesheet" href="./public_html/css/webShop.css">
        <!--<link href="//vjs.zencdn.net/4.12/video-js.css" rel="stylesheet">-->
        <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        
        <style>
            .navbar{opacity: 1;margin-bottom:0}
            .product-image-wrapper{margin-bottom:0px;}
            .product-image-wrapper:hover {border:1px solid #B82E8A;-webkit-transition: all 0.4s ease-out;-moz-transition: all 0.4s ease-out;  /* FF4+ */-o-transition: all 0.4s ease-out;  /* Opera 10.5+ */-ms-transition: all 0.4s ease-out;  /* IE10? */transition: all 0.4s ease-out;}
             
            /* #top_bar {position: relative;width:1140px;z-index:2;background:#FFF;margin-top:20px}  */
            .top-bar, #main-content{
                float:none;
                margin:0 auto;
                padding-right: 0;
                padding-left: 0;
            }
            #cart_btn{background:#B82E8A;color:#FFFFFF}
            /* apply to all pages */
            ul.refine_bar{
                list-style-type: none;
                border:1px solid #E6E6E6;
                height:40px;
            }
            
            ul.refine_bar > li{display: inline-block}
            li.filter{position:absolute;margin-top: 10px;}
            ul.refine_bar li > a{cursor:pointer;padding:5px;color:#737373}
            ul.refine_bar li > a:hover{color:rgb(0, 89, 112)}
            .productImgSmall{
                margin:0 auto;
                transition:All 1s ease;
                -webkit-transition:All 1s ease;
                -moz-transition:All 1s ease;
                -o-transition:All 1s ease;
            }
            #firstThumb{-webkit-box-shadow: 2px 2px 20px rgb(155, 155, 155);
                        -moz-box-shadow: 2px 2px 20px rgb(155, 155, 155);
                        box-shadow: 2px 2px 20px rgb(155, 155, 155);
                        transition:All 1s ease;
            }
            .productImgSmall:hover{
                
                -ms-transform: scale(1.2,1.2); /* IE 9 */
                -webkit-transform: scale(1.2,1.2); /* Safari */
                transform: scale(1.2,1.2);
            }
            #lastThumb{-webkit-box-shadow: 2px 2px 20px rgb(155, 155, 155);
                       -moz-box-shadow: 2px 2px 20px rgb(155, 155, 155);
                       box-shadow: 2px 2px 20px rgb(155, 155, 155);
            }
            .between,.middle{-webkit-box-shadow: 2px 2px 20px rgb(185, 185, 185);
                     -moz-box-shadow: 2px 2px 20px rgb(185, 185, 185);
                     box-shadow: 2px 2px 20px rgb(185, 185, 185);
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
        <!-- On load product image -->
        <script>
        function OnProductImageLoad(evt) {
            var img = evt.currentTarget;

            // what's the size of this image and it's parent
            var w = img.naturalWidth;
            var h = img.naturalHeight;
            var tw = $(".productImg").width();
            var th = $(".productImg").height();

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
        <meta charset="UTF-8">
        <title>Allocacoc Shop</title>
</head>
<body>
<?php
//include_once("./templates/header.php");
include_once("./templates/modal.php");
/*
if(!empty($sort_type) || !empty($filter_type)){
    if(empty($sort_type)){
        
    }else if(empty($filter_type)){
        
    }else{
        
    }
}else{
    $allProducts = $productMgr->getAllProduct(); 
}
*/
$results = [];
//print_r(isset($_SESSION['results']));
//if(isset($_SESSION['results']) && !empty($_SESSION['results'])){
    //$results = $_SESSION['results'];
//}else{
$results = $productMgr->getAllProduct();
//}
?>
<div id="loader-overlay">
    <div style="position:relative;top:25%; left:50%; opacity:1"><img src="./public_html/img/ajax-loader.gif" /></div>
</div>
 
<!-- Content Modal-->
<!--<div style='position:fixed;width:100%;margin-top:-20px;height:20px;background:#FFF;z-index:2'></div>-->

<div class="container">
        <!--
        <div id='video_gallary' style='width:800px;height:400px;padding-left:15px;padding-right:15px;'>
            <video id="example_video_1" class="video-js vjs-default-skin vjs-big-play-centered"
                controls preload="auto" width="100%" height="100%"
                src="https://s3-ap-southeast-1.amazonaws.com/allocacocvideo/Allocacoc+PowerCube+Remote+double+click+-+YouTube+%5B360p%5D.mp4"
                poster="https://s3-ap-southeast-1.amazonaws.com/allocacocvideo/Remote+Double+Click.png"
                data-setup='{"example_option":true}'>
                
            </video>
            
            
        </div>
        <ul style="display:inline;float:right;padding-right:45px;margin-top:-400px">
            <li>
                <div class="productImgSmall" id="firstThumb" style="width:150px;height:80px;padding-top:1px;cursor:pointer;">
                    <img src="https://s3-ap-southeast-1.amazonaws.com/allocacocvideo/Remote+Double+Click.png" onload="OnProductSmallImageLoad(event)" onclick="changeVideo('https://s3-ap-southeast-1.amazonaws.com/allocacocvideo/Allocacoc+PowerCube+Remote+double+click+-+YouTube+%5B360p%5D.mp4','https://s3-ap-southeast-1.amazonaws.com/allocacocvideo/Remote+Double+Click.png')" style="position:relative"/>				
                </div>
            </li>
            <li>
                <div class="productImgSmall between" style="width:155px;height:80px;padding-top:1px;cursor:pointer;">
                    <img src="https://s3-ap-southeast-1.amazonaws.com/allocacocvideo/Powercube+Review.png" onload="OnProductSmallImageLoad(event)" onclick="changeVideo('https://s3-ap-southeast-1.amazonaws.com/allocacocvideo/PowerCube+review+-+YouTube+%5B360p%5D.mp4','https://s3-ap-southeast-1.amazonaws.com/allocacocvideo/Powercube+Review.png')" style="position:relative"/>				
                </div>
            </li>
            <li>
                <div class="productImgSmall middle" style="width:160px;height:80px;padding-top:1px;cursor:pointer;">
                    <img src="https://s3-ap-southeast-1.amazonaws.com/allocacocvideo/UK.png" onload="OnProductSmallImageLoad(event)" onclick="changeVideo('https://s3-ap-southeast-1.amazonaws.com/allocacocvideo/Powercube+UK+with+Music.mp4','https://s3-ap-southeast-1.amazonaws.com/allocacocvideo/UK.png')" style="position:relative"/>				
                </div>
            </li>
            <li>
                <div class="productImgSmall between" style="width:155px;height:80px;padding-top:1px;cursor:pointer;">
                    <img src="https://s3-ap-southeast-1.amazonaws.com/allocacocvideo/Standard+Romantic.png" onload="OnProductSmallImageLoad(event)" onclick="changeVideo('https://s3-ap-southeast-1.amazonaws.com/allocacocvideo/%E2%96%B6+The+PowerCube+-+A+romantic+standard.+-+YouTube+%5B720p%5D.mp4','https://s3-ap-southeast-1.amazonaws.com/allocacocvideo/Standard+Romantic.png')" style="position:relative"/>				
                </div>
            </li>
            <li>
                <div id="lastThumb" class="productImgSmall" style="width:150px;height:80px;padding-top:1px;cursor:pointer;">
                    <img src="https://s3-ap-southeast-1.amazonaws.com/allocacocvideo/Coming+Home.png" onload="OnProductSmallImageLoad(event)" onclick="changeVideo('https://s3-ap-southeast-1.amazonaws.com/allocacocvideo/%E2%96%B6+The+PowerCube+Remote+-+Coming+Home+-+YouTube+%5B720p%5D.mp4','https://s3-ap-southeast-1.amazonaws.com/allocacocvideo/Coming+Home.png')" style="position:relative"/>				
                </div>
            </li>
        </ul>
        -->
    <div class="row">
    <div class='col-sm-10 banner'>
        <div class='col-sm-12 bannerPhoto'>
        <img src='./public_html/img/shopHeadBG/bg.png'>    
        </div>
        
        <div class='allocacocLogo'>
            <img src='public_html/img/allocacoc_NoText.png'><span class='logoText'>Webshop</span>
        </div>
        
        <div class="col-sm-12 overlay">
            <ul class="overlay-nav">
                <li class="overlay-nav-item item-shop">
                            <a class='overlay-text' href="./shop.php"><span></span>shop</a>
                </li>
                <li class="cart-dropdown overlay-nav-item item-cart" >
                    <?php
                    if(!empty($cart_items)){
                    ?>
                    <a class='overlay-text' href="./cart.php"><i class="fa fa-shopping-cart fa-lg"></i> Cart <span> ( <?=$cart_total_qty?> ) </span></a>
                    <?php
                    }else{
                    ?>
                    <a class='overlay-text' href="./cart.php"><i class="fa fa-shopping-cart fa-lg"></i> Cart <span></span></a>
                    <?php
                    }
                    ?>

                        <ul role="menu" class="sub-menu">
                    <?php
                    if(!empty($cart_items)){
                        for($x=0;$x<min(4,count($cart_items));$x++){
                            $each_cart_item = $cart_items[$x];
                            $each_product_id = $each_cart_item['product_id'];
                            $each_product_quantity = $each_cart_item['quantity'];
                            $each_product_name = $productMgr->getProductName($each_product_id);
                            $photoList = $photoMgr->getPhotos($each_product_id);
                            $photo_url = $photoList["1"];
                    ?>
                             <li class="notification">
                                <div class="cartImg" style="width:50px;height:50px;float:left;overflow:hidden;position:relative;">
                                   <a href="./product_detail.php?selected_product_id='<?=$each_product_id ?>'&customer_id='<?=$userid ?>'"><img class="cart-image" style="position:absolute !important;" src="<?=$photo_url?>" alt="" onload="OnCartImageLoad(event);" /></a>                             
                                </div>
                                <span>&nbsp;<a href="./product_detail.php?selected_product_id='<?=$each_product_id ?>'&customer_id='<?=$userid ?>'" style='font-size:12px'><?=$each_product_name ?></a></span>
                                    <br>
                                    <span style='font-size:12px'>&nbsp;Quantity: <?=$each_product_quantity ?></span>
                            </li> 
                    <?php
                        }
                    }else{
                    ?>
                            <li class="notification">
                                <span style='font-size:12px'>&nbsp;Start Shopping by Adding Product</span>
                            </li>

                            <li class="notification last-notification">
                                <div class="btn-group-justified">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default" onclick="location.href = './cart.php';">
                                                View All Items <span class="cart-qty">(<?=$cart_total_qty ?>)</span>
                                        </button>
                                    </div>
                                </div> 
                            </li>
                    <?php
                    }
                    ?>
                        
                    </ul>
                </li>
                <?php 
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
    <div class="col-sm-10 top-bar">
        <ul class="refine_bar">
            <li class='filter' style='margin-left:0px'><a class='filter_link active_filter' id='allproducts' href="javascript:filter('allproducts')" style='background:rgb(0, 89, 112);color:#FFF;border-radius:3px'>All</a></li>
            <li class='filter' style='margin-left:30px'><a class='filter_link' id='PowerCube' href="javascript:filter('PowerCube')">PowerCube</a></li>
            <li class='filter' style='margin-left:122px'><a class='filter_link' id='ReWirable' href="javascript:filter('ReWirable')">ReWirable</a></li>
            <li class='filter' style='margin-left:205px'><a class='filter_link' id='Remote' href="javascript:filter('Remote')">Remote</a></li>
            <li class='pull-right' style='height:100%'>
                <div class="btn-group" style='height:100%'>
                    <button type="button" class="btn btn-default dropdown-toggle" style='border-radius:0;border-right:none;border-top:none;border-bottom:none;border-left:1px solid #E6E6E6;height:100%'
                            data-toggle="dropdown">
                            <span class="sort-value" id='sort_type'>Default Sorting</span> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" style="width:100%">
                        <li><a href="javascript:sort('default');">Default Sorting</a></li>
                        <li><a href="javascript:sort('priceLH');">Price: Low To High</a></li>
                        <li><a href="javascript:sort('priceHL');">Price: High To Low</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
    </div>
    <div class="row" style='margin-top:20px'>
        <!-- Side panel 
        <div  id="sidebar" class="col-sm-2">
            <div class="btn-group-justified">
                <div class="btn-group sort-panel">
                    <button type="button" class="btn btn-default dropdown-toggle"
                            data-toggle="dropdown">
                            <span class="sort-value" id='sort_type'>Default Sorting</span> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" style="width:100%">
                        <li><a href="./shop.php">Default Sorting</a></li>
                        <li><a href="javascript:sort('priceLH');">Price: Low To High</a></li>
                        <li><a href="javascript:sort('priceHL');">Price: High To Low</a></li>
                    </ul>
                </div>
            </div>
            <br>
            <div class="btn-group-justified">
                <div class="btn-group sort-panel">
                    <button type="button" class="btn btn-default" value="allproducts" onclick="filter('allproducts')">
                            <span class="sort-value">All Products</span>
                    </button>
                </div>
            </div>
            <br>
            <div class="btn-group-justified">
                <div class="btn-group sort-panel">
                    <button type="button" class="btn btn-default" onclick="filter('PowerCube')"> 
                            <span class="sort-value">PowerCube Family</span>
                    </button>
                </div>
            </div>
            <br>
            <div class="btn-group-justified">
                <div class="btn-group sort-panel">
                    <button type="button" class="btn btn-default" onclick="filter('ReWirable')">
                            <span class="sort-value">ReWirable Family</span>
                    </button>
                </div>
            </div>
            <br>
            <div class="btn-group-justified">
                <div class="btn-group sort-panel">
                    <button type="button" class="btn btn-default" onclick="filter('Remote')">
                            <span class="sort-value">Remote Family</span>
                    </button>
                </div>
            </div>
            
        </div>
        -->
        <div class="col-sm-10" id="main-content">
            
            <div class="features_items">
            <!--<h2 class="title text-center">All Products</h2>-->
            
                <?php
                    
                    foreach ($results as $eachProduct) {
                        $product_name = $eachProduct["product_name"];
                        $price = $eachProduct["price"];
                        $product_id = $eachProduct["product_id"];
                        $photoList = $photoMgr->getPhotos($product_id);
                        $photo_url = $photoList["1"];
                ?>
                <div class='col-sm-6 each-product'>
                    <div class='product-wrapper'>
                        <div class='product-img'>
                            <a href="./product_detail.php?selected_product_id=<?=$product_id ?>&customer_id=<?=$userid ?>">
                            <img src='<?=$photo_url?>'>
                            </a>
                        </div>
                        <div class='product-summary'> 
                            <h5 style="word-wrap:break-word" class="product-name">
                            <a href='./product_detail.php?selected_product_id=<?=$product_id ?>&customer_id=<?=$userid ?>'>
                            <?= $product_name ?>
                            </a>
                            </h5>
                            <h5 class="price">$<?= number_format($price,1,'.','') ?> <span> incl.VAT</span></h5>
                        </div>
                    </div>
                </div>
                <!--
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                           <div class="productinfo text-center">
                               <div class="productImg" style="width:206px;height:238px;overflow:hidden;position:relative">
                                   <a href="./product_detail.php?selected_product_id=<?=$product_id ?>&customer_id=<?=$userid ?>"><img class="product-image" style="position:absolute !important;" src="./public_html/img/GE.png" alt="" onload="OnProductImageLoad(event);" /></a>
                               </div>
                               
                               <div style="height:45px">
                                   <a href="./product_detail.php?selected_product_id=<?=$product_id ?>&customer_id=<?=$userid ?>" style="text-decoration: none;"><h5><?=$product_name ?></h5></a>
                               </div>
                               <p>SGD </p>
                               
                           </div>
                        </div>
                    </div>
                </div>
                -->
                <?php
    
                    }

                ?>
            </div>
             
        </div>
   
    </div>
    
</div>
<?php
$currentPage = "product";
include_once("./templates/footer.php");
?>
    <!-- Scripts -->        
    
    
    <script src="./public_html/js/main.js"></script>
    <script src="./public_html/js/allocacoc.js"></script>
    
    <!-- Filter -->
    <script>
        function filter(filter_type) {
            $('#loader-overlay').css('display','block');
            //set all link background and color to default
            $('.filter_link').css('background','#FFF');
            $('.filter_link').css('color','#B2B2B2');
            $('.filter_link').removeClass('active_filter');
            //highlight the clicked link background and color
            $('#'+filter_type).css('background','rgb(0, 89, 112)');
            $('#'+filter_type).css('color','#FFF');
            $('#'+filter_type).css('border-radius','3px');
            $('#'+filter_type).addClass('active_filter'); 
            
            //Validate fields if required using jQuery
            var customer_id = '<?=$userid?>';
            var filter_data = 'filter_type=' + filter_type + '&customer_id=' + customer_id;;
            
            //event.preventDefault();
            $.ajax({ //Process the form using $.ajax()
                type      : 'POST', //Method type
                url       : './process_filter.php', //Your form processing file URL
                data      : filter_data, //Forms name
                cache     : false,
                success   : function(html) {
                                $('#loaderID').hide();
                                $('#sort_type').text('Default Sorting');
                                $(".features_items").html(html);
                                $('#loader-overlay').css('display','none');
                            }
            });
    }
    </script>
    <!-- Sort -->
    <script>
        function sort(sort_type) {
            $('#loader-overlay').css('display','block');
            //Validate fields if required using jQuery
            var filter_type = $('.active_filter').text();
            var customer_id = '<?=$userid?>';
            var sort_data = 'filter_type=' + filter_type + '&sort_type=' + sort_type + '&customer_id=' + customer_id;
            //event.preventDefault();
            $.ajax({ //Process the form using $.ajax()
                type      : 'POST', //Method type
                url       : './process_sort.php', //Your form processing file URL
                data      : sort_data,
                cache     : false,
                success   : function(html) {
                                $('#loaderID').hide();
                                if(sort_type==='priceHL'){
                                    $('#sort_type').text('Price: High To Low');
                                }else if(sort_type==='priceLH'){
                                    $('#sort_type').text('Price: Low To High');
                                }else{
                                    $('#sort_type').text('Default Sorting');
                                }
                                $(".features_items").html(html);
                                $('#loader-overlay').css('display','none');
                            }
            });
    }
    </script>
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
    
    <!-- change image 
    <script>
        function changeVideo(source,poster){
            var video = document.getElementById('example_video_1_html5_api');
            console.log(video);
            video.pause();
            video.setAttribute('src',source);
            video.setAttribute('poster',poster);
            document.getElementById('example_video_1').setAttribute('poster',poster);
            $("#example_video_1 .vjs-poster").css('background-image', 'url('+ poster + ')').show();
            video.load();
            
        }
    </script>
    <script src="//vjs.zencdn.net/4.12/video.js"></script>-->
</body>
</html>
