<?php
if (session_status()!=PHP_SESSION_ACTIVE) {
session_start();
}
include_once("./protect/customer_protect.php");
?>
<!DOCTYPE html>
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
    function generateRandomString($length) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    ?>
        <form id="paymentForm" name="cart" method="post" class="form-horizontal">
        <!-- Address -->
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
        
        <!-- card -->
        <div class="col-lg-12">
            <div class="page-header">
                 <font style="color:#008ba4;font-weight: bold; font-size:17px"><i class="fa fa-credit-card"></i> Payment Details </font>
            </div>
        </div>
        <div class="col-lg-12 col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <fieldset>
                            <div class="form-group">
                                <label class="col-lg-4 control-label" for="card_number">Card Number*</label>
                                <div class="col-lg-4">
                                    <input type="text" name="card_number" id="card_number" class="form-control" maxlength="20"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-4 control-label" for="card_name">Name on Card*</label>
                                <div class="col-lg-4">
                                    <input type="text" name="card_name" id="card_name" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-4 control-label">Expiry*</label>
                                <div class="col-lg-1">
                                    <input type="text" name="expiry_month" id="expiry_month" maxlength="2" placeholder="MM" class="form-control"/>
                                </div>
                                <div class="col-lg-1">
                                    <input type="text" name="expiry_year" id="expiry_year" maxlength="2" placeholder="YY" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-4 control-label" for="cvv">CVV*</label>
                                <div class="col-lg-1">
                                    <input type="text" name="cvv" id="cvv" maxlength="3" class="form-control"/>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
        
        
        <div class="form-group" >
            <div class="col-lg-8 col-lg-offset-5" style="margin-left: 400px">
                <button type="submit" class="btn btn-primary btn-lg" id="paymentButton" disabled="disabled">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Proceed&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                <button type="button" class="btn btn-warning btn-lg" id="resetBtn">Reset form</button>
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
                                <input id="product_id<?php echo strval($count)?>" name="product_id[]" type="hidden" value="<?=$item["product_id"] ?>"/>
                                <input id="product_color<?php echo strval($count)?>" name="product_color[]" type="hidden" value="<?=$item["color"] ?>"/>
                                <input id="add_to_cart_time<?php echo strval($count)?>" name="add_to_cart_time[]" type="hidden" value="<?=$item["add_to_cart_time"] ?>"/>
                                <tr>
                                    <td align="center" width="15%">
                                        <div style="padding-left: 30px">
                                            <img src="<?=$item["thumbnail"]?>" width="80px" height="80px">
                                        </div>
                                    </td>
                                    <td align="left" width="15%" style="vertical-align:middle;"><?=$item["product_name"] ?><input id="product<?php echo strval($count)?>" name="product_name[]" type="hidden" value="<?=$item["product_name"] ?>"/></td>    
                                    <td align="center" style="vertical-align:middle;"><?=$item["quantity"] ?><input id="quantity<?php echo strval($count)?>" name="quantity[]" type="hidden" value="<?=$item["quantity"] ?>"/></td>    
                                    <td align="center" style="vertical-align:middle;">$<?=number_format($item["price"],2,'.','') ?><input id="price<?php echo strval($count)?>" name="price[]" type="hidden" value="<?=$item["price"] ?>"/></td>
                                    <td align="center" width="15%" style="vertical-align:middle;color:#008ba4;"><b>$<?=number_format($item["subtotal"],2,'.','') ?></b></td> 
                                </tr>
                                <?php
                                    }
                                }
                                $_SESSION["session_price"] = $totalPrice;
                                ?>
                            </tbody>
                        </table>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
        
        </form>
    
    </div>    
  
    
    <!--Registration Validation-->
    <script type="text/javascript" src="public_html/js/bootstrapValidator.js"></script>
    <script type="text/javascript" src="public_html/js/jquery.creditCardValidator.js"></script>
    <script type="text/javascript" src="public_html/js/card.js"></script>
    <script type="text/javascript" src="public_html/js/payment.js"></script>
    </body>
</html>