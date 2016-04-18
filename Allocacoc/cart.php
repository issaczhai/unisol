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

    include_once("./protect/customer_protect.php");
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
        <script>
        function OnCartItemImageLoad(evt) {
            var img = evt.currentTarget;

            // what's the size of this image and it's parent
            var w = img.naturalWidth;
            var h = img.naturalHeight;
            var tw = $(".cartItemImg").width();
            var th = $(".cartItemImg").height();

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
        <title>Shopping Cart</title>
    </head>
<body>
    <?php
    
    include_once("./templates/modal.php");
    ?>
    <div id="loader-overlay">
        <div style="position:relative;top:25%; left:50%; opacity:1"><img src="./public_html/img/ajax-loader.gif" /></div>
    </div>
    <!-- Modal Dialog -->
    <div class="modal fade confirmDeleteModal" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Remove Item</h4>
          </div>
          <div class="modal-body">
            <p>Are you sure want to remove this product from your shpping cart?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-cancel-delete" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-delete-item" id="confirm">Remove</button>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
        <div class="row">
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
                                    $item_quantity_id = $each_product_id.$each_product_color.'cartQty';
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
                                    
                                        <span id="<?=$item_quantity_id ?>" class='item-qty' style='font-size:12px'>&nbsp;Quantity:&nbsp;<?=$each_product_quantity ?></span>
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
        
        <div class="row">
            <div class="col-sm-12 col-md-10 col-md-offset-1">
                <?php 
                    if(count($cart_items)>0 && !empty($cart_items)){
                ?>
                    <table class="table table-hover cart-table">
                        <thead>
                            <tr>
                                <th> </th>
                                <th class="text-center">products</th>
                                <th class="text-center">qty</th>
                                <th class="text-center">price</th>
                                <th class="text-center">subtotal</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $subtotal = 0;
                        $shipping_fee = 0;
                        foreach($cart_items as $each_cart_product){
                            $each_cart_item_id = $each_cart_product['product_id'];
                            $each_product_color = $each_cart_product['color'];
                            $each_cart_item_name = $productMgr->getProductName($each_cart_item_id);
                            $each_cart_item_price = $productMgr->getPrice($each_cart_item_id);
                            $each_cart_item_price_format = number_format($each_cart_item_price,2,'.','');
                            $each_cart_item_stock = $productMgr->getStock($each_cart_item_id);
                            $each_cart_item_qty = $each_cart_product['quantity'];
                            $each_cart_item_create_time = $each_cart_product['create_time'];
                            $each_cart_item_total = $each_cart_item_price * $each_cart_item_qty;
                            $subtotal += $each_cart_item_total;
                            $qtyid = $each_cart_item_id.$each_product_color.'qty';
                            $timeid = $each_cart_item_id.$each_product_color.'createtime';
                            $cboxid = $each_cart_item_id."/".$each_product_color.'cbox';
                            $removeBtnid = $each_cart_item_id.$each_product_color.'remove';
                            $each_cart_totalid = $each_cart_item_id.$each_product_color.'total';
                            $photoList = $photoMgr->getPhotos($each_cart_item_id);
                            $photo_url = $photoList[$each_product_color];
                        ?>
                           <tr>
                                <td class="col-sm-1 col-md-1 text-center">
                                    <div class="checkbox-cartItem">
                                      <input id="<?= $cboxid ?>" name="selectItem" type="checkbox" value="<?= $cboxid ?>">
                                      <label for="<?= $cboxid ?>"></label>
                                    </div>
                                </td>
                                <td class="col-sm-8 col-md-5">
                                    <div class="media">
                                        <div class="cartItemImg" style="width:88px;height:88px;overflow:hidden;position:relative;float:left">
                                            <a href="./product_detail.php?selected_product_id=<?=$each_cart_item_id ?>&customer_id=<?=$userid ?>&color=<?=$each_product_color ?>"> <img style="position:absolute !important;" src="<?=$photo_url?>" onload="OnCartItemImageLoad(event)"> </a>
                                            
                                        </div>
                                        <div class="media-body  text-center">
                                            
                                            <h5 class="media-heading"><a href="./product_detail.php?selected_product_id=<?=$each_cart_item_id ?>&customer_id=<?=$userid ?>&color=<?=$each_product_color ?>"><?=$each_cart_item_name ?></a></h5>
                                            <?php
                                            if($each_cart_item_stock>0){
                                            ?>
                                            <span>Stock: </span><span class="text-success"><strong><?=$each_cart_item_stock?></strong></span>
                                            <?php
                                            }else{
                                            ?>
                                            <span>Stock: </span><span class="text-danger"><strong>Out of Stock</strong></span>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </td>
                                <td class="col-sm-7 col-md-2" style="text-align: center">
                                    <input type="text" style='text-align: center; border-radius:0' class="form-control" id="<?=$qtyid?>" onchange="change_qty('<?=$each_cart_item_id?>','<?=$each_cart_item_price_format ?>',this.value, '<?=$each_product_color ?>')" value="<?=$each_cart_item_qty ?>">
                                    <input type="hidden" id="<?=$timeid?>" value="<?=$each_cart_item_create_time?>"/>
                                </td>
                                <td class="col-sm-1 col-md-1 text-center"><strong><?=number_format($each_cart_item_price,2,'.','') ?></strong></td>
                                <td id='<?=$each_cart_totalid ?>' class="col-sm-1 col-md-1 text-center"><strong><?=number_format($each_cart_item_total,2,'.','')?></strong></td>
                                <td class="col-sm-1 col-md-1">
                                <button type="button" id='<?=$removeBtnid?>' data-color='<?=$each_product_color ?>' class="btn btn-remove">
                                <!-- onclick="location.href='./process_item_remove.php?remove_item_id=<?=$each_cart_item_id?>&customer_id=<?=$userid?>'" -->
                                    <span class="glyphicon glyphicon-remove"></span>
                                </button></td>
                            </tr> 

                        <?php
                        }
                        if($subtotal > 100){
                            $shipping_fee = 0;
                        }else{
                            $shipping_fee = 5;
                        }
                        $total = $subtotal + $shipping_fee;
                        ?>
                            <tr>
                                <td>   </td>
                                <td>   </td>
                                <td>   </td>
                                <td>   </td>
                                <td><h5>Subtotal</h5></td>
                                <td class="text-right"><h5 id='subtotal'><strong class="cart-amount"><?=number_format($subtotal,2,'.','') ?></strong></h5></td>
                            </tr>
                            <tr>
                                <td>   </td>
                                <td>   </td>
                                <td>   </td>
                                <td>   </td>
                                <td><h5>Estimated shipping</h5></td>
                                <td class="text-right"><h5 id='shipping_cost'><strong class="cart-amount"><?=number_format($shipping_fee,2,'.','') ?></strong></h5></td>
                            </tr>
                            <tr>
                                <td>   </td>
                                <td>   </td>
                                <td>   </td>
                                <td>   </td>
                                <td><h3>Total</h3></td>
                                <td class="text-right"><h3 id='total_cost'><strong class="cart-amount"><?=number_format($total,2,'.','') ?></strong></h3></td>
                            </tr>
                            <tr>
                                <td>   </td>
                                <td>   </td>
                                <td>   </td>
                                <td>   </td>
                                <td>
                                <button type="button" class="btn btn-default" onclick="location.href = './shop.php';">
                                    <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
                                </button></td>
                                <td>
                                <button type="button" class="btn btn-checkOut" onclick="proceedToPayment();">
                                <span>Checkout</span>
                                </button></td>
                            </tr>
                        </tbody>
                    </table>
                
                <?php
                    }else{
                ?>
                <h2>Your Shopping Cart is Empty.</h2>
                <p>
                 Your Shopping Cart lives to serve. Give it purpose — fill it with our products. 
                 Continue shopping on the <a href="./webShop.php">Allocacoc.com</a>.
                </p>
                <?php
                    }
                ?>
                
            </div>
        </div>
    </div>
    <?php
    $currentPage = "cart";
    include_once("./templates/footer.php");
    ?>
    
    <script src="./public_html/js/jquery.redirect.js"></script>
    <script src="./public_html/js/main.js"></script>
    <script src="./public_html/js/allocacoc.js"></script>

<script>
    function change_qty(item_id,item_price,qty_to_change, item_color){
        $('#loader-overlay').css('display','block');
        var customer_id = '<?=$userid?>';
        var changed_product_id = 'changed_item_id=' + item_id + '&qty_to_change=' + qty_to_change + 
                                '&customer_id=' + customer_id + '&color=' + item_color;
        
        var price = qty_to_change * item_price;
        var price_formatted = price.toFixed(2);
        var each_cart_totalid = '#' + item_id + item_color +　'total';
        $.ajax({ //Process the form using $.ajax()
        type      : 'POST', //Method type
        url       : './process_qty_change.php', //Your form processing file URL
        data      : changed_product_id,
        cache     : false,
        success   : function(data) {
                        
                        $('#loader-overlay').css('display','none');
                        var pos = data.indexOf("{");
                        var dataValid = data.substring(pos);
                        var jsonData = eval("("+dataValid+")");
                        if(jsonData.error){
                            $('#error_modal').modal('show');
                            $('#error_modal_content').show();
                        }else{
                            var subtotal = jsonData.subtotal,
                                shipping_fee = jsonData.shipping_fee,
                                total = jsonData.total,
                                cart_total_qty = jsonData.cart_total_qty,
                                notification_quantity_id = '#' + item_id + item_color + 'cartQty';
                            $('#subtotal').html('<Strong>'+subtotal+'</Strong>');
                            $('#shipping_cost').html('<Strong>'+shipping_fee+'</Strong>');
                            $('#total_cost').html('<Strong>'+total+'</Strong>');
                            $('.cart-qty').text(' ( ' + cart_total_qty + ' ) ');
                            $(notification_quantity_id).text(' Quantity: ' + qty_to_change);
                            $(each_cart_totalid).html('<Strong>'+price_formatted+'</Strong>'); 
                            
                        }
                        
                    }
        });
        
    }

    $('.btn-remove').on('click', function(){
        var id = this.id;
        $('.confirmDeleteModal').attr('id', id.substr(0, id.length - 6));
        $('.confirmDeleteModal').data('color', $(this).data('color'));
        $('.confirmDeleteModal').modal('show');
    });
    $('.btn-delete-item').on('click', function(){
        var confirmModalId = $('.confirmDeleteModal').attr('id');
            product_id = confirmModalId.substr(0, confirmModalId.length - 6),
            color = $('.confirmDeleteModal').data('color');
        //$('.confirmDeleteModal').modal('hide');
        location.href ="./process_item_remove.php?remove_item_id=" + product_id +"&customer_id=<?=$userid?>&color=" + color;

    });
    $('.btn-cancel-delete').on('click', function(){
        
        $('.confirmDeleteModal').modal('hide');

    });

    function proceedToPayment(){
        var checkoutList = [];
        var cB = document.getElementsByName("selectItem");
        for (i = 0; i < cB.length; i++) {
            if (cB[i].checked) {
                var id = cB[i].value.split("/")[0];
                var color = cB[i].value.split("/")[1].split("cbox")[0];
                var item = { //Fetch form data
                    'productId'     : id, //Store productId of item
                    'color'         : color,
                    'quantity'   : $('#'+id+color+'qty').val(), //Store quantity of item
                    'create_time'   : $('#'+id+color+'createtime').val()
                };
                checkoutList.push(item);
            }
        }
        var data = JSON.stringify(checkoutList);
        console.log(data);
       $.redirect('payment.php', checkoutList);
    }
</script>

    </body>
</html>
