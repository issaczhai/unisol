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
        <style>
            .form-control-feedback{
                width:50px
            }
        </style>
        <title>Payment</title>
        
    </head>
    <body>
    <?php
    // Load the header
    session_start();
    $userid = null;
    $username = null;
    if(!empty($_SESSION["userid"])){
        // $userid is customer email address
        $userid = $_SESSION["userid"];
        $pos = strpos($userid, "@");
        // $username is displayed in the header
        $username = substr($userid, 0, $pos);
    }
    include_once("./templates/header.php");
    ?>
    
    <!-- Credit card form -->
        <div class="container" style="margin-top:125px">
            <div class="row">
                <div class="col-lg-5 col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Payment Details</h3>
                        </div>
                        <div class="panel-body">
                            <form role="form" id="payment-form">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <input type="radio" name="creditcard" ><img src="./public_html/img/visa-logo.png" alt="" height="50" width="50" />
                                            &nbsp;&nbsp;<input type="radio" name="creditcard" ><img src="./public_html/img/mastercard-logo.jpg" alt="" height="30" width="50" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label for="cardHolder">CARD HOLDER</label>
                                            <input type="text" class="form-control" id="cardHolder" name="cardHolder"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label for="cardNumber">CARD NUMBER</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                                <input type="text" class="form-control" name="cardNumber" placeholder="Valid Card Number" required autofocus data-stripe="number" />
                                            </div>
                                        </div>                            
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="form-group">
                                        <label for="expMonth" class="col-lg-5">EXPIRATION DATE</label>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-lg-4"><input type="text" class="form-control" name="expMonth" placeholder="MM" data-stripe="exp-month"/></div>
                                        <div class="col-lg-4"><input type="text" class="form-control" name="expYear" placeholder="YYYY" data-stripe="exp-year"/></div>
                                    </div> 
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-3 col-md-5">
                                        <div class="form-group">
                                            <label for="cvCode">CV CODE</label>
                                            <input type="password" class="form-control" name="cvCode" placeholder="CV" required data-stripe="cvc" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button class="btn btn-success btn-lg btn-block" type="submit">Process Payment</button>
                                    </div>
                                </div>
                                <div class="row" style="display:none;">
                                    <div class="col-xs-12">
                                        <p class="payment-errors"></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    <!-- Scripts -->        
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <!--Registration Validation-->
    <script type="text/javascript" src="public_html/js/bootstrapValidator.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function() {
            $('#payment-form').bootstrapValidator({
                message: 'This value is not valid',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
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
    </script>
    </body>
</html>
