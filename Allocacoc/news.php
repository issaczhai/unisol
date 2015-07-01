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
        <link href="public_html/css/flipper.css" rel="stylesheet">
        <style>
            .form-control-feedback{
                width:50px
            }
        </style>
        <script>
            $('.flip-container').mouseenter(function(){
              $('body').addClass('body_m', 1000);
            });
            $('.flip-container').mouseleave(function(){
              $('body').stop().removeClass('body_m', 900);
            });
        </script>    
        <title>News</title>
        
    </head>
    <body>
    <?php
    // Load the header
    include_once("./templates/header.php");
    ?>
    <!-- News Display -->
    <div class="row col-md-11 pull-right" style="margin-top:10%">
        <div class="col-md-3 portfolio-item">
            <div class="flip-container">
                <div class="flipper">
                    <div class="front">
                        <a href="#">
                            <img class="img-responsive" src="http://www.mybkr.com/wp-content/uploads/2015/02/press-instyle-0115-cover.jpg" alt="">
                        </a>
                    </div>
                    <div class="back">
                        <h3>
                            <a href="#">News Title</a>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 portfolio-item">
            <div class="flip-container">
                <div class="flipper">
                    <div class="front">
                        <a href="#">
                            <img class="img-responsive" src="http://www.mybkr.com/wp-content/uploads/2014/12/press-cosmo-1214-cover.jpg" alt="">
                        </a>
                    </div>
                    <div class="back">
                        <h3>
                            <a href="#">News Title</a>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 portfolio-item">
            <div class="flip-container">
                <div class="flipper">
                    <div class="front">
                        <a href="#">
                            <img class="img-responsive" src="http://www.mybkr.com/wp-content/uploads/2014/08/press-ellecanada-cover2.jpg" alt="">
                        </a>
                    </div>
                    <div class="back">
                        <h3>
                            <a href="#">News Title</a>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 portfolio-item">
            <div class="flip-container">
                <div class="flipper">
                    <div class="front">
                        <a href="#">
                            <img class="img-responsive" src="http://www.mybkr.com/wp-content/uploads/2014/08/press-yodona-cover1.jpg" alt="">
                        </a>
                    </div>
                    <div class="back">
                        <h3>
                            <a href="#">News Title</a>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

    
    <!-- Scripts -->        
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
             resizeWindow();   
             resizefullWindow();
             scrollContent();
          });

        $( window ).resize(function() {
            resizeWindow();
            resizefullWindow();
            scrollContent();
        });
    </script>
    </body>
</html>

