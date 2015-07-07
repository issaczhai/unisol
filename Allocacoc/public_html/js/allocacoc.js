// Login
var login = function() {
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
                            var pos = data.indexOf("{");
                            var dataValid = data.substring(pos);
                            var jsonData = eval("("+dataValid+")");
                            console.log(jsonData.exceed);
                            if (!jsonData.success) { 
                                    //If fails
                                    $('#errorMsg').html(jsonData.errors); 
                                    
                            }else{
                                var status = jsonData.status;
                                var message = jsonData.message;
                                var exceed = jsonData.exceed;
                                if (typeof status === 'undefined'){
                                    status = '';
                                }
                                if (typeof message === 'undefined'){
                                    message = '';
                                }
                                if (typeof exceed === 'undefined'){
                                    exceed = '';
                                }
                                if(status !== ''){
                                    window.location='./index.php?status='+status+'&message='+message+'&exceed='+exceed;
                                }else{
                                    window.location='./index.php?exceed='+exceed;
                                }
                            }
                        }
        });
        event.preventDefault(); //Prevent the default submit
    });
};

// Register
var register = function() {
    
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
                                window.location='./index.php?status='+status+'&message='+message;
                            }else{
                                window.location='./index.php';
                            }
                        }
                    }
        });
    event.preventDefault(); //Prevent the default submit
    });
};
// Add to cart
var addToCart = function(product_id){
        event.preventDefault();
        if($('.cart-button').text() === 'proceed to checkout'){
            console.log('coming here');
            window.location = './cart.php';
        }else{
                var qty_id = '#' + product_id + 'qty';
                var qty = $(qty_id).val();
                var product_to_add = 'selected_product_id=' + product_id + '&qty=' + qty;
                console.log("add to cart is called");
                
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
                                    console.log('returned');
                                    if(jsonData.error_not_logged_in){
                                        $('#sign_in_modal').modal('show');
                                        $('#login_modal_content').show();
                                    }else{
                                        $('.cart-qty').text('( ' + cart_qty + ' )');
                                        $('.cart-qty').css("color","rgb(0, 89, 112)");
                                        $('.number-spinner').hide(); 
                                        $('.cart-button').text('process to checkout');
                                        $('.cart-button').attr('onclick',"window.location='./cart.php'");
                                    }
                                }
                });
        }   
    
};