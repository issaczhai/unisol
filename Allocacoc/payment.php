<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <!-- validation -->
        <link href="public_html/css/bootstrapValidator.css" rel="stylesheet">
        <link href="public_html/css/payment.css" rel="stylesheet">
        <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <title>Payment</title>
        
    </head>
    <body>
    <div class="container">      
    <?php
    include_once("./protect.php");
    include_once("./Manager/ConnectionManager.php");
    include_once("./Manager/ProductManager.php");
    include_once("./Manager/CreditManager.php");
    include_once("./Manager/PhotoManager.php");
    // Load the header
    $userid = null;
    $username = null;
    if(!empty($_SESSION["userid"])){
        // $userid is customer email address
        $userid = $_SESSION["userid"];
        $pos = strpos($userid, "@");
        // $username is displayed in the header
        $username = substr($userid, 0, $pos);
    }
    
    $checkoutList = $_POST;
    $productMgr = new ProductManager();
    $photoMgr = new PhotoManager();
    $list = [];
    //var_dump($checkoutList);
    foreach ($checkoutList as $checkout){
        $product = $productMgr->getProduct($checkout["productId"]);
        $item=[];
        $photoList = $photoMgr->getPhotos($product["product_id"]);
        $item["product_id"] = $product["product_id"];
        $item["product_name"] = $product["product_name"];
        $item["color"]=$checkout["color"];
        $item["thumbnail"] = $photoList[$item["color"]];
        $item["quantity"] = $checkout["quantity"];
        $item["price"] = $product["price"];
        $item["subtotal"] = $checkout["quantity"] * $product["price"];
        $item["add_to_cart_time"] = $checkout["create_time"];
        array_push($list,$item);
    }
    
    include_once("./templates/header2.php");
    $creditMgr = new CreditManager();
    $creditList = $creditMgr->getUnusedCreditListByReceiverId($userid);
    ?>
      
    <form id="paymentForm" action="https://securepayments.paypal.com/webapps/HostedSoleSolutionApp/webflow/sparta/hostedSoleSolutionProcess" method="post" class="form-horizontal">
        <input type="hidden" name="cmd" value="_hosted-payment">
        <input type="hidden" name="business" value="6USHCFXJ739JN">
        <input type="hidden" name="paymentaction" value="sale">
        <input type="hidden" name="return" value="https://gosg.net/success.php">
        <input type="hidden" name="currency_code" value="SGD">
        <div class="col-lg-12">
            <div class="page-header">
                 <font style="color:#008ba4;font-weight: bold; font-size:17px"><i class="fa fa-map-marker"></i> Shipping Address </font>
            </div>
        </div>
        <div class="col-lg-12 col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Name*</label>
                            <div class="col-lg-2">
                                <input type="text" name="first_name" class="form-control" placeholder="First name" autocomplete="off"/>
                            </div>
                            <div class="col-lg-2">
                                <input type="text" name="last_name" class="form-control" placeholder="Last name" autocomplete="off"/>
                            </div>
                        </div>
