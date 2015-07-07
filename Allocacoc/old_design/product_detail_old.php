<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include_once("./Manager/ConnectionManager.php");
include_once("./Manager/ProductManager.php");
// define the filter type chosen before sort if any
$selected_product_id = addslashes(filter_input(INPUT_GET, 'selected_product_id'));
$customer_id = filter_input(INPUT_GET, 'customer_id');

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
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
        <link rel="stylesheet" href="./public_html/css/main.css">
        <style>
            .cartButton {
                    -moz-box-shadow:inset 0px 1px 0px 0px #e184f3;
                    -webkit-box-shadow:inset 0px 1px 0px 0px #e184f3;
                    box-shadow:inset 0px 1px 0px 0px #e184f3;
                    background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #c123de), color-stop(1, #a20dbd));
                    background:-moz-linear-gradient(top, #c123de 5%, #a20dbd 100%);
                    background:-webkit-linear-gradient(top, #c123de 5%, #a20dbd 100%);
                    background:-o-linear-gradient(top, #c123de 5%, #a20dbd 100%);
                    background:-ms-linear-gradient(top, #c123de 5%, #a20dbd 100%);
                    background:linear-gradient(to bottom, #c123de 5%, #a20dbd 100%);
                    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#c123de', endColorstr='#a20dbd',GradientType=0);
                    background-color:#B82E8A;
                    -moz-border-radius:6px;
                    -webkit-border-radius:6px;
                    border-radius:6px;
                    border:1px solid #a511c0;
                    display:inline-block;
                    cursor:pointer;
                    color:#ffffff;
                    font-family:Arial;
                    font-size:18px;
                    font-weight:bold;
                    padding-top:12px;
                    padding-bottom:12px;
                    width:100%;
                    text-decoration:none;
                    text-shadow:0px 1px 0px #9b14b3;
            }
            .cartButton:hover {
                    background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #a20dbd), color-stop(1, #c123de));
                    background:-moz-linear-gradient(top, #a20dbd 5%, #c123de 100%);
                    background:-webkit-linear-gradient(top, #a20dbd 5%, #c123de 100%);
                    background:-o-linear-gradient(top, #a20dbd 5%, #c123de 100%);
                    background:-ms-linear-gradient(top, #a20dbd 5%, #c123de 100%);
                    background:linear-gradient(to bottom, #a20dbd 5%, #c123de 100%);
                    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#a20dbd', endColorstr='#c123de',GradientType=0);
                    background-color:#a20dbd;
            }
            .cartButton:active {
                    position:relative;
                    top:1px;
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
        <title></title>
    </head>
    <body>
        <?php
        include_once("./templates/header.php");
        include_once("./templates/modal.php");
        ?>
        <div class="container" style='margin-top:100px'>
            <div class='row'>
                <div class='col-sm-8'>
                    <!--<div style="float:left">-->
                        <div class="productImgBig" style="width:100%;height:400px;border:1px solid #BDBDBD; border-radius: 10px;margin-bottom:10px">
                        <img id='display_img' src="./public_html/img/GEU.png" onload="OnProductBigImageLoad(event)" style="position:absolute" />
                        </div>
                        <div>
                            <div class="productImgSmall" style="width:120px;height:80px;padding-top:1px;border:1px solid #BDBDBD;display:inline-block; cursor:pointer;">
                                <img src="./public_html/img/GE.png" onload="OnProductSmallImageLoad(event)" onclick="changeImg('./public_html/img/GE.png')" style="position:relative"/>				
                            </div>
                            <div class="productImgSmall" style="width:120px;height:80px;padding-top:1px;border:1px solid #BDBDBD;display:inline-block;cursor:pointer;">
                                <img src="./public_html/img/GE.png" onload="OnProductSmallImageLoad(event)" style="position:relative"/>				
                            </div>
                            <div class="productImgSmall" style="width:120px;height:80px;padding-top:1px;border:1px solid #BDBDBD;display:inline-block;cursor:pointer;">
                                <img src="./public_html/img/GE.png" onload="OnProductSmallImageLoad(event)" style="position:relative"/>				
                            </div>
                        </div>

                    <!--</div>-->
                </div>
                
                <div class='col-sm-4' style='padding:10px'>
                    <!--<div style="border:1px solid #BDBDBD; margin-left:380px;height:457px;;padding-left:5px;padding-right:5px" align="center">-->
                        <div style='height:80px'>
                            <h3 style="color:#B82E8A">
                            <?=$selected_product_name ?>
                            </h3>
                            <h4 class="pull-left" style="color:#4C4C4C">
                                SGD <?= number_format($selected_product_price,1,'.','') ?>
                            </h4>
                        </div>

                        <div style='height:220px;border-top:1px solid #BDBDBD;padding-top:10px'>
                          <p style="font-family:'Cabin Condensed', serif; font-size:15px; color:#000000;text-align:left">
                            <?=$selected_product_description ?>
                          </p>  
                        </div>
                        <p>Quantity</p>

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
                            <br><br><br>
                            <!--<div id='<?=$selected_qty_msg_id ?>' class="pull-left" style="height:20px;margin-bottom:10px;visibility:hidden">
                                <span style="color:red;"><i class="fa fa-ban"></i> Your desired quantity is not available for this product</span>     
                            </div>
                            <div class="btn-group btn-group-justified" role="group" style=''>
                                <div class="btn-group" role="group">
                                    
                                </div>
                            </div>-->
                            <div style='text-align: center;width:100%'>
                            <button id='<?=$selected_add_btn_id ?>' class='cartButton disabled' type="button" style='' onclick="addToCart('<?=$selected_product_id ?>')"><span><i class="fa fa-shopping-cart fa-lg"></i> ADD TO CART</span></button>
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
                            <div class="btn-group btn-group-justified" role="group" style='margin-bottom: 30px;width:50%'>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-default" onclick="location.href = './cart.php';"><span>Proceed to Checkout (<?=$selected_product_in_cart ?>)</span></button>
                                </div>
                            </div>

                        <?php

                            }
                        ?>

                    <!--</div>-->
                    
                </div>
                
            </div>
            
            
            
        </div>
    <script src="./public_html/js/main.js"></script>
    <!-- Login -->
    <script>
        function login() {
        $('#errorMsgRegister').html("");
        $('#login').submit(function(event) { //Trigger on form submit

            //Validate fields if required using jQuery
            var postForm = { //Fetch form data
                'userid'     : $('#userid').val(), //Store userid fields value
                'pwdInput'   : $('#passwordinput').val(), //Store userid fields value
                'status'     : '',
                'message'    : ''
            };

            $.ajax({ //Process the form using $.ajax()
                type      : 'POST', //Method type
                url       : './process_login.php', //Your form processing file URL
                data      : postForm, //Forms name
                success   : function(data) {
                                console.log(data);
                                var pos = data.indexOf("{");
                                var dataValid = data.substring(pos);
                                var jsonData = eval("("+dataValid+")");
                                if (!jsonData.success) { 
                                        //If fails
                                        $('#errorMsg').html(jsonData.errors); 

                                }else{
                                    var status = jsonData.status;
                                    var message = jsonData.message;
                                    if (typeof status === 'undefined'){
                                        status = '';
                                    }
                                    if (typeof message === 'undefined'){
                                        message = '';
                                    }
                                    if(status !== ''){
                                        window.location='./shop.php?status='+status+'&message='+message;
                                    }else{
                                        window.location='./shop.php';
                                    }
                                }
                            }
            });
            event.preventDefault(); //Prevent the default submit
        });
    };
    </script>

    <!-- Register -->
    <script>
        function register() {

        $('#errorMsgRegister').html("");
        $('#register').submit(function(event) { //Trigger on form submit

            //Validate fields if required using jQuery
            var postForm = { //Fetch form data
                'email'     : $('#email').val(), //Store userid fields value
                'pwd'   : $('#password').val(), //Store password fields value
                'pwdConfirm'   : $('#reenterpassword').val(),//Store password confirm fields value
                'status'       : '',
                'message'      : ''
            };

            $.ajax({ //Process the form using $.ajax()
                type      : 'POST', //Method type
                url       : './process_register.php', //Your form processing file URL
                data      : postForm, //Forms name
                success   : function(data) {

                                var pos = data.indexOf("{");
                                var dataValid = data.substring(pos);
                                var jsonData = eval("("+dataValid+")");
                                if (!jsonData.success) { 
                                        //If fails
                                        $('#errorMsgRegister').html(jsonData.errors); 

                                }else{
                                    var status = jsonData.status;
                                    var message = jsonData.message;
                                    if (typeof status === 'undefined'){
                                        status = '';
                                    }
                                    if (typeof message === 'undefined'){
                                        message = '';
                                    }
                                    if(status !== ''){
                                        window.location='./shop.php?status='+status+'&message='+message;
                                    }else{
                                        window.location='./shop.php';
                                    }
                                }
                            }
            });
            event.preventDefault(); //Prevent the default submit
        });
    };
    </script>
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
    </script>
<!-- remind msg for quantity exceed stock-->
    <script>
        $(document).on('keyup', '.number-spinner input', function () {    
            
            var value = $(this).val();
            var stock = $(this).attr('data-stock');
            var id_get = $(this).attr('data-id');
            var product_id = id_get.substr(0,id_get.length-3);
            var add_btn_id = '#' + product_id + 'btn';
            var id = '#' + id_get;
            if(value){
                if(parseInt(value)<stock){
                    $(id).css("visibility","hidden");
                    $(add_btn_id).removeClass('disabled');
                }else{
                    $(id).css("visibility","visiale");
                    $(add_btn_id).addClass('disabled');
                }
            }else{
                $(add_btn_id).addClass('disabled');
            }
        });
    </script>
    <!-- add to shopping cart-->
    <script>
        function addToCart(product_id){
            var qty_id = '#' + product_id + 'qty';
            var qty = $(qty_id).val();
            var product_to_add = 'selected_product_id=' + product_id + '&qty=' + qty;
            $('#product_detail_modal').modal('hide');
            //event.preventDefault();
            $.ajax({ //Process the form using $.ajax()
                type      : 'POST', //Method type
                url       : './process_add_to_cart.php', //Your form processing file URL
                data      : product_to_add,
                cache     : false,
                success   : function(data) {
                                var pos = data.indexOf("{");
                                var dataValid = data.substring(pos);
                                var jsonData = eval("("+dataValid+")");
                                var cart_qty = jsonData.cart_qty;
                                //var add_product_id = jsonData.add_item_id;
                                
                                if(jsonData.error_not_logged_in){
                                    $('#sign_in_modal').modal('show');
                                    $('#login_modal_content').show();
                                }else{
                                    
                                    $('.badge').text(cart_qty);
                                    $('.badge').css("color","#FF0000"); 
                                    
                                }
                            }
            });
        }
    </script>
    <!-- change image -->
    <script>
        function changeImg(source){
            document.getElementById('display_img').src = source;
        }
    </script>
    
    </body>
</html>
