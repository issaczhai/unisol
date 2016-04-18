<?php
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
<script type="text/javascript">
$(document).ready(function () {
    var message="";
    var status="";
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    var para = '';
    for (var i = 0; i < sURLVariables.length; i++){
        para = sURLVariables[i];
        if(para!==null && para!==""){
            var sParameterName = para.split('=');
            if (sParameterName[0] === "message") 
            {
                message = decodeURI( sParameterName[1] );
            }else if (sParameterName[0] === "status") 
            {
                status = sParameterName[1];
            }
        
        }
    }
    console.log(status);
    console.log(message);
    if(message!=="" && message!==null){
        if(status === "success"){
            console.log('success');
            $('.referal-symbol img').attr('src', './public_html/img/tick_green.png');
        }else if(status === "fail"){
            console.log('fail');
            $('.referal-symbol img').attr('src', './public_html/img/exclamation_red.png');
        }else if(status === "pending"){
            console.log('pending');
            $('.referal-symbol img').attr('src', './public_html/img/exclamation_red.png');
        }else if(status === "error"){
            console.log('error');
            $('.referal-symbol img').attr('src', './public_html/img/exclamation_red.png');
        }else{
            console.log('out of 3 conditions!');
        }
        console.log("nihao");
        $('.referal-notification-text h5').text(message);
        $('.referal-notification').css('display', 'block');
        $('.referal-notification').delay(6000).fadeOut();
        $(".cart-notification").delay(6000).fadeOut(); //6000 are the ms until the timeout is called
    }
});
</script>
<style>
.popover {
background-color: black;
color: gainsboro;
float: right;
margin-top: 0px;
width: 200px;
height: 75px;
word-break: keep-all;
}
.navbar-default{
    background-image: -webkit-linear-gradient(rgb(223, 223, 223), rgb(248, 248, 248),rgb(223, 223, 223)); /* For Safari 5.1 to 6.0 */
    background-image: -o-linear-gradient(rgb(223, 223, 223), rgb(248, 248, 248),rgb(223, 223, 223)); /* For Opera 11.1 to 12.0 */
    background-image: -moz-linear-gradient(rgb(223, 223, 223), rgb(248, 248, 248),rgb(223, 223, 223)); /* For Firefox 3.6 to 15 */
    background-image: linear-gradient(rgb(223, 223, 223), rgb(248, 248, 248),rgb(223, 223, 223)); /* Standard syntax */
}

</style>

<nav id="myNavbar" class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./index.php">Allocacoc</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="./shop.php"> SHOP</a></li>

                <li><a href="./news.php"> NEWS</a></li>

                <li id="about_element"><a href="#"> ABOUT US</a></li>
                <?php
                // if the user is not logged in
                if(empty($username)){
                    ?>
                    <li id="sign_in_element"><a href="#signup" data-toggle="modal" data-target=".bs-modal-sm" > SIGN IN</a></li>
                    <?php
                // user logged in
                }else{

                if(empty($cart_items)){
                ?>
                    <li class="overlay-nav-item item-cart" >
                        <a class='overlay-text' href="./cart.php"> Cart </a>
                    </li>
                <?php
                }else{
                ?>
                
                <li class="cart-dropdown overlay-nav-item item-cart" >
                    
                    <a class='overlay-text' href="./cart.php"> Cart <span class="cart-qty"> ( <?=$cart_total_qty?> ) </span></a>
                    
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
                ?>
                <li id="user_element"><a href="./account.php" ><?= $username ?></a></li>
                <li><a href="./logout.php" >LOGOUT</a></li>
                <?php
            }
                ?>
            </ul>
        </div>
    </div>
</nav><!--/header-middle-->
<div class='referal-notification'>
    <!-- <svg width="100" height="100">
      <circle cx="50" cy="50" r="30" fill="rgb(0, 89, 112)" />
    <text class='cart-qty-changed' fill="#ffffff" text-anchor="middle" font-size="30" font-family="Verdana" x="50" y="62"></text>
    Sorry, your browser does not support inline SVG.
    </svg> -->
    <div class='referal-symbol'>
        <img />
    </div>
    <div class='referal-notification-text'>
        <h5></h5>
    </div>
</div>