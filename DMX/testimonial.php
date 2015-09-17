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
        <link rel="stylesheet" href="./public_html/css/main.css">
        <link rel="stylesheet" href="./public_html/css/style.css">
        <link rel="stylesheet" href="./public_html/css/dmx_style.css">
        <link rel="stylesheet" href="./public_html/css/testimonial_style.css">
        <style>
            body{
                padding-top: 102px
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
                    $('.side-nav').offset({left:0});
                }else if(viewportWidth > 1366){
                    $('.side-nav').offset({left:(viewportWidth-1366)/2});
                }
                $(window).on('resize', function(e){
                    viewportWidth = window.innerWidth;
                    viewportHeight = window.innerHeight;
                    if(viewportWidth > 1366){
                        $('.navbar-nav').addClass('navbar-right');
                        $('.side-nav').offset({left:(viewportWidth-1366)/2});
                    }else if(viewportWidth <= 1366 && viewportWidth > 767){
                        $('.side-nav').offset({left:0});
                        $('.navbar-nav').removeClass('navbar-right');
                    }
                });
            });
        </script>
        <meta charset="UTF-8">
        <title>Our Clients</title>
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
        <div class="content-wrapper">
            <div class="above-header-bg">
            </div>
            <div class="side-nav">
              <ul class="dot-nav">
                <li>
                  <a href="#one" class="active" scroll-data="one"></a>
                  <span><b>Good Morning Beautiful</b>
                  Hardware and Software</span>
                </li>
                <li>
                  <a href="#two" scroll-data="two"></a>
                  <span><b>Walk it Off</b>
                  NOTIFICATIONS, MUSIC, APPLE PAY</span>
                </li>
                <li>
                  <a href="#three" scroll-data="three"></a>
                  <span><b>Fashion Technology</b>
                  FEATURING RACKED</span>
                </li>
                  <li>
                  <a href="#four" scroll-data="four"></a>
                  <span><b>Lost in the Meeting Zone</b>
                  MESSAGING, SIRI, DIGITAL TOUCH</span>
                </li>
                <li>
                  <a href="#five" scroll-data="five"></a>
                  <span><b>Business Time</b>
                  APPS AND PERFORMANCE</span>
                </li>
                <li>
                  <a href="#six" scroll-data="six"></a>
                  <span><b>Work it Out</b>
                  HEALTH, FITNESS, ACTIVITY TRACKER</span>
                </li>
                <li>
                  <a href="#seven" scroll-data="seven"></a>
                  <span><b>Twilight of Attention</b>
                  FEATURING EATER</span>
                </li>
                <li>
                  <a href="#eight" scroll-data="eight"></a>
                  <span><b>Back to Base</b>
                  BATTERY LIFE, THOUGHTS, FEELINGS</span>
                </li>
              <ul>
            </div>
            
            <div class="main">
              <section id="one" data-anchor="one" class="page-block">
                <div class="content-testimonial">
                  <h1>Good Morning Beautiful</h1>
                  <h3>Hardware and Software</h3>
                  <p>Sed posuere consectetur est at lobortis. Donec ullamcorper nulla non metus auctor fringilla. Nullam quis risus eget urna mollis ornare vel eu leo. Vestibulum id ligula porta felis euismod semper. Nullam quis risus eget urna mollis ornare vel eu leo. Sed posuere consectetur est at lobortis.</p>
                  <p>Vestibulum id ligula porta felis euismod semper. Curabitur blandit tempus porttitor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas faucibus mollis interdum. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
                  <p>Aenean lacinia bibendum nulla sed consectetur. Curabitur blandit tempus porttitor. Nullam id dolor id nibh ultricies vehicula ut id elit. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Donec ullamcorper nulla non metus auctor fringilla.</p>
                </div>
              </section>
              <section id="two" data-anchor="two" class="page-block">
                <div class="content-testimonial">
                  <h1>Walk it Off</h1>
                  <h3>NOTIFICATIONS, MUSIC, APPLE PAY</h3>
                  <p>Sed posuere consectetur est at lobortis. Donec ullamcorper nulla non metus auctor fringilla. Nullam quis risus eget urna mollis ornare vel eu leo. Vestibulum id ligula porta felis euismod semper. Nullam quis risus eget urna mollis ornare vel eu leo. Sed posuere consectetur est at lobortis.</p>
                  <p>Vestibulum id ligula porta felis euismod semper. Curabitur blandit tempus porttitor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas faucibus mollis interdum. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
                  <p>Aenean lacinia bibendum nulla sed consectetur. Curabitur blandit tempus porttitor. Nullam id dolor id nibh ultricies vehicula ut id elit. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Donec ullamcorper nulla non metus auctor fringilla.</p>
                </div>
              </section>
              <section id="three" data-anchor="three" class="page-block">
                <div class="content-testimonial">
                  <h1>Fashion Technology</h1>
                  <h3>FEATURING RACKED</h3>
                  <p>Sed posuere consectetur est at lobortis. Donec ullamcorper nulla non metus auctor fringilla. Nullam quis risus eget urna mollis ornare vel eu leo. Vestibulum id ligula porta felis euismod semper. Nullam quis risus eget urna mollis ornare vel eu leo. Sed posuere consectetur est at lobortis.</p>
                  <p>Vestibulum id ligula porta felis euismod semper. Curabitur blandit tempus porttitor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas faucibus mollis interdum. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
                  <p>Aenean lacinia bibendum nulla sed consectetur. Curabitur blandit tempus porttitor. Nullam id dolor id nibh ultricies vehicula ut id elit. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Donec ullamcorper nulla non metus auctor fringilla.</p>
                </div>
              </section>
              <section id="four" data-anchor="four" class="page-block">
                <div class="content-testimonial">
                  <h1>Lost in the Meeting Zone</h1>
                  <h3>MESSAGING, SIRI, DIGITAL TOUCH</h3>
                  <p>Sed posuere consectetur est at lobortis. Donec ullamcorper nulla non metus auctor fringilla. Nullam quis risus eget urna mollis ornare vel eu leo. Vestibulum id ligula porta felis euismod semper. Nullam quis risus eget urna mollis ornare vel eu leo. Sed posuere consectetur est at lobortis.</p>
                  <p>Vestibulum id ligula porta felis euismod semper. Curabitur blandit tempus porttitor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas faucibus mollis interdum. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
                  <p>Aenean lacinia bibendum nulla sed consectetur. Curabitur blandit tempus porttitor. Nullam id dolor id nibh ultricies vehicula ut id elit. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Donec ullamcorper nulla non metus auctor fringilla.</p>
                </div>
              </section>
              <section id="five" data-anchor="five" data-anchor="one" class="page-block">
                <div class="content-testimonial">
                  <h1>Business Time</h1>
                  <h3>APPS AND PERFORMANCE</h3>
                  <p>Sed posuere consectetur est at lobortis. Donec ullamcorper nulla non metus auctor fringilla. Nullam quis risus eget urna mollis ornare vel eu leo. Vestibulum id ligula porta felis euismod semper. Nullam quis risus eget urna mollis ornare vel eu leo. Sed posuere consectetur est at lobortis.</p>
                  <p>Vestibulum id ligula porta felis euismod semper. Curabitur blandit tempus porttitor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas faucibus mollis interdum. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
                  <p>Aenean lacinia bibendum nulla sed consectetur. Curabitur blandit tempus porttitor. Nullam id dolor id nibh ultricies vehicula ut id elit. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Donec ullamcorper nulla non metus auctor fringilla.</p>
                </div>
              </section>
              <section id="six" data-anchor="six" class="page-block">
                <div class="content-testimonial">
                  <h1>Work it Out</h1>
                  <h3>HEALTH, FITNESS, ACTIVITY TRACKER</h3>
                  <p>Sed posuere consectetur est at lobortis. Donec ullamcorper nulla non metus auctor fringilla. Nullam quis risus eget urna mollis ornare vel eu leo. Vestibulum id ligula porta felis euismod semper. Nullam quis risus eget urna mollis ornare vel eu leo. Sed posuere consectetur est at lobortis.</p>
                  <p>Vestibulum id ligula porta felis euismod semper. Curabitur blandit tempus porttitor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas faucibus mollis interdum. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
                  <p>Aenean lacinia bibendum nulla sed consectetur. Curabitur blandit tempus porttitor. Nullam id dolor id nibh ultricies vehicula ut id elit. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Donec ullamcorper nulla non metus auctor fringilla.</p>
                </div>
              </section>
              <section id="seven" data-anchor="sevent" class="page-block">
                <div class="content-testimonial">
                  <h1>Twilight of Attention</h1>
                  <h3>FEATURING EATER</h3>
                  <p>Sed posuere consectetur est at lobortis. Donec ullamcorper nulla non metus auctor fringilla. Nullam quis risus eget urna mollis ornare vel eu leo. Vestibulum id ligula porta felis euismod semper. Nullam quis risus eget urna mollis ornare vel eu leo. Sed posuere consectetur est at lobortis.</p>
                  <p>Vestibulum id ligula porta felis euismod semper. Curabitur blandit tempus porttitor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas faucibus mollis interdum. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
                  <p>Aenean lacinia bibendum nulla sed consectetur. Curabitur blandit tempus porttitor. Nullam id dolor id nibh ultricies vehicula ut id elit. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Donec ullamcorper nulla non metus auctor fringilla.</p>
                </div>
              </section>
              <section id="eight" data-anchor="eight" class="page-block">
                <div class="content-testimonial">
                  <h1>Back to Base</h1>
                  <h3>BATTERY LIFE, THOUGHTS, FEELINGS</h3>
                  <p>Sed posuere consectetur est at lobortis. Donec ullamcorper nulla non metus auctor fringilla. Nullam quis risus eget urna mollis ornare vel eu leo. Vestibulum id ligula porta felis euismod semper. Nullam quis risus eget urna mollis ornare vel eu leo. Sed posuere consectetur est at lobortis.</p>
                  <p>Vestibulum id ligula porta felis euismod semper. Curabitur blandit tempus porttitor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas faucibus mollis interdum. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
                  <p>Aenean lacinia bibendum nulla sed consectetur. Curabitur blandit tempus porttitor. Nullam id dolor id nibh ultricies vehicula ut id elit. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Donec ullamcorper nulla non metus auctor fringilla.</p>
                </div>
              </section>
            </div>
        </div>
        </div>
        <?php
        include_once("./templates/footer.php");
        ?>
    <script src="./public_html/js/dmx.js"></script>
    <script src="./public_html/js/testimonial.js"></script>
    </body>
</html>
