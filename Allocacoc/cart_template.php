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
    $productMgr = new ProductManager();
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
<?php
include_once("./protect.php");
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
        <link rel="stylesheet" href="./public_html/css/main.css">
        <link rel="stylesheet" href="./public_html/css/webShop.css">
        
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
    <div class="container">
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
                        <li class="overlay-nav-item">
                            <a class='overlay-text' href="#">shop</a>
                        </li>
                        <li class="overlay-nav-item">
                            <a class='overlay-text' href="#"><i class="fa fa-shopping-cart fa-lg"></i> cart</a>
                        </li>
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
                                <th>products</th>
                                <th>qty</th>
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
                            $each_cart_item_name = $productMgr->getProductName($each_cart_item_id);
                            $each_cart_item_price = $productMgr->getPrice($each_cart_item_id);
                            $each_cart_item_price_format = number_format($each_cart_item_price,2,'.','');
                            $each_cart_item_stock = $productMgr->getStock($each_cart_item_id);
                            $each_cart_item_qty = $each_cart_product['quantity'];
                            $each_cart_item_total = $each_cart_item_price * $each_cart_item_qty;
                            $subtotal += $each_cart_item_total;
                            $qtyid = $each_cart_item_id.'qty';
                            $removeBtnid = $each_cart_item_id.'remove';
                            $each_cart_totalid = $each_cart_item_id.'total';

                        ?>
                           <tr>
                                <td class="col-sm-1 col-md-1 text-center">
                                    <div class="checkbox-cartItem">
                                      <input id="checkbox" type="checkbox">
                                      <label for="checkbox"></label>
                                    </div>
                                </td>
                                <td class="col-sm-8 col-md-6">
                                <div class="media">
                                    <div class="cartItemImg" style="width:88px;height:88px;overflow:hidden;position:relative;float:left">
                                        <a href="javascript:getProductDetail('<?=$each_cart_item_id ?>');"> <img style="position:absolute !important;" src="./public_html/img/GE.png" onload="OnCartItemImageLoad(event)"> </a>
                                    </div>
                                    <div class="media-body" style="padding-left:10px">
                                        <h4 class="media-heading"><a href="#"><?=$each_cart_item_name ?></a></h4>
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
                                </div></td>
                                <td class="col-sm-7 col-md-1" style="text-align: center">
                                <input type="text" style='text-align: center' class="form-control" id="<?=$qtyid?>" onchange="change_qty('<?=$each_cart_item_id?>','<?=$each_cart_item_price_format ?>',this.value)" value="<?=$each_cart_item_qty ?>">
                                </td>
                                <td class="col-sm-1 col-md-1 text-center"><strong><?=number_format($each_cart_item_price,2,'.','') ?></strong></td>
                                <td id='<?=$each_cart_totalid ?>' class="col-sm-1 col-md-1 text-center"><strong><?=number_format($each_cart_item_total,2,'.','')?></strong></td>
                                <td class="col-sm-1 col-md-1">
                                <button type="button" id='<?=$removeBtnid?>' class="btn btn-danger" onclick="location.href='./process_item_remove.php?remove_item_id=<?=$each_cart_item_id?>&customer_id=<?=$userid?>'">
                                    <span class="glyphicon glyphicon-remove"></span> Remove
                                </button></td>
                            </tr> 

                        <?php
                        }
                        $total = $subtotal + $shipping_fee;
                        ?>
                            <tr>
                                <td>   </td>
                                <td>   </td>
                                <td>   </td>
                                <td><h5>Subtotal</h5></td>
                                <td class="text-right"><h5 id='subtotal'><strong><?=number_format($subtotal,2,'.','') ?></strong></h5></td>
                            </tr>
                            <tr>
                                <td>   </td>
                                <td>   </td>
                                <td>   </td>
                                <td><h5>Estimated shipping</h5></td>
                                <td class="text-right"><h5 id='shipping_cost'><strong><?=number_format($shipping_fee,2,'.','') ?></strong></h5></td>
                            </tr>
                            <tr>
                                <td>   </td>
                                <td>   </td>
                                <td>   </td>
                                <td><h3>Total</h3></td>
                                <td class="text-right"><h3 id='total_cost'><strong><?=number_format($total,2,'.','') ?></strong></h3></td>
                            </tr>
                            <tr>
                                <td>   </td>
                                <td>   </td>
                                <td>   </td>
                                <td>
                                <button type="button" class="btn btn-default" onclick="location.href = './shop.php';">
                                    <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
                                </button></td>
                                <td>
                                <button type="button" class="btn btn-success" onclick="location.href = './payment.php';">
                                    Checkout <span class="glyphicon glyphicon-play"></span>
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
                 Continue shopping on the <a href="./shop.php">Allocacoc.com</a>.
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
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <!-- display product detail modal-->
    <script>
        function getProductDetail(product_id){
            $('#product_detail_modal_content').hide();
            $('#product_detail_modal').modal('show');
            $('#loaderID').show();
            var customer_id = '<?=$userid?>';
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
        <script>
            function change_qty(item_id,item_price,qty_to_change){
                console.log(item_id,item_price,qty_to_change);
                var customer_id = '<?=$userid?>';
                console.log(customer_id);
                var changed_product_id = 'changed_item_id=' + item_id + '&qty_to_change=' + qty_to_change + '&customer_id=' + customer_id;
                console.log(changed_product_id);
                var price = qty_to_change * item_price;
                var price_formatted = price.toFixed(2);
                var each_cart_totalid = '#' + item_id + 'total';
                $.ajax({ //Process the form using $.ajax()
                type      : 'POST', //Method type
                url       : './process_qty_change.php', //Your form processing file URL
                data      : changed_product_id,
                cache     : false,
                success   : function(data) {
                                
                                var pos = data.indexOf("{");
                                var dataValid = data.substring(pos);
                                
                                var jsonData = eval("("+dataValid+")");
                                if(jsonData.error){
                                    $('#error_modal').modal('show');
                                    $('#error_modal_content').show();
                                }else{
                                    var subtotal = jsonData.subtotal;
                                    var shipping_fee = jsonData.shipping_fee;
                                    var total = jsonData.total;
                                    $('#subtotal').html('<Strong>'+subtotal+'</Strong>');
                                    $('#shipping_cost').html('<Strong>'+shipping_fee+'</Strong>');
                                    $('#total_cost').html('<Strong>'+total+'</Strong>');
                                    $(each_cart_totalid).html('<Strong>'+price_formatted+'</Strong>'); 
                                }
                                
                            }
                });
                
            }
        </script>
        
        <script>
            function remove_item(item_id){
                var customer_id = '<?=$userid?>';
                var remove_product_id = 'remove_item_id=' + item_id + '&customer_id=' + customer_id;
                $.ajax({ //Process the form using $.ajax()
                type      : 'POST', //Method type
                url       : './process_item_remove.php', //Your form processing file URL
                data      : remove_product_id,
                cache     : false,
                success   : function(html) {
                                $('#loaderID').hide();
                                $('#product_detail_modal_content').html(html);
                                $('#product_detail_modal_content').show();
                            }
                });
                
            }
        </script>
    </body>
</html>
