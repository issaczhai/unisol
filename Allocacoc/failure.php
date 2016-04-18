<!DOCTYPE html>
<html>
<head>
   <title>Attention</title>
   <link href="./public_html/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
   <script src="./public_html/js/jquery-1.11.0.js"></script>
   <script src="./public_html/js/bootstrap.min.js"></script>
   <script type="text/javascript">
       
    $(window).load(function(){
        $('#failureModal').modal('show');
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
            color:#CD0000;
            text-align: center;
        }
        #content{
            text-align:center;
            font-size: 30px;
            color:#CD0000;
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
   data-target="#failureModal">
   Testing Modal
</button>-->

<!-- Modal  -->
<div class="modal fade" id="failureModal" tabindex="-1" role="dialog" 
   aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
   <div class="modal-dialog">
      <div class="modal-content" >
          <div class="modal-header">
<!--            <button type="button" class="close" 
               data-dismiss="modal" aria-hidden="true">
                  &times;
            </button>-->
            <h4 class="modal-title" id="myModalLabel">
               Attention
            </h4>
         </div>
         <div class="modal-body">
             <div id="checkout-logo">
                 <i class="fa fa-times-circle-o fa-5x"></i>
             </div>
            <div id="content">Your payment has been cancelled. </div>
            <br>
            <div id="message-content" style="text-align: center;">
                You may return to merchant through button below.
            </div>
         </div>
         <div class="modal-footer">
            
            <div id="footer-btn"> 
                <a class="btn btn-default" href="./shop.php">Return to Shop
                </a>
            </div>
         </div>
      </div><!-- /.modal-content -->
</div><!-- /.modal -->
</div>
</body>
</html>