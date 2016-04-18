<!DOCTYPE html>
<html>
<head>
   <title>Congratulations</title>
   <link href="./public_html/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
   <script src="./public_html/js/jquery-1.11.0.js"></script>
   <script src="./public_html/js/bootstrap.min.js"></script>
   <script type="text/javascript">
       
    $(window).load(function(){
        $('#congratsModal').modal('show');
    });
    </script>
   <style>
       .modal-content{
           border:5px solid ;
           font-family: century gothic;
        }
        .modal-header{
           background-color: #000000 
        }
        .modal-title{
           color:#FFFFFF 
        }
        .modal-dialog{
            width: 60%;
        }
        #checkout-logo{
            color:#008ba4;
            text-align: center;
        }
        #content{
            text-align:center;
            font-size: 30px;
            color:#008ba4;
        }
        #message-content{
            text-align: left;
        }
        #footer-btn{
            text-align: center;
        }
        #footer-content{
            text-align: left;
        }
        #footer-content-logo{
            color:#008ba4;
        }
   </style>
</head>
<body>
<!--
<h2>Payment Receipt Modal</h2>

<button class="btn btn-primary btn-lg" data-toggle="modal" 
   data-target="#congratsModal">
   Testing Modal
</button>-->

<!-- Modal  -->
<div class="modal fade" id="congratsModal" tabindex="-1" role="dialog" 
   aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
   <div class="modal-dialog">
      <div class="modal-content" >
          <div class="modal-header">
<!--            <button type="button" class="close" 
               data-dismiss="modal" aria-hidden="true">
                  &times;
            </button>-->
            <h4 class="modal-title" id="myModalLabel">
               Congratulation
            </h4>
         </div>
         <div class="modal-body">
             <div id="checkout-logo">
                 <i class="fa fa-check-circle-o fa-5x"></i>
             </div>
            <div id="content">Congratulations !</div>
            <br>
            <br>
            <div id="message-content">
                You have already ordered our product. we will send your order information to your email <b><a href="mailto:example@example.com">example@example.com</a></b> ,and shipped as soon as possible. If you encounter any questions you can contact us. Thanks for you support
            </div>
            <br>
         </div>
         <div class="modal-footer">
            <div id="footer-content">
                <div class="row">
                    <div class="col-lg-6">
                        <div>
                            <i id="footer-content-logo" class="fa fa-envelope"></i>&nbsp; E-mail: contact@trsutedbrandsonline.com
                        </div>
                        <br>
                        <div>
                            <i id="footer-content-logo" class="fa fa-mobile"></i>&nbsp; Phone: +65 6527 0425

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <i id="footer-content-logo" class="fa fa-map-marker"></i>&nbsp; Address: 3016 Bedok North Ave4 #06-20 Singapore
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <div id="footer-btn"> 
                <a class="btn btn-default" href="./shop.php">Continue to Shop
                </a>
<!--                <button type="button" class="btn btn-primary">
                   Print Your Receipt
                </button>-->
            </div>
         </div>
      </div><!-- /.modal-content -->
</div><!-- /.modal -->
</div>
</body>
</html>