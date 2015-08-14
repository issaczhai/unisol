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
    foreach ($checkoutList as $checkout){
        $product = $productMgr->getProduct($checkout["productId"]);
        $item=[];
        $photoList = $photoMgr->getPhotos($product["product_id"]);
        $item["product_id"] = $product["product_id"];
        $item["thumbnail"] = $photoList["1"];
        $item["product_name"] = $product["product_name"];
        $item["quantity"] = $checkout["quantity"];
        $item["price"] = $product["price"];
        $item["subtotal"] = $checkout["quantity"] * $product["price"];
        array_push($list,$item);
    }
    
    include_once("./templates/header2.php");
    $creditMgr = new CreditManager();
    $creditList = $creditMgr->getUnusedCreditListByReceiverId($userid);
    ?>
    
    <form id="payment" action="./paypal/payments/CreatePayment.php" method="post" class="form-horizontal">
        
        <ul class="wizard">
            <li>
                <div class="col-lg-4">
                    <div class="page-header">
                        <font id="shippingInfo_tab" style="color:#008ba4;font-weight: bold; font-size:17px"><i class="fa fa-map-marker"></i>&#160; Step.1 Shipping Address </font>
                    </div>
                </div>
            </li>
            <li>
                <div class="col-lg-4">
                    <div class="page-header">
                        <font id="paymentInfoTab" style="color: #D8D8D8;font-weight: bold; font-size:17px"><i id="paymentInfoIcon" class="fa fa-credit-card" style="color: #D8D8D8"></i>&#160; Step.2 Payment Information </font>
                    </div>
                </div>
            </li>
            <li>
                <div class="col-lg-4">
                    <div class="page-header">
                         <font id="emailInfoTab" style="color:#D8D8D8;font-weight: bold; font-size:17px"><i id="emailInfoIcon" class="fa fa-file-text-o" style="color: #D8D8D8"></i>&#160; Step.3 Receipt </font>
                    </div>
                </div>
            </li>
        </ul>
        
        
        <div class="tab-content">
            
        <div class="tab-pane fade active in col-lg-12" id="shippingInfo">
            <div class="panel panel-default">
                <!-- driver registration-->
                <div class="panel-body">
    <!--                <form role="form" id="shippingform" class="form-horizontal">-->
                        <fieldset>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Name*</label>
                                <div class="col-lg-2">
                                    <input type="text" name="firstname" class="form-control" placeholder="First name" autocomplete="off"/>
                                </div>
                                <div class="col-lg-2">
                                    <input type="text" name="lastname" class="form-control" placeholder="Last name" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Phone*</label>
                                <div class="col-lg-5">
                                    <input type="text" name="phone" class="form-control" placeholder="Contact Number" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Company</label>
                                <div class="col-lg-5">
                                    <input type="text" name="company" class="form-control" placeholder="Company Name (Optional)"/>
                                </div>
                            </div>
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
                                    <input type="text" name="postcode" class="form-control" placeholder="Postal Code"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Country*</label>
                                <div class="col-lg-3">
                                    <select class="form-control" id="shipping_country" name="shipping_country" >
                                        <option value=""> Choose Your Country </option>
                                        <option value="sg"> Singapore </option>
                                        <option value="cn"> China </option>
                                        <option value="jp"> Japan </option> 
                                        <option value="kr"> Korean </option> 
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-3 col-lg-offset-5">
                                    <a class="btn btn-primary" style="width:100px" href="#paymentInfo" data-toggle="tab" onclick="showTab('paymentInfo');">Next</a>
                                </div>
                            </div>
                        </fieldset>

                    <!--</form>-->
                </div>    
            </div>
        </div>
        <!--<form id="payment" action="./paypal/payments/CreatePayment.php" method="post" class="form-horizontal">-->
        
        <div class="tab-pane fade col-lg-12 col-md-6" id="paymentInfo">
            <div class="panel panel-default">
                <div class="panel-body">
    <!--                <form role="form" id="payment-form" class="form-horizontal">-->
                        <fieldset>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Payment Method</label>
                                <div class="col-lg-5">
                                    <input type="radio" name="creditcard" value="visa"><img src="./public_html/img/visa-logo.png" alt="" height="50" width="50" />
                                    &nbsp;&nbsp;<input type="radio" name="creditcard" value="mastercard"><img src="./public_html/img/mastercard-logo.jpg" alt="" height="30" width="50" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">FIRST NAME</label>
                                <div class="col-lg-5">
                                    <input type="text" class="form-control" id="cardHolderFN" name="cardHolderFN" autocomplete="off"/>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-lg-3 control-label">LAST NAME</label>
                                <div class="col-lg-5">
                                    <input type="text" class="form-control" id="cardHolderLN" name="cardHolderLN" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">CARD NUMBER</label>
                                <div class="col-lg-5">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                        <input type="text" class="form-control" name="cardNumber" placeholder="Valid Card Number" required data-stripe="number" autocomplete="off"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">EXPIRATION DATE</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" name="expMonth" placeholder="MM" data-stripe="exp-month"/>
                                </div>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" name="expYear" placeholder="YYYY" data-stripe="exp-year"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">CV CODE</label>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" name="cvCode" placeholder="CV" required data-stripe="cvc" />
                                </div>
                            </div>
                        </fieldset>
                        <div class="row" style="display:none;">
                            <div class="col-xs-12">
                                <p class="payment-errors"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-4 col-lg-offset-4">
                                <a class="btn btn-default" style="width:100px" href="#shippingInfo" data-toggle="tab">Previous</a>
                                <a class="btn btn-primary" style="width:100px" href="#emailInfo" data-toggle="tab" onclick="showTab('emailInfo');">Next</a>
                            </div>
                        </div>
    <!--                </form>-->
                </div>
            </div>
        </div>

        <!-- receipt -->
        
        <div class="tab-pane fade col-lg-12 col-md-6" id="emailInfo">
            <div class="panel panel-default">
                <div class="panel-body">
    <!--                <form id="receipt-email" role="form" class="form-horizontal">-->
                        <fieldset>
                            <div class="form-group">
                                <div class="col-lg-4">This receipt will be send to you after the order is shipped to your e-mail address. This receipt can be regarded as official documents and can be used for product warranty and maintenance requests</div>
                                <label class="col-lg-2 control-label">E-mail*</label>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" name="receiptemail" placeholder="example@gmail.com" autocomplete="off" />
                                </div>
                            </div>
                            <div class="form-group">
                            <div class="col-lg-3 col-lg-offset-5">
                                <a class="btn btn-default" style="width:100px" href="#paymentInfo" data-toggle="tab">Previous</a>
                            </div>
                        </div>
                        </fieldset>    
    <!--                </form>-->
                </div>
            </div>
        </div>

        </div> <!-- end of tab-content class -->
        
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
                            <label class="col-lg-3 control-label">Invitation: </label>
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
                            <input type="hidden" id="listLength" name="listLength" value="<?php echo sizeof($list);?>"/>
                                <?php
                                
                                    $count = 0;
                                    foreach($list as $item){
                                    $count+=1;
                                ?>
                                <tr>
                                    <td align="center" width="15%">
                                        <div style="padding-left: 30px">
                                            <img src="<?=$item["thumbnail"]?>" width="80px" height="80px">
                                        </div>
                                    </td>
                                    <td align="left" width="15%" style="vertical-align:middle;"><?=$item["product_name"] ?><input id="product<?php echo strval($count)?>" name="product<?php echo strval($count)?>" type="hidden" value="<?=$item["product_name"] ?>"/></td>    
                                    <td align="center" style="vertical-align:middle;"><?=$item["quantity"] ?><input id="quantity<?php echo strval($count)?>" name="quantity<?php echo strval($count)?>" type="hidden" value="<?=$item["quantity"] ?>"/></td>    
                                    <td align="center" style="vertical-align:middle;">$<?=$item["price"] ?><input id="price<?php echo strval($count)?>" name="price<?php echo strval($count)?>" type="hidden" value="<?=$item["price"] ?>"/></td>
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
        <div class="form-group" >
            <div class="col-lg-8 col-lg-offset-5" style="margin-left: 400px">
                <button type="submit" class="btn btn-primary btn-lg" id="paymentBtn">Go To Payment</button>
                <button type="button" class="btn btn-warning btn-lg" id="resetBtn1">Reset form</button>
            </div>
        </div>  
    </form>
    </div>    
    <?php
//        $currentPage = "payment";
//        include_once("./templates/footer.php");
    ?>
    <!-- Scripts -->        
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <!--Registration Validation-->
    <script type="text/javascript" src="public_html/js/bootstrapValidator.js"></script>
    <script type="text/javascript" src="public_html/js/payment.js"></script>
    </body>
</html>
