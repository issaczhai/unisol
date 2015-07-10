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
    include_once("./Manager/ProductManager.php");
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
    include_once("./templates/header2.php");
    ?>
      
    <form id="payment" action="#" method="post" class="form-horizontal"> 
        <div class="col-lg-12">
            <div class="page-header">
                <font style="color:#008ba4;font-weight: bold; font-size:17px"><i class="fa fa-map-marker"></i> Shipping Address </font>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                     Shipping Address
                </div>
                <br>
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
                        </fieldset>

                    <!--</form>-->
                </div>    
            </div>
        </div>
        <!-- Credit card form -->
        <div class="col-lg-12">
            <div class="page-header">
                 <font style="color:#008ba4;font-weight: bold; font-size:17px"><i class="fa fa-credit-card"></i> Payment Information </font>
            </div>
        </div>
        <div class="col-lg-12 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Payment Details</h3>
                </div>
                <div class="panel-body">
    <!--                <form role="form" id="payment-form" class="form-horizontal">-->
                        <fieldset>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Payment Method</label>
                                <div class="col-lg-5">
                                    <input type="radio" name="creditcard" ><img src="./public_html/img/visa-logo.png" alt="" height="50" width="50" />
                                    &nbsp;&nbsp;<input type="radio" name="creditcard" ><img src="./public_html/img/mastercard-logo.jpg" alt="" height="30" width="50" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">CARD HOLDER</label>
                                <div class="col-lg-5">
                                    <input type="text" class="form-control" id="cardHolder" name="cardHolder" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">CARD NUMBER</label>
                                <div class="col-lg-5">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                        <input type="text" class="form-control" name="cardNumber" placeholder="Valid Card Number" required autofocus data-stripe="number" autocomplete="off"/>
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
    <!--                </form>-->
                </div>
            </div>
        </div>

        <!-- receipt -->
        <div class="col-lg-12">
            <div class="page-header">
                 <font style="color:#008ba4;font-weight: bold; font-size:17px"><i class="fa fa-file-text-o"></i> Receipt </font>
            </div>
        </div>
        <div class="col-lg-12 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Electronic Receipt for Purchase</h3>
                </div>
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
                        </fieldset>    
    <!--                </form>-->
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
                                    <td align="center"><b>Product</b></td>
                                    <td align="center"><b>Qty</b></td>
                                    <td align="center"><b>Price</b></td>
                                    <td align="center"><b>Total</b></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td align="center">1</td>
                                    <td align="center">2</td>    
                                    <td align="center">3</td>    
                                    <td align="center">4</td>
                                    <td align="center">5</td> 
                                </tr>
                                <tr>
                                    <td align="center">1</td>
                                    <td align="center">2</td>    
                                    <td align="center">3</td>    
                                    <td align="center">4</td>
                                    <td align="center">5</td> 
                                </tr>
                                <tr>
                                    <td align="center">1</td>
                                    <td align="center">2</td>    
                                    <td align="center">3</td>    
                                    <td align="center">4</td>
                                    <td align="center">5</td>  
                                </tr>
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
    
    <script type="text/javascript">
        $(document).ready(function() {
            $('#payment').bootstrapValidator({
                message: 'This value is not valid',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    firstname: {
                        validators: {
                            regexp: {
                                regexp: /^[a-z\s]+$/i,
                                message: 'The first name can only consist of alphabetical, space'
                            },
                            notEmpty: {
                                message: 'The first name is required and cannot be empty'
                            }
                        }
                    },
                    lastname: {
                        validators: {
                            regexp: {
                                regexp: /^[a-z\s]+$/i,
                                message: 'The last name can only consist of alphabetical, space'
                            },
                            notEmpty: {
                                message: 'The last name is required and cannot be empty'
                            }
                        }
                    },
                    phone: {
                        validators: {
                            notEmpty: {
                                message: 'The phone number is required and can\'t be empty'
                            },
                            digits: {
                                message: 'The phone number can contain digits only'
                            }
                        }
                    },
                    address1:{
                        validators:{
                            notEmpty : {
				message : 'The address is required and can\'t be empty'
                            }
                        }
                    },
                    postcode: {
                        validators: {
                            notEmpty: {
                                message: 'Postal Code is required and can\'t be empty'
                            },
                            digits: {
                                message: 'Postal Code can contain digits only'
                            }
                        }
                    },
                    shipping_country:{
                        validators:{
                            notEmpty : {
				message : 'Please select your country '
                            }
                        }
                    },
                    receiptemail:{
                        validators:{
                            notEmpty : {
				message : 'The email address is required and can\'t be empty'
                            },
                            emailAddress : {
				message : 'The input is not a valid email address'
                            },
                        }
                    },
                    cardHolder:{
                        selector: '#cardHolder',
                        validators: {
                            notEmpty: {
                                message: 'The card holder is required'
                            },
                            stringCase: {
                                message: 'The card holder must contain upper case characters only',
                                case: 'upper'
                            }
                        }
                    },
                    
                    cardNumber: {
                        validators: {
                            notEmpty: {
                                message: 'The card number is required and can\'t be empty'
                            },
                            creditCard: {
                                message: 'The credit card number is not valid'
                            }
                        }
                    },
                    
                    expMonth: {
                        selector: '[data-stripe="exp-month"]',
                        validators: {
                            notEmpty: {
                                message: 'The expiration month is required'
                            },
                            digits: {
                                message: 'The expiration month can contain digits only'
                            },
                            callback: {
                                message: 'Expired',
                                callback: function(value, validator) {
                                    value = parseInt(value, 10);
                                    var year         = validator.getFieldElements('expYear').val(),
                                        currentMonth = new Date().getMonth() + 1,
                                        currentYear  = new Date().getFullYear();
                                    if (value < 0 || value > 12) {
                                        return false;
                                    }
                                    if (year === '') {
                                        return true;
                                    }
                                    year = parseInt(year, 10);
                                    if (year > currentYear || (year === currentYear && value > currentMonth)) {
                                        validator.updateStatus('expYear', 'VALID');
                                        return true;
                                    } else {
                                        return false;
                                    }
                                }
                            }
                        }
                    },
                    
                    expYear: {
                        selector: '[data-stripe="exp-year"]',
                        validators: {
                            notEmpty: {
                                message: 'The expiration year is required'
                            },
                            digits: {
                                message: 'The expiration year can contain digits only'
                            },
                            callback: {
                                message: 'Expired',
                                callback: function(value, validator) {
                                    value = parseInt(value, 10);
                                    var month        = validator.getFieldElements('expMonth').val(),
                                        currentMonth = new Date().getMonth() + 1,
                                        currentYear  = new Date().getFullYear();
                                    if (value < currentYear || value > currentYear + 10) {
                                        return false;
                                    }
                                    if (month === '') {
                                        return false;
                                    }
                                    month = parseInt(month, 10);
                                    if (value > currentYear || (value === currentYear && month > currentMonth)) {
                                        validator.updateStatus('expMonth', 'VALID');
                                        return true;
                                    } else {
                                        return false;
                                    }
                                }
                            }
                        }
                    },
            
                    cvCode: {
                        validators: {
                            notEmpty: {
                                message: 'The CV number is required'
                            },
                            cvv: {
                                message: 'The value is not a valid CV',
                                creditCardField: 'cardNumber'
                            }
                        }
                    }
                }
            });
            
        });
        
        $('#resetBtn1').click(function() {
            $('#payment').data('bootstrapValidator').resetForm(true);
        });
    </script>
    </body>
</html>
