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
        <style>
            @media screen and (min-width: 1367px){#myNavbar{margin-left:13%;margin-right:13%;}}
            .search_box .form-control:focus{
                border-color: #cccccc;
                -webkit-box-shadow: none;
                box-shadow: none;
            }
            #myNavbar{
                background: -webkit-linear-gradient(rgb(223, 223, 223), rgb(248, 248, 248),rgb(223, 223, 223)); /* For Safari 5.1 to 6.0 */
                background: -o-linear-gradient(rgb(223, 223, 223), rgb(248, 248, 248),rgb(223, 223, 223)); /* For Opera 11.1 to 12.0 */
                background: -moz-linear-gradient(rgb(223, 223, 223), rgb(248, 248, 248),rgb(223, 223, 223)); /* For Firefox 3.6 to 15 */
                background: linear-gradient(rgb(223, 223, 223), rgb(248, 248, 248),rgb(223, 223, 223)); /* Standard syntax */
            }
            .carousel-indicators li{
                border:none;
            }
            #subscribe_btn{
                border-radius:0;
            }
        </style>
        <meta charset="UTF-8">
        <title>DMX</title>
    </head>
    <body>
        <?php
        include_once("./templates/header.php");
        ?>
        <div style="position:relative;width:100%;height:10px;background-color:#9E9E9E;margin-top:112px"></div>
        <div style="position:absolute;width:85%;height:375px;background:none;margin-top:40px;margin-left:15%;z-index:3;border-top:2px solid #ffffff;border-left:2px solid #ffffff"></div>
    	<div id="index-carousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#index-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#index-carousel" data-slide-to="1"></li>
                <li data-target="#index-carousel" data-slide-to="2"></li>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                
                <div style="position:absolute;width:100%;height:40px;background-color:#000000;z-index:1;opacity:0.5"></div>
                <div style="position:absolute;width:1120px;height:250px;background:none;z-index:2;border:1px solid #ffffff"></div>
                <div class="item active">
                    <img src="http://unsplash.s3.amazonaws.com/batch%209/barcelona-boardwalk.jpg" alt="First slide">
                    <div class="carousel-caption"></div>
            <!-- Static Header -->

                </div>
                <div class="item">
                    <img src="http://unsplash.s3.amazonaws.com/batch%209/barcelona-boardwalk.jpg" alt="Second slide">
                    <div class="carousel-caption"></div>

                </div>
                <div class="item">
                    <img src="http://unsplash.s3.amazonaws.com/batch%209/barcelona-boardwalk.jpg" alt="Third slide">
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
        <div style="position:absolute;width:100%;height:35px;background-color:#c3c3c3"></div>
        <?php
        include_once("./templates/footer.php");
        ?>
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./public_html/js/main.js">
    </body>
</html>
