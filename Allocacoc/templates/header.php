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
    
    
    if(message!=="" && message!==null){
        if(status === "success"){
            $('#user_element').append("<div id='popover_element' data-toggle='popover' data-placement='bottom' data-trigger='focus'></div>");
        }else if(status === "fail"){
            $('#user_element').append("<div id='popover_element' data-toggle='popover' data-placement='bottom' data-trigger='focus'></div>");
        }else if(status === "pending"){
            $('#about_element').append("<div id='popover_element' data-toggle='popover' data-placement='bottom' data-trigger='focus'></div>");
        }else{
            $('#about_element').append("<div id='popover_element' data-toggle='popover' data-placement='bottom' data-trigger='focus'></div>");
            $('#user_element').append("<div id='popover_element' data-toggle='popover' data-placement='bottom' data-trigger='focus'></div>");
        }
        $('#popover_element').popover({content: message,html: true});
        $('#popover_element').popover('show');
        window.setTimeout(function(){
            $('#popover_element').popover('hide');
        }, 900000); //6000 are the ms until the timeout is called
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
                            $cart_item_id = 'cartItem'.$each_product_id;
                            $each_product_quantity = $each_cart_item['quantity'];
                            $each_product_name = $productMgr->getProductName($each_product_id);
                            $photoList = $photoMgr->getPhotos($each_product_id);
                            $photo_url = $photoList["1"];
                    ?>
                            <li class="notification" data-itemid = '<?= $cart_item_id ?>' >
                                <div class="cartImg">
                                   <a href="./product_detail.php?selected_product_id=<?=$each_product_id ?>&customer_id=<?=$userid ?>"><img class="cart-image" style="position:absolute !important;" src="<?=$photo_url?>" alt="" onload="OnCartImageLoad(event);" /></a>                             
                                </div>
                                <div class="cart-text-wrap">
                                    <span class="cart-item-text">&nbsp;<a href="./product_detail.php?selected_product_id=<?=$each_product_id ?>&customer_id=<?=$userid ?>" style='font-size:12px'><?=$each_product_name ?></a></span>
                                
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