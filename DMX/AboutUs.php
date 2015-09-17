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
            .carousel-inner{
                margin: 0;
            }
        </style>


        <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function(){
                var viewportHeight = window.innerHeight,
                    viewportWidth = window.innerWidth,
                    imgHeight,
                    marginTop;
                if(viewportWidth <= 1366 && viewportWidth > 767){
                    
                    imgHeight = viewportHeight - 104 - 140;
                    marginTop = -imgHeight;
                    $('.team-bonding-carousel img').height(imgHeight);
                    $('.about-top-overlay').css('margin-top', marginTop);
                    $('.about-hollow-frame').height(imgHeight - 12);
                    $('.about-hollow-frame').css('margin-top', marginTop + 10);
                }else if(viewportWidth > 1366){
                    imgHeight = 667 - 104 - 140;
                    marginTop = -imgHeight;
                    $('.navbar-nav').addClass('navbar-right');
                    $('.team-bonding-carousel img').height(imgHeight);
                    $('.about-top-overlay').css('margin-top', marginTop);
                    $('.about-hollow-frame').height(imgHeight - 12);
                    $('.about-hollow-frame').css('margin-top', marginTop + 10);
                }
                $(window).on('resize', function(e){
                    viewportWidth = window.innerWidth;
                    viewportHeight = window.innerHeight;
                    if(viewportWidth > 1366){
                        $('.navbar-nav').addClass('navbar-right');
                        imgHeight = 667 - 104 - 140;
                        marginTop = -imgHeight;
                        $('.navbar-nav').addClass('navbar-right');
                        $('.team-bonding-carousel img').height(imgHeight);
                        $('.about-top-overlay').css('margin-top', marginTop);
                        $('.about-hollow-frame').height(imgHeight - 12);
                        $('.about-hollow-frame').css('margin-top', marginTop + 10);
                    }else if(viewportWidth <= 1366 && viewportWidth > 767){
                        $('.navbar-nav').removeClass('navbar-right');
                        imgHeight = viewportHeight - 104 - 140;
                        marginTop = -imgHeight;
                        $('.team-bonding-carousel img').height(imgHeight);
                        $('.about-top-overlay').css('margin-top', marginTop);
                        $('.about-hollow-frame').height(imgHeight - 12);
                        $('.about-hollow-frame').css('margin-top', marginTop + 10);
                    }
                });
            });
        </script>
        <meta charset="UTF-8">
        <title>About DMX</title>
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
        <div class="wrapper">
        <?php
        include_once("./templates/new_header.html");
        ?>
          <div class="container-fluid content content-wrapper">
            <div class="above-header-bg">
            </div>
            <div class="below-header-bg">
            </div>
            <div class="row no-margin-row about-section">
                <div class="col-xs-12 col-sm-12 col-md-1 title">
                        <span id="title-name">ABOUT US<span>
                </div>
                    
                <div class="col-xs-12 col-sm-6 col-md-5 aboutUs-text">
                    <p class="typography-2">
                        Design Media Xchange is an indigenous culture of both architecture + interior. 
                        It has developed by a team of aberrant individuals from different backgrounds and exposures from the west and the east.
                    </p>
                    <p class="typography-2">
                        We believe in innovations and in transforming design disciplines by applying newest technologies to achieve aesthetic and functionality of designs.
                    </p>
                    <p class="typography-2">
                        DMXCHANGE is a turnkey design firm , an array of stylistic metaphors and precedents that contrives an essential qualities of design, 
                        project management, adhering client’s budgetary needs and conceive an essential qualities of design to the inhabitants.
                    </p>
                    <p class="typography-2">
                        DMXCHANGE is recognized for its commercial, retail, corporate, conversion projects and including residential work.
                    </p>
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
            <div class='row about-top-overlay no-margin-row'></div>    
            <div class='row about-hollow-frame pull-right no-margin-row'></div>
            <div class='row no-margin-row team'>
                <h2 class='team-header'>Our Team</h2>
                <div class='col-md-10' style='float:none;margin:0 auto'>
                    <div class='col-md-6  service-details'>
                        <img src="./public_html/img/qiaojian.jpg" alt="realm">
                        <div class="service-hover-text">
                          <h3>Jane Doe</h3>
                          <h4>Developer</h4>
                          <p>Nulla rhoncus orci sed odio euismod vestibulum. Praesent porta aliquet nulla, ut mattis velit rhoncus eu duspendisse nibh orci laoreet. </p>
                        </div>
                        <div class="service-white service-text">
                          <p>Jane Doe</p>
                          <a href="#">@JaneDoe</a>
                        </div>
                    </div>
                    <div class='col-md-6 service-details'>
                        <img src="./public_html/img/qiaojian.jpg" alt="realm">
                        <div class="service-hover-text">
                          <h3>Jane Doe</h3>
                          <h4>Developer</h4>
                          <p>Nulla rhoncus orci sed odio euismod vestibulum. Praesent porta aliquet nulla, ut mattis velit rhoncus eu duspendisse nibh orci laoreet. </p>
                        </div>
                        <div class="service-white service-text">
                          <p>Jane Doe</p>
                          <a href="#">@JaneDoe</a>
                        </div>
                    </div>
                    <div class='col-md-6 service-details'>
                        <img src="./public_html/img/qiaojian.jpg" alt="realm">
                        <div class="service-hover-text">
                          <h3>Jane Doe</h3>
                          <h4>Developer</h4>
                          <p>Nulla rhoncus orci sed odio euismod vestibulum. Praesent porta aliquet nulla, ut mattis velit rhoncus eu duspendisse nibh orci laoreet. </p>
                        </div>
                        <div class="service-white service-text">
                          <p>Jane Doe</p>
                          <a href="#">@JaneDoe</a>
                        </div>
                    </div>
                    <div class='col-md-6 service-details'>
                        <img src="./public_html/img/qiaojian.jpg" alt="realm">
                        <div class="service-hover-text">
                          <h3>Jane Doe</h3>
                          <h4>Developer</h4>
                          <p>Nulla rhoncus orci sed odio euismod vestibulum. Praesent porta aliquet nulla, ut mattis velit rhoncus eu duspendisse nibh orci laoreet. </p>
                        </div>
                        <div class="service-white service-text">
                          <p>Jane Doe</p>
                          <a href="#">@JaneDoe</a>
                        </div>
                    </div>
                    <div class='col-md-6 service-details'>
                        <img src="./public_html/img/qiaojian.jpg" alt="realm">
                        <div class="service-hover-text">
                          <h3>Jane Doe</h3>
                          <h4>Developer</h4>
                          <p>Nulla rhoncus orci sed odio euismod vestibulum. Praesent porta aliquet nulla, ut mattis velit rhoncus eu duspendisse nibh orci laoreet. </p>
                        </div>
                        <div class="service-white service-text">
                          <p>Jane Doe</p>
                          <a href="#">@JaneDoe</a>
                        </div>
                    </div>
                    <div class='col-md-6 service-details'>
                        <img src="./public_html/img/qiaojian.jpg" alt="realm">
                        <div class="service-hover-text">
                          <h3>Jane Doe</h3>
                          <h4>Developer</h4>
                          <p>Nulla rhoncus orci sed odio euismod vestibulum. Praesent porta aliquet nulla, ut mattis velit rhoncus eu duspendisse nibh orci laoreet. </p>
                        </div>
                        <div class="service-white service-text">
                          <p>Jane Doe</p>
                          <a href="#">@JaneDoe</a>
                        </div>
                    </div>
                    <div class='col-md-6 service-details'>
                        <img src="./public_html/img/qiaojian.jpg" alt="realm">
                        <div class="service-hover-text">
                          <h3>Jane Doe</h3>
                          <h4>Developer</h4>
                          <p>Nulla rhoncus orci sed odio euismod vestibulum. Praesent porta aliquet nulla, ut mattis velit rhoncus eu duspendisse nibh orci laoreet. </p>
                        </div>
                        <div class="service-white service-text">
                          <p>Jane Doe</p>
                          <a href="#">@JaneDoe</a>
                        </div>
                    </div>
            </div>
            </div>
        </div>
        </div>
        <?php
        include_once("./templates/footer.php");
        ?>
    <script src="./public_html/js/main.js"></script>
    <script src="./public_html/js/dmx.js"></script>
    </body>
</html>
