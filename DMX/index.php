<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
        <link rel="stylesheet" href="./public_html/css/carouselHome.css">
        <link rel="stylesheet" href="./public_html/css/main.css">
        <link rel="stylesheet" href="./public_html/css/dmx_style.css">
        <style>
            /*html, body{
                height: 100%;    
            }*/
            
            .wrapper{
                margin-bottom: 30px;
            }
            .carousel-indicators li{
                border:none;
            }
            .carousel-inner img {
                max-height:430px;
            }
        </style>
        <meta charset="UTF-8">
        <title>DMX</title>
    </head>
    <body>
        <div class="modal fade confirmSubscribeModal" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Subscription</h4>
              </div>
              <div class="modal-body">
                <p>Congradulations! You have successfully subscribed to our newsletter!</p>
              </div>
            </div>
          </div>
        </div>
        <div class='wrapper'>
        <?php
        include_once("./templates/new_header.html");
        ?>
        <div class='content-wrapper'>
            <div class="above-header-bg">
            </div>
            <div class="below-header-bg">
            </div>
            <div style="position:relative; width:100%;height:10px; background-color: rgb(117, 117, 117)"></div>
            <div class="index-hollow" style="position:absolute;right:0;height:424px;background:none;margin-top:50px;padding-left:90%;z-index:3;border-top:3px solid #ffffff;border-left:3px solid #ffffff"></div>
        	<div id="index-carousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#index-carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#index-carousel" data-slide-to="1"></li>
                    <li data-target="#index-carousel" data-slide-to="2"></li>
                </ol>
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    
                    <div class="top-carousel-overlay" style="position:absolute;width:100%;height:50px;background-color:#000000;z-index:1;opacity:0.5"></div>
                    <div class="index-hollow" style="position:absolute;width:96%;height:340px;background:none;z-index:2;border:1px solid #ffffff; border-left: 0"></div>
                    <div class="item active">
                        <img src="./public_html/img/indexImg/1.jpg" alt="First slide">
                        <div class="carousel-caption"></div>
                <!-- Static Header -->

                    </div>
                    <div class="item">
                        <img src="./public_html/img/indexImg/2.jpg" alt="Second slide">
                        <div class="carousel-caption"></div>

                    </div>
                    <div class="item">
                        <img src="./public_html/img/indexImg/3.jpg" alt="Third slide">
                        <div class="carousel-caption"></div>
                    </div>
                </div>
                <!-- Controls 
                <a class="left carousel-control" href="#index-carousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#index-carousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
                -->
            </div><!-- /carousel -->
            <div style="position:relative;width:100%;height:50px;background-color:rgb(176, 176, 176)"></div>
        </div>
        </div>
        <?php
        include_once("./templates/footer.php");
        ?>
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="./public_html/js/main.js"></script>
    <script src="./public_html/js/dmx.js"></script>
    </body>
</html>
