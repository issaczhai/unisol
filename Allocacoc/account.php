<?php
include './protect.php'; 
include_once("./Manager/CustomerManager.php");
include_once("./Manager/AddressManager.php");
include_once("./Manager/ConnectionManager.php");
$customerMgr= new CustomerManager();
$addressMgr=new AddressManager();
$customer = $customerMgr->getCustomer($_SESSION["userid"]);
$customer_credits = $customerMgr->getCredit($_SESSION["userid"]);
$customer_id = $customer['customer_id'];
$username = substr($customer_id, 0, strpos($customer_id, "@"));
$invitation_link = $_SERVER['SERVER_NAME'].'/allocacoc/'.$customer['invitation_link'];
$address_list = $addressMgr->getAddress($customer_id);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="./public_html/js/ZeroClipboard.js" ></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
        <link rel="stylesheet" href="./public_html/css/main.css">
        <style>
            #credit_content {
                position: relative;
                height: 300px;
                width: 100%;
                background-position: center; 
                background-repeat: no-repeat;
                background-image: url('./public_html/img/credit_bg.png');
            }
            #bottom-content {
                position: absolute;
                bottom: 20px;
                left: 20px;
            }
            #top-content {
                position: absolute;
                top: 40px;
                left: 20%;
            }
            #bottom-left-content {
                position: absolute;
                bottom: 20px;
                left: 40%;
            }
            #top-left-content {
                position: absolute;
                top: 40px;
                left: 70%;
            }
            .share{
                display: table;
                border-spacing: 10px; /*Optional*/
            }
            .column{
                display: table-cell;
            }
            a {
                color: #FFFFFF;
            }
            .row{
                margin-left: 0px;
                margin-right: 0px;
            }
        </style>

        <!-- Javascript -->
        <!-- load and resize the image -->
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
        <!-- resize cart image -->
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
        <meta property="og:url"                content="<?=$invitation_link ?>" />
        <meta property="og:title"              content="Sign Up for Allocacoc.com and Enjoy $10 Credits!" />
        <meta property="og:description"        content="Allocacoc is the transformer designer and manufacuturer in Europe, we are originated from Netherlands!" />
        <meta property="og:image"              content="./public_html/img/GE.png" />
        <title>My Account|Allocacoc</title>
    </head>
    
    <body>
     <script>
    /*
     * This is boilerplate code that is used to initialize
     * the Facebook JS SDK.  You would normally set your
     * App ID in this code.
     */

    // Additional JS functions here
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '387511714775185',
          cookie  : true, 
          xfbml      : false,
          version    : 'v2.3'
        });
      };
    //Load the Facebook SDK Asynchronously
      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));  
   </script>
    <?php
    include_once("./templates/header.php");
    include_once("./templates/address_modal.php");
    $info_errorMsg = '';
    $pwd_errorMsg = '';
    if(isset($_GET['info_errorMsg'])){
        $info_errorMsg = $_GET['info_errorMsg'];
    }
    if(isset($_GET['pwd_errorMsg'])){
        $pwd_errorMsg = $_GET['pwd_errorMsg'];
    }
    
    ?>
    <div class="container" style="margin-top:100px">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    My Account
                </h1>
            </div>
        </div>
        <div id="credit_content">
            <div id="top-content">
                <font color="#FFFFFF" size="5">Invite a friend & you will both
                    <b>get $10 Credits</b> !!!
                </font>
                <p>
                    <font color="#FFFFFF" size="3">"Get it whenever a new friend orders"</font>
                    <br>
                    <br>
                    <a href="#"> FIND OUT MORE ></a>
                </p>
            </div>
            <div id="top-left-content">
                <textarea class="form-control" rows="1" style="font-size: 30px; width: 50%" readonly><?php echo "$".number_format($customer_credits, 2, '.', ',')?></textarea>
                <font color="#FFFFFF" size="4">Your Credits Balance</font>   
            </div>
            <div id="bottom-content">
                <font color="#FFFFFF" size="5">Just share this link:</font>
                <script type="text/javascript">
                    var clip = new ZeroClipboard(document.getElementById("copy").value);
                </script>
                <div class="col-lg-4 input-group">
                    <input type="text" id="invitation_link" class="form-control" value=<?php echo 'gosg.net/'.$customer['invitation_link'] ?>>
                    <span class="input-group-btn">
                        <input class="btn btn-default" id="copy" type="button" data-clipboard-target="invitation_link" value="Copy">
                    </span>
                </div>  
            </div>
            <div id="bottom-left-content">
                <div class="share">
                    <div class="column"><button type="button" class="btn btn-warning btn-lg"><i class="fa fa-envelope"></i> Invite Via Email </button></div>
                    <div class="column"><button type="button" class="btn btn-primary btn-lg" onclick="shareOnFacebook()"><i class="fa fa-facebook-square"></i> Invite via Facebook </button></div>
                    <div class="column"><a href="https://twitter.com/intent/tweet?text=<?=$invitation_link ?>" class="btn btn-info btn-lg" data-text="<?=$invitation_link ?>">
                            <i class="fa fa-twitter"></i> Invite via Twitter </a></div>
                </div>
            </div>
        </div>
        <br>
        <div class="row" style="border: 3px solid #E6E6E6">
            <div class="col-lg-11">
                <table id="account_information_table" width="100%">
                    <tbody>
                        <form id="change_information_form" method="post" action="process_customer.php">
                            <input type="hidden" id="operation" name="operation" value="change_information"/>
                        <tr>
                            <td rowspan="4">
                                <h3>Account Information</h3>
                            </td>
                            <td>
                                <h5>First Name</h5>
                                <input id="first_name" class="form-control" style="width: 60%" name="first_name" type="text" value="<?php echo $customer['first_name'] ?>" required/>
                            </td>
                            <td>
                                <h5>Last Name</h5>
                                <input id="last_name" class="form-control" style="width: 60%" name="last_name" type="text" value="<?php echo $customer['last_name'] ?>" required/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <h5>Email</h5>
                                <input id="email" class="form-control" style="width: 60%" name="email" type="text" value="<?php echo $customer['email'] ?>" width="100%" required/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <h5>Contact No</h5>
                                <input id="contact_no" class="form-control" style="width: 60%" name="contact_no" type="text" value="<?php echo $customer['contact_no'] ?>" width="100%" required=""/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <br>
                                <button type="submit" class="btn btn-primary">&nbspSave&nbsp</button>
                                <i id="info_errorMsg"><?php echo $info_errorMsg ?></i>
                            </td>
                        </tr>
                        </form>
                    </tbody>    
                </table>
                <br>
            </div>
        </div>
        <br>
        <div class="row" style="border: 3px solid #E6E6E6">
            <div class="col-lg-10">
                <?php
                    $address_no = sizeof($address_list);
                ?>
                <table id="address_table" width="100%">
                    <tbody>
                        <tr>
                            <td><h3>Manage Address ( <?php echo $address_no ?> )</h3></td>
                        </tr>
                        <?php
                        if($address_no === 0 ){
                        ?>
                            <tr>
                                <td>You have not added any addresses.</td>
                            </tr>
                        <?php
                        }else{
                        ?>
                        <?php
                            foreach ($address_list as $address){
                        ?>
                            <tr>
                                <td><?php echo $address['floor'].'-'.$address['unit'].' Blk'.$address['block_no'].' '.$address['building_name'].' '.$address['street'].' Singapore '.$address['postal_code'].'   Receiver: '.$address['first_name'].' '.$address['last_name'] ?></td>
                            </tr>
                        <?php
                            }
                        }
                        ?>
                        <tr>
                            <td align="right">
                                <button type="button" class="btn btn-primary"><i href="#add_address" data-toggle="modal" data-target=".bs-modal-sm">Add Address</i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>
            </div>
        </div>
        <br>
        <div class="row" style="border: 3px solid #E6E6E6">
            <div class="col-lg-10">
                <table id="password_table" width="100%">
                    <tbody>
                        <form id="change_password_form" method="post" action="process_customer.php">
                            <input type="hidden" id="operation" name="operation" value="change_password"/>
                        <tr>
                            <td rowspan="4">
                                <h3>Change Password</h3>
                            </td>
                            <td colspan="2">
                                <h5>Current Password</h5>
                                <input id="password" class="form-control" style="width: 60%" name="password" type="password" width="100%" required/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h5>New Password</h5>
                                <input id="new_password" class="form-control" style="width: 60%" name="new_password" type="password" required/>
                            </td>
                            <td>
                                <h5>Confirm Password</h5>
                                <input id="confirm_new_password" class="form-control" style="width: 60%" name="confirm_new_password" type="password" required/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <br>
                                <button type="submit" class="btn btn-primary">Change Password</button>
                                <i id="pwd_errorMsg"><?php echo $pwd_errorMsg ?></i>
                            </td>
                        </tr>
                        </form>
                    </tbody>    
                </table>
                
            </div>
        </div>
    </div>
    <script>
    function add_address(){
            //Validate fields if required using jQuery
            var postForm = { //Fetch form data
                'firstname'     : $('#firstname').val(), //Store firstname fields value
                'lastname'     : $('#lastname').val(), //Store lastname fields value
                'street'     : $('#street').val(), //Store street fields value
                'blockno'     : $('#blockno').val(), //Store blockno fields value
                'floor'     : $('#floor').val(), //Store floor fields value
                'unit'     : $('#unit').val(), //Store unit fields value
                'postalcode'     : $('#postalcode').val(), //Store postalcode fields value
                'status'     : '',
                'message'    : ''
            };
            var operation='add';
            
            $.ajax({ //Process the form using $.ajax()
                type      : 'POST', //Method type
                url       : './process_address.php?operation='+operation, //Your form processing file URL
                data      : postForm, //Forms name
                success   : function(data) {
                    var pos = data.indexOf('{');
                    var dataValid = data.substring(pos);
                    var jsonData = eval("("+dataValid+")");
                    if (jsonData.status === 'fail') { 
                        //If fails
                        $('#add_errorMsg').html(jsonData.message); 
                            
                    }else{
                        window.location='./account.php';
                        
                    }
            }
            });
    }
    </script>
    <script>
    function shareOnFacebook(){
        FB.ui({
            method: 'share',
            href: 'http://gosg.net/account.php'
            
        }, function(response) {
            if(response && response.post_id){}
            else{}
        });
    }   
    </script>       
    <script>window.twttr = (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0],
          t = window.twttr || {};
        if (d.getElementById(id)) return t;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://platform.twitter.com/widgets.js";
        fjs.parentNode.insertBefore(js, fjs);

        t._e = [];
        t.ready = function(f) {
          t._e.push(f);
        };

        return t;
      }(document, "script", "twitter-wjs"));
    </script>
    </body>
    

</html>