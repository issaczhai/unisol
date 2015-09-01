
<!-- Modal -->
<style>
    .btn-signIn{
        width:100%;
        background-image:none;
        background-color: rgb(0, 89, 112);
        color: #fff;
        border-radius:0;
    }
    .btn-signUp, .btn-reset{
        background-image:none;
        border-radius:0;
        background-color: rgb(0, 89, 112);
        color: #fff;
    }
    .btn-close{
      background-image: none;
      border-radius:0;
    }
    #userid, #passwordinput{
        border-radius:0;
    }
    .btn-fb{
        width:100%;
        background-image:none;
        border-radius:0;
        background-color: #3b5998;
        color:#fff;
    }
    .login-or {
        position: relative;
        font-size: 18px;
        color: #aaa;
        margin-top: 10px;
        margin-bottom: 10px;
        padding-top: 10px;
        padding-bottom: 10px;
      }
      .span-or {
        display: block;
        position: absolute;
        left: 50%;
        top: -2px;
        margin-left: -25px;
        background-color: #fff;
        width: 50px;
        text-align: center;
      }
      .hr-or {
        background-color: #cdcdcd;
        height: 1px;
        margin-top: 0px !important;
        margin-bottom: 0px !important;
      }
      .modal-content{
        border-radius: 0;
      }
      
</style>
<!-- The script below give the basic version of the SDK where the options are set to their most common defaults -->
<script>
    // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      console.log('Logged into your app and Facebook');
      userLogin();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      console.log('The person is logged into Facebook, but not your app');
      userLogin();
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      console.log("The person is not logged into Facebook, so we're not sure if they are logged into this app or not.");
      userLogin();
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }
  
  window.fbAsyncInit = function() {
    FB.init({
    	appId   : '387511714775185',
        oauth   : true,
        status  : true, // check login status
        cookie  : true, // enable cookies to allow the server to access the session
        xfbml   : true, // parse XFBML
      version    : 'v2.2'
    });
    
  };
   
  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
   
   // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function userLogin() {
    FB.login(function(response) {

        if (response.authResponse) {
            console.log('Welcome!  Fetching your information.... ');
            FB.api('/me', function(response) {
              var fb_email = response.email;
              var fb_id = response.id;
              console.log('fb_id: ' + fb_id);
              //var current_location = window.location;
              //console.log('window location: ' + window.location);
              //Validate fields if required using jQuery
                var postForm = { //Fetch form data
                    'email'     : fb_email, //Store userid fields value
                    'status'       : '',
                    'message'      : '',
                    'fbId'         : fb_id
                };

                $.ajax({ //Process the form using $.ajax()
                    type      : 'POST', //Method type
                    url       : './process_FB_login.php', //Your form processing file URL
                    data      : postForm, //Forms name
                    success   : function(data) {
                                    console.log('get the response');
                                    console.log('data:'+data);
                                    var pos = data.indexOf("{");
                                    var dataValid = data.substring(pos);
                                    var jsonData = eval("("+dataValid+")");
                                    if (!jsonData.success) { 
                                            //If fails
                                            $('#errorMsgRegister').html(jsonData.errors); 

                                    }else{
                                        var status = jsonData.status;
                                        var message = jsonData.message;
                                        //var location = jsonData.location;
                                        if (typeof status === 'undefined'){
                                            status = '';
                                        }
                                        if (typeof message === 'undefined'){
                                            message = '';
                                        }
                                        if(status !== ''){
                                            window.location='./index.php'+'?status='+status+'&message='+message;
                                        }else{
                                            window.location='./index.php';
                                        }
                                    }
                                }
                });

            });
        }else {
            //user hit cancel button
            console.log('User cancelled login or did not fully authorize.');

        }
    }, {
        scope: 'public_profile,email,user_friends'
    });
  }
</script>
<div class="modal fade bs-modal-sm" id="sign_in_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content" id="login_modal_content">
        <br>
        <div class="bs-example bs-example-tabs">
            <ul id="myTab" class="nav nav-tabs">
              <li class="active"><a href="#signin" data-toggle="tab">Sign In</a></li>
              <li class=""><a href="#signup" data-toggle="tab">New User? Register</a></li>
            </ul>
        </div>
      <div class="modal-body">
        <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active in" id="signin">
            <form id="login" class="form-horizontal">
            <fieldset>
            <!-- Sign In Form -->
            <!-- Error Massage-->
            <div class="control-group">
              <div class="controls">
                  <p style="color:#FF0000"id="errorMsg"></p>
              </div>
            </div>
            <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for="userid">Email:</label>
              <div class="controls">
                <input required="" id="userid" name="userid" type="text" class="form-control" placeholder="example@gmail.com" class="input-medium" required="">
              </div>
            </div>
            
            <!-- Password input-->
            <div class="control-group">
              <label class="control-label" for="passwordinput">Password:</label>
              <div class="controls">
                <input required="" id="passwordinput" name="passwordinput" class="form-control" type="password" class="input-medium">
              </div>
            </div>

            <!-- Multiple Checkboxes (inline) -->
            <div class="control-group">
              <label class="control-label" for="rememberme"></label>
              <div class="controls">
                    <input type="checkbox" name="rememberme" id="rememberme-0" value="Remember me"> <span>Remember Me</span>
                
              </div>
            </div>

            <!-- Button -->
            <div class="control-group">
              <label class="control-label" for="sign-in-btn"></label>
              <div class="controls">
                  <button id="sign-in-btn" onclick="login()" name="signin" class="btn btn-signIn">Sign In</button>
              </div>
            </div>
            </fieldset>
            </form>
            
            <!-- Social Login -->
            <div class="login-or">
                <hr class="hr-or">
                <span class="span-or">or</span>
            </div>
            <div class="controls">
                <button onclick="checkLoginState()" class="btn btn-fb"><i class="fa fa-facebook"></i> Login with Facebook</button>
            </div>
            
        </div>
        <div class="tab-pane fade" id="signup">
            <form id="register" class="form-horizontal">
            <fieldset>
            <!-- Sign Up Form -->
            <!-- Error Massage-->
            <div class="control-group">
              <div class="controls">
                  <p style="color:#FF0000"id="errorMsgRegister"></p>
                  <p style="color:#62c462"id="activateMsgRegister"></p>
              </div>
            </div>
            <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for="Email">Email:</label>
              <div class="controls">
                  <input id="email" name="Email" class="form-control" type="email" placeholder="example@gmail.com" class="input-large" required="">
              </div>
            </div>
            
            <!-- Password input-->
            <div class="control-group">
              <label class="control-label" for="password">Password:</label>
              <div class="controls">
                <input id="password" name="password" class="form-control" type="password" class="input-large" required="">
              </div>
            </div>
            
            <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for="reenterpassword">Re-Enter Password:</label>
              <div class="controls">
                <input id="reenterpassword" class="form-control" name="reenterpassword" type="password" class="input-large" required="">
              </div>
            </div>
            
            <!-- Button -->
            <div class="control-group">
              <label class="control-label" for="confirmsignup"></label>
              <div class="controls">
                <button id="confirmsignup" onclick="register()" name="confirmsignup" class="btn btn-signUp pull-right">Sign Up</button>
                <button id="reset" type="reset" class="btn btn-reset">Reset</button>
              </div>
            </div>
            </fieldset>
            </form>
      </div>
    </div>
      </div>
      <div class="modal-footer">
      <center>
        <button type="button" class="btn btn-close" data-dismiss="modal">Close</button>
        </center>
      </div>
    </div>
  </div>
</div>

