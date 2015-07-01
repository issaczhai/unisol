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
        </style>
        <meta charset="UTF-8">
        <title>DMX</title>
    </head>
    <body>
        <?php
        include_once("./templates/header.php");
        ?>
        <div style="position:relative;width:100%;height:50px;background-color:#9E9E9E;margin-top:112px"></div>
        <div style="position:absolute;width:90%;height:401px;background:none;margin-top:-42px;margin-left:10%;z-index:3;border-top:1px solid #474747;border-left:1px solid #474747"></div>
        <div style="position:relative;width:100%;height:400px;background-color:#fff">
          <div class="container">
            <div class="row">
                <div class="col-sm-2" style=";margin-top:-20px; margin-left:-15px">
                   
                    Service
                    
                </div>
                    
                    <div class="col-sm-5" style=";margin-left:80px" >
                        About Us About Us About Us About Us About Us About
                        About Us About Us About Us Us About Us About Us About 
                        About Us About Us About Us Us About Us About Us 
                    </div>
                    
                    <div class="col-sm-5"style=";margin-left:110px;">
                        <div id="index-carousel" class="carousel slide" data-ride="carousel" >
                         <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#index-carousel" data-slide-to="0" class="active"></li>
                                <li data-target="#index-carousel" data-slide-to="1"></li>
                                <li data-target="#index-carousel" data-slide-to="2"></li>
                            </ol>
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" >
                                <div class="item active">
                                    <img src="./public_html/img/team.png" alt="First slide">
                                    <div class="carousel-caption"></div>
                            <!-- Static Header -->
                                </div>
                                <div class="item">
                                    <img src="./public_html/img/team.png" alt="Second slide">
                                    <div class="carousel-caption"></div>

                                </div>
                                <div class="item">
                                    <img src="./public_html/img/team.png" alt="Third slide">
                                    <div class="carousel-caption"></div>
                                </div>
                            </div>
                        <img src="./public_html/img/cover.png" style="position: absolute; margin-top: -400px"alt="team" />
                    </div>
                </div>
            </div>
                     
        </div>
        <div style="position:absolute;width:100%;height:35px;background-color:#A8A8A8"></div>
        <?php
        include_once("./templates/footer.php");
        ?>
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./public_html/js/main.js">
    <link rel="stylesheet" href="./public_html/css/style.css">
    </body>
</html>
