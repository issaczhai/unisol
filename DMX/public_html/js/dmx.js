$(document).ready(function() {
    $('#subscribe_btn').on('click', function() {
        if (!valid_email_address($("#email-text").val())){
            console.log('email is not valid');
            //$(".message").html('The email address you entered was invalid. Please make sure you enter a valid email address to subscribe.');
        }
        else{
            
            $("#subscribe_btn span").text("Subscribing...");
            var email = 'email=' + $('#email-text').val();
            $.ajax({
                url: './process_subscribtion.php', 
                data: email,
                type: 'POST',
                success: function(msg) {
                    if(msg==="success"){

                        $("#email-text").val("");
                        $("#subscribe_btn span").text("Subscribe");
                        console.log('success');
                        //$(".message").html('<span style="color:green;">You have successfully subscribed to our mailing list.</span>');
                        
                    }
                    else{

                      $("#subscribe_btn span").text("Subscribe");
                      console.log('failed');
                      //$(".message").html('The email address you entered was invalid. Please make sure you enter a valid email address to subscribe.');  
                    }
                }
            });
        }

        return false;
    });
});

var valid_email_address = function(email){

    var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
    return pattern.test(email);
};