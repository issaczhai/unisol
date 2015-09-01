// Login
var login = function() {
    $('#errorMsgRegister').html("");
    $('#login').submit(function(event) { //Trigger on form submit
        $('#sign-in-btn').text('Signing In...');
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
                                    $('#sign-in-btn').text('Sign In');
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
                            console.log(status);
                            if (typeof status === 'undefined'){
                                status = '';
                            }
                            if (typeof message === 'undefined'){
                                message = '';
                            }
                            if(status === 'success'){
                                window.location='./index.php?status='+status+'&message='+message;
                            }
                            console.log(status);
                            if(status === 'unverified'){
                                $('#activateMsgRegister').html(message);
                            }else{
                                //window.location='./index.php';
                            }
                        }
                    }
        });
    event.preventDefault(); //Prevent the default submit
    });
};
// Add to cart
var addToCart = function(product_id){
        /*if($('.cart-button').text() === 'proceed to checkout'){
            window.location = './cart.php';
        }else{*/
                
        var qty_id = '#' + product_id + 'qty';
        var qty = $(qty_id).val();
        var product_to_add = 'selected_product_id=' + product_id + '&qty=' + qty;
        $('#loader-overlay').css('display','block');
        $.ajax({ //Process the form using $.ajax()
            type      : 'POST', //Method type
            url       : './process_add_to_cart.php', //Your form processing file URL
            data      : product_to_add,
            cache     : false,
            success   : function(data) {
                            $('#loader-overlay').css('display','none');

                            var existed_item_id = null,
                                pos = data.indexOf("{"),
                                dataValid = data.substring(pos),
                                jsonData = eval("("+dataValid+")"),
                                cart_qty = jsonData.cart_qty,
                                cart_unique_qty = jsonData.cart_unique_qty,
                                product_name = jsonData.product_name,
                                item_qty = jsonData.item_qty,
                                add_product_id = jsonData.add_item_id,
                                photo_url = jsonData.photo_url,
                                userid = jsonData.userid,
                                qty_update = jsonData.qty_update,
                                qty_to_change = jsonData.qty_to_change,
                                product_url = './product_detail.php?selected_product_id='+ add_product_id + '&customer_id=' + userid;
                                
                            if(jsonData.error_not_logged_in){
                                $('#sign_in_modal').modal('show');
                                $('#login_modal_content').show();
                            }else{
                                $('.cart-qty').text('( ' + cart_qty + ' )');
                                // cart item preview list contains max 5 items
                                existed_item_id = 'cartItem' + add_product_id;
                                if(cart_unique_qty < 6 && !qty_update){
                                    var newNotification = $('.notification-template').clone();
                                    
                                    newNotification.find('.item-qty').text('Quantity:' + item_qty);
                                    notification.data('itemid', existed_item_id);
                                    //newNotification.find('.item-qty').prepend('&nbsp;');
                                    newNotification.find('.product-name-link').attr('href', product_url);
                                    newNotification.find('.product-img-link').attr('href', product_url);
                                    newNotification.find('.cart-image').attr('src', photo_url);
                                    newNotification.find('.product-name-link').text(product_name);
                                    $('.last-notification').before(newNotification);
                                    newNotification.removeClass('notification-template');
                                }else if(qty_update){
                                    $('.sub-menu').find('li[data-itemid=' + existed_item_id + ']').find('.item-qty').text('Quantity:' + item_qty);
                                }
                                $('.cart-notification .cart-qty-changed').text(qty_to_change);
                                $(".cart-notification").css('display', 'block');
                                $(".cart-notification").delay(5000).fadeOut();
                                $('.empty-cart').remove();/*
                                $('.number-spinner').hide(); 
                                $('.cart-button').text('process to checkout');
                                $('.cart-button').attr('onclick',"window.location='./cart.php'");*/
                            }
                        }
        });
        event.preventDefault();
        //}   
    
};