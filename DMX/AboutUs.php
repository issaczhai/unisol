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
        <link rel="stylesheet" href="./public_html/css/style.css">
        <link rel="stylesheet" href="./public_html/css/dmx_style.css">
        <style>
            html, body{
                height: 100%;    
            }
            body{
                padding-top: 102px
            }
            .team-bonding-carousel{
                padding:0;
            }
            .title{
                position: relative;
                display:table;
                padding:0;
                margin-top:10px;
                height: 40px;
                background-color: #BDBDBD;
                color: #FFFFFF;
                font-size: 18px;
                bottom: 0;
                text-align: center;
                z-index: 1000;
            }
            #title-name{
                position:relative;
                display:table-cell;
                vertical-align: bottom;
            }
        </style>
        <meta charset="UTF-8">
        <title>About DMX</title>
    </head>
    <body>
        <div class="wrapper">
        <?php
        include_once("./templates/new_header.html");
        ?>
          <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-1 title">
                        <span id="title-name">ABOUT US<span>
                </div>
                    
                <div class="col-xs-12 col-sm-6 col-md-5 aboutUs-text">
                    Design Media Xchange is an indigenous culture of both architecture + interior . 
                    It has developed by a team of aberrant individuals from different backgrounds and exposures from the west and the east. 
                    We believe in innovations and in transforming design disciplines by applying newest technologies to achieve aesthetic and functionality of designs. 
                    DMXCHANGE is a turnkey design firm , an array of stylistic metaphors and precedents that contrives an essential qualities of design, 
                    project management, adhering client’s budgetary needs and conceive an essential qualities of design to the inhabitants . 
                    DMXCHANGE is recognized for its commercial, retail, corporate, conversion projects and including residential work.
                </div>
                    
                <div class="col-xs-12 col-sm-6 col-md-6 team-bonding-carousel">
                    <div id="index-carousel" class="carousel slide" data-ride="carousel" >
                         <!-- Indicators
                            <ol class="carousel-indicators">
                                <li data-target="#index-carousel" data-slide-to="0" class="active"></li>
                                <li data-target="#index-carousel" data-slide-to="1"></li>
                                <li data-target="#index-carousel" data-slide-to="2"></li>
                            </ol>
                          -->
                        <div class="carousel-inner" >
                            <div class="item active">
                                <img src="./public_html/img/aboutImg/team1.jpg" alt="First slide">
                                <div class='about-carousel-caption'>TEAM BONDING</div> 
                            </div>
                            <div class="item">
                                <img src="./public_html/img/aboutImg/team2.jpg" alt="Second slide">
                                <div class='about-carousel-caption'>TEAM BONDING</div>  
                            </div>
                            <div class="item">
                                <img src="./public_html/img/aboutImg/team3.jpg" alt="Third slide">
                                <div class='about-carousel-caption'>TEAM BONDING</div> 
                            </div>
                        </div>
                        <!--<img src="./public_html/img/cover.png" style="position: absolute; margin-top: -400px"alt="team" />-->
                    </div>
                </div>
            </div>   
            <div class='row about-top-overlay'></div>    
            <div class='row about-hollow-frame pull-right'></div>
        </div>
        </div>
        <?php
        include_once("./templates/footer.php");
        ?>
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./public_html/js/main.js">
    </body>
</html>
