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

$selected_product_id = addslashes(filter_input(INPUT_GET, 'selected_product_id'));
$product_selected = $productMgr->getProduct($selected_product_id);
$selected_product_name = $product_selected['product_name'];
$selected_product_description = $product_selected['description'];
$selected_product_price = $product_selected['price'];
$selected_product_stock = $product_selected['stock'];  
$selected_product_qty_id = $selected_product_id.'qty';
$selected_qty_msg_id = $selected_product_id.'msg';
$selected_add_btn_id = $selected_product_id.'btn';
//if the customer is not logged in, the default quantity of product in the cart is 0
$selected_product_in_cart = 0;
//if customer is logged in, check if the product is in the cart

$selected_product_photoList = $photoMgr->getPhotos($selected_product_id);
$selected_product_photo_url = $selected_product_photoList["2"];

if(!empty($userid)){
    
    $selected_product_in_cart = $productMgr->retrieveItemQtyInShoppingCart($userid, $selected_product_id);
    
}


?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./public_html/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public_html/font-awesome-4.1.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./public_html/css/main.css">
    <link rel="stylesheet" href="./public_html/css/webShop.css">
    <script src="./public_html/js/jquery-1.11.0.js"></script>
    <script src="./public_html/js/bootstrap.min.js"></script> 
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
    <title><?= $selected_product_name ?></title>
</head>
<body>
<?php
    include_once("./templates/modal.php");
?>
<div id="loader-overlay">
    <div style="position:relative;top:25%; left:50%; opacity:1"><img src="./public_html/img/ajax-loader.gif" /></div>
