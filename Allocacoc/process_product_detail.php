<?php
include_once("./Manager/ConnectionManager.php");
include_once("./Manager/ProductManager.php");
// define the filter type chosen before sort if any
$selected_product_id = addslashes(filter_input(INPUT_POST, 'selected_product_id'));
$customer_id = addslashes(filter_input(INPUT_POST, 'customer_id'));
$productMgr = new ProductManager();
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
if(!empty($customer_id)){
    
    $selected_product_in_cart = $productMgr->retrieveItemQtyInShoppingCart($customer_id, $selected_product_id);
    
}
?>
    
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="text-danger fa fa-times"></i></button>
              <h4 class="modal-title" id="myModalLabel"><i class="text-muted"></i> <?=$selected_product_name ?> </h4>
            </div>
            
            <div class="modal-body" style="height:500px;width:800px">
               <div>
                    <div style="float:left">
                        <div class="productImgBig" style="width:367px;height:367px;border:1px solid #BDBDBD;margin-bottom:10px">
                        <img src="./public_html/img/GE.png" onload="OnProductBigImageLoad(event)" style="position:absolute" />
                        </div>
                        <div>
                            <div class="productImgSmall" style="width:120px;height:80px;padding-top:1px;border:1px solid #BDBDBD;display:inline-block; cursor:pointer;">
                                <img src="./public_html/img/GE.png" onload="OnProductSmallImageLoad(event)" style="position:relative"/>				
                            </div>
                            <div class="productImgSmall" style="width:120px;height:80px;padding-top:1px;border:1px solid #BDBDBD;display:inline-block;cursor:pointer;">
                                <img src="./public_html/img/GE.png" onload="OnProductSmallImageLoad(event)" style="position:relative"/>				
                            </div>
                            <div class="productImgSmall" style="width:120px;height:80px;padding-top:1px;border:1px solid #BDBDBD;display:inline-block;cursor:pointer;">
                                <img src="./public_html/img/GE.png" onload="OnProductSmallImageLoad(event)" style="position:relative"/>				
                            </div>
                        </div>
                        
                    </div>
                    <div style="border:1px solid #BDBDBD; margin-left:380px;height:457px;;padding-left:5px;padding-right:5px" align="center">
                        <div style='height:80px'>
                            <h3 style="color:#B82E8A">
                            <?=$selected_product_name ?>
                            </h3>
                            <h4 class="pull-right" style="color:#4C4C4C">
                                SGD <?= number_format($selected_product_price,1,'.','') ?>
                            </h4>
                        </div>
                        
                        <div style='height:230px'>
                          <p style="font-family:'Cabin Condensed', serif; font-size:15px; color:#000000;text-align:left">
                            <?=$selected_product_description ?>
                          </p>  
                        </div>
                        
            
                        <?php
                        // display the add to cart button if the product haven't been add before
                            if($selected_product_in_cart==0){
                                
                        ?>
                            <div class="input-group number-spinner pull-left" style="width:40%">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" data-dir="dwn" data-stock='<?=$selected_product_stock ?>'><span class="glyphicon glyphicon-minus"></span></button>
                                </span>
                                <input id='<?=$selected_product_qty_id ?>' type="text"  data-id='<?=$selected_qty_msg_id ?>' data-stock='<?=$selected_product_stock ?>' class="form-control text-center" value="1">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" data-dir="up" data-stock='<?=$selected_product_stock ?>'><span class="glyphicon glyphicon-plus"></span></button>
                                </span>
                                
                            </div>
                            <br><br>
                            <div id='<?=$selected_qty_msg_id ?>' class="pull-left" style="height:20px;margin-bottom:10px;visibility:hidden">
                                <span style="color:red;"><i class="fa fa-ban"></i> Your desired quantity is not available for this product</span>     
                            </div>
                            <div class="btn-group btn-group-justified" role="group" style=''>
                                <div class="btn-group" role="group">
                                    <button id='<?=$selected_add_btn_id ?>' type="button" class="btn btn-default" onclick="addToCart('<?=$selected_product_id ?>')"><span><i class="fa fa-shopping-cart fa-lg"></i> ADD TO CART</span></button>
                                </div>
                            </div>
                        
                        <?php
                        // display the checkout button if the product is already added
                            }else{
                                
                        ?>
                        <!-- 
                            <div class="input-group number-spinner pull-left" style="width:40%">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" data-dir="dwn" data-stock='<?=$selected_product_stock ?>'><span class="glyphicon glyphicon-minus"></span></button>
                                </span>
                                <input id='<?=$selected_product_qty_id ?>' type="text" class="form-control text-center" value="<?=$selected_product_in_cart ?>">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" data-dir="up" data-stock='<?=$selected_product_stock ?>'><span class="glyphicon glyphicon-plus"></span></button>
                                </span>
                            </div>
                        -->
                            <br><br>
                            <div class="btn-group btn-group-justified" role="group" style='margin-bottom: 30px'>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-default" onclick="location.href = './cart.php';"><span>Proceed to Checkout (<?=$selected_product_in_cart ?>)</span></button>
                                </div>
                            </div>
                        
                        <?php
                                
                            }
                        ?>
                        
                    </div>
                </div>     
            </div>
              
