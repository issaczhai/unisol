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
            
            .title{
                position: relative;
                width: 100%;
                display:table;
                padding:0;
                margin-top:10px;
                margin-bottom: 15px;
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

        <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function(){
                var viewportHeight = window.innerHeight,
                    viewportWidth = window.innerWidth,
                    imgHeight,
                    marginTop;
                    console.log(viewportHeight);
                if(viewportWidth <= 1366 && viewportWidth > 767){
                    imgHeight = viewportHeight - 104 - 140;
                    marginTop = -imgHeight;
                    $('.team-bonding-carousel img').height(imgHeight);
                    $('.service-top-overlay').css('margin-top', marginTop);
                    $('.service-hollow-frame').height(imgHeight - 12);
                    $('.service-hollow-frame').css('margin-top', marginTop + 10);
                }else if(viewportWidth > 1366){
                    imgHeight = 667 - 104 - 140;
                    marginTop = -imgHeight;
                    console.log(imgHeight);
                    console.log(marginTop);
                    $('.navbar-nav').addClass('navbar-right');
                    $('.team-bonding-carousel img').height(imgHeight);
                    $('.service-top-overlay').css('margin-top', marginTop);
                    $('.service-hollow-frame').height(imgHeight - 12);
                    $('.service-hollow-frame').css('margin-top', marginTop + 10);
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
                        $('.service-top-overlay').css('margin-top', marginTop);
                        $('.service-hollow-frame').height(imgHeight - 12);
                        $('.service-hollow-frame').css('margin-top', marginTop + 10);
                    }else if(viewportWidth <= 1366 && viewportWidth > 767){
                        $('.navbar-nav').removeClass('navbar-right');
                        imgHeight = viewportHeight - 104 - 140;
                        marginTop = -imgHeight;
                        $('.team-bonding-carousel img').height(imgHeight);
                        $('.service-top-overlay').css('margin-top', marginTop);
                        $('.service-hollow-frame').height(imgHeight - 12);
                        $('.service-hollow-frame').css('margin-top', marginTop + 10);
                    }
                });
                
            });
        </script>
        <meta charset="UTF-8">
        <title>DMX Services</title>
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
          <div class="container-fluid content-wrapper">
            <div class="row above-header-bg">
            </div>
            <div class="row no-margin-row">
                <div class="col-xs-12 col-sm-12 col-md-2 service-sidebar">
                        <div class="title"><h4 id='title-name'>SERVICES</h4></div>
                        <ul class="service">
                            <li>
                               <button class="btn btn-service active-service" data-title="Strategic Space Planning" value="Dmxchange analyzes the Client’s future work place needs and space strategies for the impact they will have on the over all premises portfolio. 
                                    Opportunities for alternative office solutions are explored to maximize the effectiveness of space usage. 
                                    An optimum list of project requirements is proposed in close consultation with the Client to resolve potentially conflicting needs.">
                               Strategic Space Planning</button> 
                            </li>
                            <li>
                                <button class="btn btn-service" data-title="Design Development" value="Dmxchange develops comparative base building analyses together with the Client’s real estate agents and advisors; test-fits workplace standards and detailed project requirement against alternative buildings; and assists the Client in selecting the building that best satisfies the Client’s objectives.">
                                Design Development</button> 
                            </li>
                            <li>
                                <button class="btn btn-service" data-title="Construction Documentation" value="Dmxchange provides documents and drawings indicating material and workmanship to confirm planning and design intent comprehensive for construction.">
                                Construction Documentation</button> 
                            </li>
                            <li>
                                <button class="btn btn-service" data-title="Project Management" value="Dmxchange manages both the Pre-Construction stages - interior design, planning, IT, - and the Construction stage to ensure control of cost, control of time, and control of quality resulting in timely delivery and best value for money.">
                                Project Management</button> 
                            </li>
                            <li>
                                <button class="btn btn-service" data-title="Authority Submission" value="Dmxchange provides technical project management services that ensure, through seamless integration with design compliance to local construction codes and regulations. We provides submissions to various Authority such as URA and FSSB">
                                Authority Submission</button> 
                            </li>
                            <li>
                                <button class="btn btn-service" data-title="Procurement and Construction" value="Dmxchange’s service provides the ultimate result – correctly executed and on time. We believe in working directly with each trade and supplier to tightly control the budget, quality and timeliness of all construction.">
                                Procurement and Construction</button> 
                            </li>
                            <li>
                                <button class="btn btn-service" data-title="Service Support" value="Dmxchange provides after service support and will make regular visit to the Client’s office after moved in to ensure all installation are in well order">
                                Service Support</button> 
                            </li>
                        </ul>
                </div>
                    
                <div class="col-xs-12 col-sm-12 col-md-5 aboutUs-text">
                    <h1 class="custom-header-2">Strategic Space Planning</h1>
                    <p class="typography-1">
                        Dmxchange analyzes the Client’s future work place needs and space strategies for the impact they will have on the over all premises portfolio. 
                        <br>Opportunities for alternative office solutions are explored to maximize the effectiveness of space usage. 
                        <br>An optimum list of project requirements is proposed in close consultation with the Client to resolve potentially conflicting needs.
                    </p>
                     
                </div>
                    
                <div class="col-xs-12 col-sm-12 col-md-5 team-bonding-carousel">
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
                                <div class='about-carousel-caption'>DMX</div> 
                            </div>
                            <div class="item">
                                <img src="./public_html/img/aboutImg/team2.jpg" alt="Second slide">
                                <div class='about-carousel-caption'>DMX</div>  
                            </div>
                            <div class="item">
                                <img src="./public_html/img/aboutImg/team3.jpg" alt="Third slide">
                                <div class='about-carousel-caption'>DMX</div> 
                            </div>
                        </div>
                        <!--<img src="./public_html/img/cover.png" style="position: absolute; margin-top: -400px"alt="team" />-->
                    </div>
                </div>
            </div>   
            <div class='row no-margin-row service-top-overlay'></div>
            <div class='row service-hollow-frame pull-right no-margin-row'></div>
        </div>
        </div>
        <?php
        include_once("./templates/footer.php");
        ?>
    <script src="./public_html/js/main.js"></script>
    <script src="./public_html/js/dmx.js"></script>
    <script>
    $('.service li').on('click','.btn-service', function(){
        $('.aboutUs-text p').text(this.value);
        $('.aboutUs-text .custom-header-2').text($(this).attr('data-title'));
        $('.btn-service').removeClass('active-service');
        $(this).addClass('active-service');
    });
    </script>
    </body>
</html>