</div>
<div class='container'>
    <div class='row'>
        <div class='col-sm-10 banner'>
            <div class='col-sm-12 bannerPhoto'>
            <img src='./public_html/img/shopHeadBG/bg.png'>    
            </div>
            
            <div class='allocacocLogo'>
                <a href='./index.php'><img src='public_html/img/allocacoc_NoText.png'></a>
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
                        <a class='overlay-text' href="./cart.php"><i class="fa fa-shopping-cart fa-lg"></i> Cart <span class="cart-qty"> ( <?=$cart_total_qty?> ) </span></a>
                        <?php
                        }else{
                        ?>
                        <a class='overlay-text' href="./cart.php"><i class="fa fa-shopping-cart fa-lg"></i> Cart <span class="cart-qty"></span></a>
                        <?php
                        }
                        ?>

                            <ul role="menu" class="sub-menu">
                        <?php
                        if(!empty($cart_items)){
                            for($x=0;$x<min(4,count($cart_items));$x++){
                                $each_cart_item = $cart_items[$x];
                                $each_product_id = $each_cart_item['product_id'];
                                $cart_item_id = 'cartItem'.$each_product_id;
                                $each_product_quantity = $each_cart_item['quantity'];
                                $each_product_name = $productMgr->getProductName($each_product_id);
                                $photoList = $photoMgr->getPhotos($each_product_id);
                                $photo_url = $photoList["1"];
                        ?>
                                <li class="notification" data-itemid = '<?= $cart_item_id ?>' >
                                    <div class="cartImg" style="width:50px;height:50px;float:left;overflow:hidden;position:relative;">
                                       <a href="./product_detail.php?selected_product_id=<?=$each_product_id ?>&customer_id=<?=$userid ?>"><img class="cart-image" style="position:absolute !important;" src="<?=$photo_url?>" alt="" onload="OnCartImageLoad(event);" /></a>                             
                                    </div>
                                    <span>&nbsp;<a href="./product_detail.php?selected_product_id=<?=$each_product_id ?>&customer_id=<?=$userid ?>" style='font-size:12px'><?=$each_product_name ?></a></span>
                                        <br>
                                    <span class='item-qty' style='font-size:12px'>&nbsp;Quantity:&nbsp;<?=$each_product_quantity ?></span>
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
                            <li class="notification-template notification" data-itemId = ''>
                                <div class="cartImg" style="width:50px;height:50px;float:left;overflow:hidden;position:relative;">
                                   <a class="product-img-link" href="#"><img class="cart-image" style="position:absolute !important;" src="" alt="" onload="OnCartImageLoad(event);" /></a>                             
                                </div>
                                <span>&nbsp;<a class="product-name-link" href="#" style='font-size:12px'></a></span>
                                    <br>
                                    <span class="item-qty" style='font-size:12px'>&nbsp;Quantity: </span>
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
    </div>
    
    <div class="row">
        <div class="col-sm-10 product-detail">
            <div class="col-sm-4 img-detail">
                <img src='<?=$selected_product_photo_url?>'/>
            </div>

            <div class="col-sm-8 product-overview">
                <h2 class="product-name"><?= $selected_product_name ?></h2>
                <span>multiply your socket</span>
                <h3 class="price-lg"><?= number_format($selected_product_price,1,'.','') ?><span> incl.VAT</span></h3>
               <!-- <form class="cart-form"> -->
                    <div class="form-wrapper">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default">
                                <span class="sort-value">5ft (1.5m) cable</span>
                            </button>
                            <button type="button" class="btn btn-default dropdown-toggle"
                                    data-toggle="dropdown">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <?php
                                    
                                ?>
                                <li><a href="#">10ft (2.0m) cable</a></li>
                                <li><a href="#">15ft (2.5m) cable</a></li>
                                <li><a href="#">20ft (3.0m) cable</a></li>
                                <li><a href="#">25ft (3.5m) cable</a></li>
                            </ul>
                        </div>
                        <br>
                        <div class="btn-group color-selection">
                               <div>Colors </div>
                               <div class="color">
                                   <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                   <label for="inlineRadio3" style="background-color: rgb(31, 92, 153)">
                                   </label>
                               </div>
                               <div class="color">
                                   <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option1">
                                   <label for="inlineRadio3" style="background-color: rgb(31, 92, 153)">
                                   </label>
                               </div>
                               <div class="color">
                                   <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option1">
                                   <label for="inlineRadio3" style="background-color: rgb(31, 92, 153)">
                                   </label>
                               </div>
                               <div class="color">
                                   <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option1">
                                   <label for="inlineRadio3" style="background-color: rgb(31, 92, 153)">
                                   </label>
                               </div>
                                
                        </div>
                       
                        <div class="input-group number-spinner">
                            <span class="qty-text">qty  </span>
                            <span class="input-group-btn">
                                <button class="btn btn-default" data-dir="dwn" data-stock=''><span class="glyphicon glyphicon-minus"></span></button>
                            </span>
                            <input id='<?=$selected_product_qty_id ?>' type="text"  data-id='<?=$selected_qty_msg_id ?>' data-stock='<?=$selected_product_stock ?>' class="form-control text-center qty-input" value="1">
                            <span class="input-group-btn">
                                <button class="btn btn-default" data-dir="up" data-stock='<?=$selected_product_stock ?>'><span class="glyphicon glyphicon-plus"></span></button>
                            </span>

                        </div>

                        <button id='<?=$selected_add_btn_id ?>' class="btn cart-button" onclick="addToCart('<?=$selected_product_id ?>')"> add to cart </button>
                        
                           <!--  <button class="btn btn-default cart-button" onclick="javascript:window.location='./cart.php';"> <span>proceed to checkout</span> </button> -->
                        
                    </div>
              <!--  </form> -->
            </div>

        </div>
        
    </div>
    <div class="row">
        <div class="col-sm-10  product-description">
            <div class="row single-characteristic">
                <div class="col-sm-2">
                <img src='./public_html/img/questionMark.png'>
                </div>

                <div class="col-sm-10 char-description">
                <p>
                    <?= $selected_product_description ?>
                </p>
                </div>
            </div>
            
            <div class="row single-characteristic">
                <div class="col-sm-2">
                <img src='./public_html/img/lightBulb.png'>
                </div>

                <div class="col-sm-10 char-description">
                    <h4><?= $selected_product_name ?></h4>
                </div>
            </div>

            <div class="row single-characteristic">
                <div class="col-sm-2">
                <img src='./public_html/img/tick-lg.png'>
                </div>

                <div class="col-sm-10 char-description">
                    <ul>
                        <li>Provides five additional outlets, and can expand to even more outlets when combined</li>
                        <li>Prevents plugs from blocking each other, due to cubic shape</li>
                        <li>Compact design</li>
                    </ul>
                </div>
            </div>

            <div class="row single-characteristic">
                <div class="col-sm-2">
                <img src='./public_html/img/star.png'>
                </div>

                <div class="col-sm-10 char-description">
                    <ul>
                        <li>Provides five additional outlets, and can expand to even more outlets when combined</li>
                        <li>Prevents plugs from blocking each other, due to cubic shape</li>
                        <li>Compact design</li>
                    </ul>
                </div>
            </div>
        </div>
        
    </div>
</div>
<?php
$currentPage = "product";
include_once("./templates/footer.php");
?>

<script src="./public_html/js/allocacoc.js"></script>
<script>
$(document).on('click', '.number-spinner button', function () {    
    console.log($(this).attr('data-stock'));
    
    var oldValue = $(this).closest('.number-spinner').find('input').val();
    var newVal = 0;
    var stock = $(this).attr('data-stock');
    if ($(this).attr('data-dir') === 'up') {
        if(parseInt(oldValue)<stock){
            newVal = parseInt(oldValue) + 1;
        }else{
            //$(this).addClass('disabled');
            newVal = stock;
        }
    } else {
            console.log('down');
            if (oldValue > 1) {
                    newVal = parseInt(oldValue) - 1;
            } else {
                    newVal = 1;
            }
    }
    console.log(newVal);
    $('.number-spinner').find('input').val(newVal);
});

function changeImg(source){
    document.getElementById('display_img').src = source;
}
</script>
</body>
</html>