<!--                        <div class="form-group">
                            <label class="col-lg-3 control-label">Phone*</label>
                            <div class="col-lg-5">
                                <input type="text" name="phone" class="form-control" placeholder="Contact Number" autocomplete="off"/>
                            </div>
                        </div>-->
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Address*</label>
                            <div class="col-lg-5">
                                <input type="text" name="address1" class="form-control" placeholder="Address Line 1"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label"></label>
                            <div class="col-lg-5">
                                <input type="text" name="address2" class="form-control" placeholder="Address Line 2"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Code*</label>
                            <div class="col-lg-5">
                                <input type="text" name="zip" class="form-control" placeholder="Postal Code"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Country*</label>
                            <div class="col-lg-3">
                                <select class="form-control" id="country" name="country" >
                                    <option value=""> Choose Your Country </option>
                                    <option value="sg"> Singapore </option>
                                    <option value="cn"> China </option>
                                    <option value="jp"> Japan </option> 
                                    <option value="kr"> Korean </option> 
                                </select>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
        <!-- promotion or reward code -->
        <div class="col-lg-12">
            <div class="page-header">
                 <font style="color:#008ba4;font-weight: bold; font-size:17px"><i class="fa fa-barcode"></i> Promotion & Reward Code </font>
            </div>
        </div>
        <div class="col-lg-12 col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Reward Code: </label>
                            <div class="col-lg-6">
                                <input type="text" id="rewardCode" name="rewardCode" class="form-control" onchange="disable('rewardCode','invite');checkRewardCode()"/>
                            </div>
                            <div id="codeCorrect" style="display:none;">
                                <i class="fa fa-check" style="color: #2ca02c;font-size:24px;"></i>
                                <span style="color: #2ca02c;"> Gift has been added to your order! </span>
                            </div>
                            <div id="codeIncorrect" style="display:none;">
                                <i class="fa fa-times" style="color: #FF0000;font-size:24px;"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-6 control-label" for="">--OR--</label>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Choose Voucher From: </label>
                            <div class="col-lg-6">
                                <select name="invite" id="invite" class="form-control" onchange="disable('invite','rewardCode');">
                                    <option value=""></option>
                                    <?php
                                    foreach($creditList as $credit){
                                    ?>
                                    <option value="<?php echo $credit["sender_id"]?>,<?php echo $credit["receiver_id"]?>"><?php echo $credit["sender_id"]?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        
                    </fieldset>
                </div>
            </div>
        </div>
        
        <div class="col-lg-12">
            <div class="page-header">
                 <font style="color:#008ba4;font-weight: bold; font-size:17px"><i class="fa fa-credit-card"></i> Choose your payment method </font>
            </div>
        </div>
        <div class="col-lg-12 col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-lg-3">
                            <label for="paypal">
                                <input type="radio" name="bank" value="paypalsg" id="paypal" class="J_paypal">
                                <img src="./public_html/img/visa-master.png" height="50px">
                            </label>
                        </div>
                        <div class="col-lg-2">
                            <label for="alipay">
                                <input type="radio" name="bank" value="alipay" id="alipay" class="J_paypal">
                                <img src="./public_html/img/alipay.png" alt="">
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-3 col-lg-offset-9">
                            <button class="btn btn-primary" style="width:150px" type="submit" name="METHOD">Pay</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- receipt -->
        <div class="col-lg-12">
            <div class="page-header">
                 <font style="color:#008ba4;font-weight: bold; font-size:17px"><i class="fa fa-list"></i> Order Confirmation </font>
            </div>
        </div>
        <div class="col-lg-12 col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <div style="overflow-x: none; overflow-y: scroll; width: 100%; max-height: 500px;">
                        <table class="table table-hover table-striped">
                            <thead id="tablehead">
                                <tr>
                                    <td align="center"></td>
                                    <td align="left"><b>Product</b></td>
                                    <td align="center"><b>Qty</b></td>
                                    <td align="center"><b>Price</b></td>
                                    <td align="center"><b>Total</b></td>
                                </tr>
                            </thead>
                            <tbody id="orderTableBody">
                                <?php
                                $totalPrice = 0.0;
                                if(sizeof($list) === 0){
                                ?>
                                <tr>
                                    <td align="center"></td>
                                    <td align="center"></td>    
                                    <td align="center"></td>    
                                    <td align="center"></td>
                                    <td align="center"></td> 
                                </tr>
                                <?php
                                }else{      
                                ?>
<!--                            <input type="hidden" id="listLength" name="listLength" value=""/>-->
                                <?php
                                
                                    $count = 0;
                                    foreach($list as $item){
                                    $count+=1;
                                    $totalPrice += intval($item["quantity"]) * doubleval($item["price"]);
                                ?>
                                <input id="product_id<?php echo strval($count)?>" name="product_id<?php echo strval($count)?>" type="hidden" value="<?=$item["product_id"] ?>"/>
                                <input id="product_color<?php echo strval($count)?>" name="product_color<?php echo strval($count)?>" type="hidden" value="<?=$item["color"] ?>"/>
                                <input id="add_to_cart_time<?php echo strval($count)?>" name="add_to_cart_time<?php echo strval($count)?>" type="hidden" value="<?=$item["add_to_cart_time"] ?>"/>
                                <tr>
                                    <td align="center" width="15%">
                                        <div style="padding-left: 30px">
                                            <img src="<?=$item["thumbnail"]?>" width="80px" height="80px">
                                        </div>
                                    </td>
                                    <td align="left" width="15%" style="vertical-align:middle;"><?=$item["product_name"] ?><input id="product<?php echo strval($count)?>" name="product<?php echo strval($count)?>" type="hidden" value="<?=$item["product_name"] ?>"/></td>    
                                    <td align="center" style="vertical-align:middle;"><?=$item["quantity"] ?><input id="quantity<?php echo strval($count)?>" name="quantity<?php echo strval($count)?>" type="hidden" value="<?=$item["quantity"] ?>"/></td>    
                                    <td align="center" style="vertical-align:middle;">$<?=number_format($item["price"],2,'.','') ?><input id="price<?php echo strval($count)?>" name="price<?php echo strval($count)?>" type="hidden" value="<?=$item["price"] ?>"/></td>
                                    <td align="center" width="15%" style="vertical-align:middle;color:#008ba4;"><b>$<?=number_format($item["subtotal"],2,'.','') ?></b></td> 
                                </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
        <input type="hidden" name="subtotal" value="<?=$totalPrice?>">
<!--        <div class="form-group" >
            <div class="col-lg-8 col-lg-offset-5" style="margin-left: 400px">
                <button type="submit" class="btn btn-primary btn-lg" id="paymentBtn">Go To Payment</button>
                <button type="button" class="btn btn-warning btn-lg" id="resetBtn1">Reset form</button>
            </div>
        </div>  -->
    </form>
    </div>    
  
    
    <!--Registration Validation-->
    <script type="text/javascript" src="public_html/js/bootstrapValidator.js"></script>
    <script type="text/javascript" src="public_html/js/payment.js"></script>
    </body>
</html>
